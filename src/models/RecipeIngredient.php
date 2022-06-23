<?php

class RecipeIngredient
{
    private int $recipeId;
    private int $amount;

    private Ingredient $ingredient;
    private AmountType $amountType;

    public function __construct(int $recipeId, int $amount, Ingredient $ingredient, AmountType $amountType)
    {
        $this->recipeId = $recipeId;
        $this->amount = $amount;
        $this->ingredient = $ingredient;
        $this->amountType = $amountType;
    }
}