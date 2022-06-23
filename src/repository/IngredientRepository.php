<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Ingredient.php';

class IngredientRepository extends Repository
{
    protected $tableName = 'Ingredients';

    public function convertFromStatement($statement): ?Ingredient
    {
        if (!$statement) {
            return null;
        }
        return new Ingredient($statement['id'], $statement['name']);
    }
}