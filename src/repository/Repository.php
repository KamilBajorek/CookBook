<?php

require_once __DIR__ . '/../../Database.php';

class Repository
{
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function findById(string $tableName, int $id)
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM :tableName WHERE id = :id ');

        $statement->bindParam(':tableName', $tableName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll(string $tableName)
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM :tableName');

        $statement->bindParam(':tableName', $tableName, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}