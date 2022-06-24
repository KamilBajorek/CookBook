<?php

require_once __DIR__ . '/../../Database.php';

abstract class Repository
{
    protected $database;
    protected string $tableName;

    public function __construct($tableName)
    {
        $this->database = new Database();
        $this->tableName = $tableName;
    }

    public function findById(int $id)
    {
        $statement = $this->database->connect()->prepare("
        SELECT * FROM $this->tableName WHERE id = :id ");

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->convertFromStatement($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function findAll(): array
    {
        $statement = $this->database->connect()->prepare("
        SELECT * FROM $this->tableName");

        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $results = [];

        foreach ($data as $result) {
            $results[] = $this->convertFromStatement($result);
        }

        return $results;
    }

    public abstract function convertFromStatement($statement);
}