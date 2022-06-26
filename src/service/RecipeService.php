<?php

interface RecipeService
{
    function createRecipe($recipeForm);

    function getRecipes();

    function getSaved();

    function getRecipe($id);

    function deleteRecipe($id);

    function save($id);

    function unSave($id);

    function search($search);
}