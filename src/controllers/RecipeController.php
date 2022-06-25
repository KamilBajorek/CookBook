<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../service/RecipeService.php';
require_once __DIR__ . '/../service/RecipeServiceImpl.php';
require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';
require_once __DIR__ . '/../repository/AmountTypeRepository.php';

class RecipeController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];

    private RecipeService $recipeService;
    private RecipeCategoryRepository $recipeCategoryRepository;
    private IngredientRepository $ingredientRepository;
    private AmountTypeRepository $amountTypeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->recipeService = new RecipeServiceImpl();
        $this->recipeCategoryRepository = new RecipeCategoryRepository();
        $this->ingredientRepository = new IngredientRepository();
        $this->amountTypeRepository = new AmountTypeRepository();
    }

    public function recipe($id)
    {
        $recipe = $this->recipeService->getRecipe($id);
        $this->render('recipe', ['recipe' => $recipe]);
    }

    public function recipes()
    {
        $recipes = $this->recipeService->getRecipes();
        $this->render('recipes', ['recipes' => $recipes]);
    }

    public function createRecipe()
    {
        $categories = $this->recipeCategoryRepository->findAll();
        $ingredients = $this->ingredientRepository->findAll();
        $amountTypes = $this->amountTypeRepository->findAll();

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validateFile($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            $_POST['image'] = $_FILES['file']['name'];

            try {
                $this->recipeService->createRecipe($_POST);
            } catch (Exception $e) {
                $this->message[] = $e->getMessage();
                return $this->render('createRecipe', ['messages' => $this->message, 'categories' => $categories, 'ingredients' => $ingredients, 'amountTypes' => $amountTypes]);
            }

            return $this->render('recipes', ['messages' => $this->message]);
        }
        return $this->render('createRecipe', ['messages' => $this->message, 'categories' => $categories, 'ingredients' => $ingredients, 'amountTypes' => $amountTypes]);
    }

    private function validateFile(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}