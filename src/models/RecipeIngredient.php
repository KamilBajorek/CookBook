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

    public function getRecipeId(): int
    {
        return $this->recipeId;
    }

    public function setRecipeId(int $recipeId): void
    {
        $this->recipeId = $recipeId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(Ingredient $ingredient): void
    {
        $this->ingredient = $ingredient;
    }

    public function getAmountType(): AmountType
    {
        return $this->amountType;
    }

    public function setAmountType(AmountType $amountType): void
    {
        $this->amountType = $amountType;
    }

}