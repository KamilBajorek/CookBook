<?php

require_once __DIR__ . '/../../Database.php';

abstract class Repository
{
    protected $database;
    protected $tableName;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function findById(int $id)
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM :tableName WHERE id = :id ');

        $statement->bindParam(':tableName', $this->tableName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->convertFromStatement($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function findAll(): array
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM :tableName');

        $statement->bindParam(':tableName', $this->tableName, PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $results = [];

        foreach ($data as $result) {
            $results[] = $this->convertFromStatement($result);
        }

        return $results;
    }

    public abstract function convertFromStatement($statement);
}