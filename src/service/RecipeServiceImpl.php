<?php

require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/RecipeCategory.php';
require_once __DIR__ . '/../models/RecipeIngredient.php';

require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';
require_once __DIR__ . '/../repository/RecipeIngredientRepository.php';
require_once __DIR__ . '/../repository/RecipeRepository.php';
require_once __DIR__ . '/../repository/AmountTypeRepository.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';
require_once __DIR__ . '/../repository/SavedRepository.php';

class RecipeServiceImpl implements RecipeService
{
    private RecipeRepository $recipeRepository;
    private RecipeCategoryRepository $recipeCategoryRepository;
    private RecipeIngredientRepository $recipeIngredientRepository;
    private IngredientRepository $ingredientRepository;
    private AmountTypeRepository $amountTypeRepository;
    private SavedRepository $savedRepository;

    public function __construct()
    {
        $this->recipeRepository = new RecipeRepository();
        $this->recipeCategoryRepository = new RecipeCategoryRepository();
        $this->recipeIngredientRepository = new RecipeIngredientRepository();
        $this->ingredientRepository = new IngredientRepository();
        $this->amountTypeRepository = new AmountTypeRepository();
        $this->savedRepository = new SavedRepository();
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
        $recipes = $this->recipeRepository->findAll();
        $saved = $this->savedRepository->findByUserId($_SESSION['user']);

        return $this->supplementRecipes($recipes, $saved);
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

    function getSaved(): array
    {
        $recipeIds = $this->savedRepository->findByUserId($_SESSION['user']);

        return $this->supplementRecipes($this->recipeRepository->findByIdList($recipeIds), $recipeIds);
    }

    function save($id)
    {
        $this->savedRepository->save($_SESSION['user'], $id);
    }

    function unSave($id)
    {
        $this->savedRepository->unSave($_SESSION['user'], $id);
    }

    function search($search)
    {
        $jsonObjects = [];
        $results = $this->recipeRepository->findByTitleOrDescription($search);
        foreach ($results as $result) {
            $jsonObjects[] = json_encode($result);
        }
        return $jsonObjects;
    }

    private function supplementRecipes($recipes, $saved): array
    {
        $processed_recipes = [];
        foreach ($recipes as $recipe) {
            $recipe->setIsSavedForUser(in_array($recipe->getId(), $saved));
            array_push($processed_recipes, $recipe);
        }
        return $processed_recipes;
    }
}