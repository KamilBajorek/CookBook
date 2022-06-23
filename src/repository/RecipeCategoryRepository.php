<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/RecipeCategory.php';

class RecipeCategoryRepository extends Repository
{
    protected $tableName = 'RecipeCategories';

    public function convertFromStatement($statement): ?RecipeCategory
    {
        if (!$statement) {
            return null;
        }
        return new RecipeCategory($statement['id'], $statement['name']);
    }
}