<?php

class Recipe
{
    private string $title;
    private string $description;

    private User $author;

    private $ingredients;
    private $image;
    private $category;

    public function __construct($title, $description, $ingredients, $image, $author, $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->ingredients = $ingredients;
        $this->image = $image;
        $this->author = $author;
        $this->category = $category;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients($ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

}