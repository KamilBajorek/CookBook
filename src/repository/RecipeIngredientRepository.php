<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/RecipeIngredient.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';
require_once __DIR__ . '/../repository/AmountTypeRepository.php';

class RecipeIngredientRepository extends Repository
{
    protected string $tableName = '"RecipeIngredients"';

    private IngredientRepository $ingredientRepository;
    private AmountTypeRepository $amountTypeRepository;

    public function __construct()
    {
        parent::__construct($this->tableName);

        $this->ingredientRepository = new IngredientRepository();
        $this->amountTypeRepository = new AmountTypeRepository();
    }

    public function findByRecipeId(int $id): array
    {
        $statement = $this->database->connect()->prepare("
        SELECT * FROM $this->tableName WHERE recipeid = :id ");


        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $results = [];

        foreach ($data as $result) {
            $results[] = $this->convertFromStatement($result);
        }

        return $results;
    }

    public function createRecipeIngredient(RecipeIngredient $recipeIngredient): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO "RecipeIngredients" (recipeid, amount, "amounttypeid", "ingredientid")
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $recipeIngredient->getRecipeId(),
            $recipeIngredient->getAmount(),
            $recipeIngredient->getAmountType()->getId(),
            $recipeIngredient->getIngredient()->getId()
        ]);
    }

    public function convertFromStatement($statement): ?RecipeIngredient
    {
        if (!$statement) {
            return null;
        }
        $amountType = $this->amountTypeRepository->findById($statement['amounttypeid']);
        $ingredient = $this->ingredientRepository->findById($statement['ingredientid']);

        return new RecipeIngredient($statement['recipeid'], $statement['amount'], $ingredient, $amountType);
    }
}