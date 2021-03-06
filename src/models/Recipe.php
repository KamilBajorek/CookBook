<?php
require_once 'User.php';
require_once 'RecipeCategory.php';

class Recipe implements JsonSerializable
{
    private int $id;
    private string $title;
    private string $description;

    private User $author;

    private RecipeCategory $category;

    private $ingredients;
    private $image;

    private bool $isSavedForUser;

    public function __construct($title, $description, $image, $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->category = $category;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
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

    public function isSavedForUser(): bool
    {
        return $this->isSavedForUser;
    }

    public function setIsSavedForUser(bool $isSavedForUser): void
    {
        $this->isSavedForUser = $isSavedForUser;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'image' => $this->getImage(),
            'category' => $this->getCategory()->getId(),
            'description' => $this->getDescription(),
            'author' => $this->getAuthor()->getName() . ' ' . $this->getAuthor()->getSurname()
        ];
    }

}