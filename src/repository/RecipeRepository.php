<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';
require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';

class RecipeRepository extends Repository
{
    protected $tableName = 'recipes';

    private IngredientRepository $ingredientRepository;
    private RecipeCategoryRepository $recipeCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->ingredientRepository = new IngredientRepository();
        $this->recipeCategoryRepository = new RecipeCategoryRepository();
    }

    public function getRecipe(int $id): ?Recipe
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM recipes WHERE id = :id ');

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $recipe = $statement->fetch(PDO::FETCH_ASSOC);

        $category = $this->recipeCategoryRepository->findById($recipe['categoryId']);

        if (!$recipe) {
            return null;
        }
        return new Recipe($recipe['title'], $recipe['description'], $recipe['image'], $recipe['authorId'], $category);
    }

    public function addProject(Recipe $recipe): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO recipes (title, description, image, created_at, id_assigned_by)
            VALUES (?, ?, ?, ?, ?)
        ');

        $assignedById = 1;

        $stmt->execute([
            $recipe->getTitle(),
            $recipe->getDescription(),
            $recipe->getImage(),
            $date->format('Y-m-d'),
            $assignedById
        ]);
    }

    public function convertFromStatement($statement): ?Recipe
    {
        if (!$statement) {
            return null;
        }
        return new Recipe($statement['email'], $statement['password'], $statement['name'], $statement['surname']);
    }
}