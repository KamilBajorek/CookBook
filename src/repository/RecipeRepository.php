<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';
require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class RecipeRepository extends Repository
{
    protected string $tableName = 'recipes';

    private RecipeIngredientRepository $recipeIngredientRepository;
    private RecipeCategoryRepository $recipeCategoryRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct($this->tableName);

        $this->recipeIngredientRepository = new RecipeIngredientRepository();
        $this->recipeCategoryRepository = new RecipeCategoryRepository();
        $this->userRepository = new UserRepository();
    }

    public function findByIdList(array $idList): array
    {
        if (sizeof($idList) == 0) {
            return [];
        }

        if (sizeof($idList) == 1) {
            return [$this->findById($idList[0])];
        }

        $inQuery = implode(',', array_fill(0, count($idList), '?'));
        $statement = $this->database->connect()->prepare('
        SELECT * FROM recipes WHERE id IN(' . $inQuery . ')');

        foreach ($idList as $k => $id) {
            $statement->bindValue(($k + 1), $id);
        }

        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $results = [];
        foreach ($data as $result) {
            $results[] = $this->convertFromStatement($result);
        }

        return $results;
    }

    public function findByTitleOrDescription(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $statement = $this->database->connect()->prepare('
            SELECT * FROM recipes WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $statement->bindParam(':search', $searchString, PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $results = [];
        foreach ($data as $result) {
            $results[] = $this->convertFromStatement($result);
        }

        return $results;
    }

    public function deleteRecipe(int $id): void
    {
        $statement = $this->database->connect()->prepare('
        DELETE FROM recipes WHERE id = :id ');

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function createRecipe(Recipe $recipe): int
    {
        $date = new DateTime();
        $pdo = $this->database->connect();
        $statement = $pdo->prepare('
            INSERT INTO recipes (title, description, "authorId", "categoryId", "createdDate", image)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $assignedById = $_SESSION['user'];

        $result = $statement->execute([
            $recipe->getTitle(),
            $recipe->getDescription(),
            $assignedById,
            $recipe->getCategory()->getId(),
            $date->format('Y-m-d'),
            $recipe->getImage()
        ]);
        return $pdo->lastInsertId();
    }

    public function convertFromStatement($statement): ?Recipe
    {
        if (!$statement) {
            return null;
        }
        $category = $this->recipeCategoryRepository->findById($statement['categoryId']);
        $author = $this->userRepository->findById($statement['authorId']);
        $ingredients = $this->recipeIngredientRepository->findByRecipeId($statement['id']);

        $recipe = new Recipe($statement['title'], $statement['description'], $statement['image'], $category);

        $recipe->setAuthor($author);
        $recipe->setIngredients($ingredients);
        $recipe->setId($statement['id']);

        return $recipe;
    }
}