<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../repository/IngredientRepository.php';
require_once __DIR__ . '/../repository/RecipeCategoryRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SavedRepository extends Repository
{
    protected string $tableName = 'saved';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function save(int $userId, int $recipeId): void
    {
        $pdo = $this->database->connect();
        $statement = $pdo->prepare('
            INSERT INTO saved (recipeid, userid)
            VALUES (?, ?)
        ');
        $statement->execute([
            $recipeId,
            $userId
        ]);
    }

    public function unSave(int $userId, int $recipeId): void
    {
        $pdo = $this->database->connect();
        $statement = $pdo->prepare('
            DELETE FROM saved WHERE recipeid = :recipeId and userid = :userid
        ');

        $statement->execute([$recipeId, $userId]);
    }

    public function findByUserId(int $userId): array
    {
        $statement = $this->database->connect()->prepare("
        SELECT * FROM $this->tableName WHERE userid = :id ");

        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $results = [];

        foreach ($data as $result) {
            $results[] = $this->convertFromStatement($result);
        }

        return $results;
    }

    public function convertFromStatement($statement)
    {
        return $statement['recipeid'];
    }
}