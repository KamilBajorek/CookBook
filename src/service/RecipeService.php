<?php

interface RecipeService
{
    function createRecipe($recipeForm);

    function getRecipes();

    function getRecipe($id);

    function deleteRecipe($id);
}