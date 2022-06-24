<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/RecipeCategory.php';

class RecipeCategoryRepository extends Repository
{
    protected string $tableName = '"RecipeCategories"';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function convertFromStatement($statement): ?RecipeCategory
    {
        if (!$statement) {
            return null;
        }
        return new RecipeCategory($statement['id'], $statement['name']);
    }
}