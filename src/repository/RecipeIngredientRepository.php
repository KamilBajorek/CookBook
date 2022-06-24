<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/RecipeIngredient.php';

class RecipeIngredientRepository extends Repository
{
    protected string $tableName = 'RecipeIngredients';

    public function __construct()
    {
        parent::__construct('RecipeIngredients');
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

    public function convertFromStatement($statement): ?Ingredient
    {
        if (!$statement) {
            return null;
        }
        return new Ingredient($statement['id'], $statement['name']);
    }
}