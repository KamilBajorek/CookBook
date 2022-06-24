<?php

require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/RecipeCategory.php';

require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';
require_once __DIR__ . '/../repository/RecipeIngredientRepository.php';
require_once __DIR__ . '/../repository/RecipeRepository.php';

class RecipeServiceImpl implements RecipeService
{
    private RecipeRepository $recipeRepository;
    private RecipeCategoryRepository $recipeCategoryRepository;
    private RecipeIngredientRepository $recipeIngredientRepository;

    public function __construct()
    {
        $this->recipeRepository = new RecipeRepository();
        $this->recipeCategoryRepository = new RecipeCategoryRepository();
        $this->recipeIngredientRepository = new RecipeIngredientRepository();
    }

    /**
     * @throws Exception
     */
    function createRecipe($recipeForm)
    {
        $recipeCategory = $this->recipeCategoryRepository->findById($recipeForm['categoryId']);

        if (!$recipeCategory) {
            throw new Exception("Recipe category with given id does not exist!");
        }

        $recipe = new Recipe($recipeForm['title'], $recipeForm['description'], $recipeForm['image'], $recipeCategory);

        $recipeEntity = $this->recipeRepository->createRecipe($recipe);
    }

    function getRecipes(): array
    {
        return $this->recipeRepository->findAll();
    }
}