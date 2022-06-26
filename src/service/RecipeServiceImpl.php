<?php

require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/RecipeCategory.php';
require_once __DIR__ . '/../models/RecipeIngredient.php';

require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';
require_once __DIR__ . '/../repository/RecipeIngredientRepository.php';
require_once __DIR__ . '/../repository/RecipeRepository.php';
require_once __DIR__ . '/../repository/AmountTypeRepository.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';

class RecipeServiceImpl implements RecipeService
{
    private RecipeRepository $recipeRepository;
    private RecipeCategoryRepository $recipeCategoryRepository;
    private RecipeIngredientRepository $recipeIngredientRepository;
    private IngredientRepository $ingredientRepository;
    private AmountTypeRepository $amountTypeRepository;

    public function __construct()
    {
        $this->recipeRepository = new RecipeRepository();
        $this->recipeCategoryRepository = new RecipeCategoryRepository();
        $this->recipeIngredientRepository = new RecipeIngredientRepository();
        $this->ingredientRepository = new IngredientRepository();
        $this->amountTypeRepository = new AmountTypeRepository();
    }

    /**
     * @throws Exception
     */
    function createRecipe($recipeForm)
    {
        $recipeCategory = $this->recipeCategoryRepository->findById($recipeForm['category']);

        if (!$recipeCategory) {
            throw new Exception("Recipe category with given id does not exist!");
        }

        $recipe = new Recipe($recipeForm['title'], $recipeForm['description'], $recipeForm['image'], $recipeCategory);

        $recipeId = $this->recipeRepository->createRecipe($recipe);

        $ingredientCounter = $recipeForm['counter'];
        for ($x = 1; $x <= $ingredientCounter; $x++) {
            $ingredient = $this->ingredientRepository->findById($recipeForm["ingredient-$x"]);
            $amountType = $this->amountTypeRepository->findById($recipeForm["amount-type-$x"]);

            $recipeIngredient = new RecipeIngredient($recipeId, $recipeForm["amount-$x"], $ingredient, $amountType);
            $this->recipeIngredientRepository->createRecipeIngredient($recipeIngredient);
        }
    }

    function getRecipes(): array
    {
        return $this->recipeRepository->findAll();
    }

    function getRecipe($id)
    {
        return $this->recipeRepository->findById($id);
    }

    function deleteRecipe($id): void
    {
        $this->recipeIngredientRepository->deleteByRecipeId($id);
        $this->recipeRepository->deleteRecipe($id);
    }
}