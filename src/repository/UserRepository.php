<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    protected string $tableName = 'users';

    public function __construct()
    {
        parent::__construct('users');
    }

    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM users WHERE email = :email ');

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $this->convertFromStatement($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function convertFromStatement($statement): ?User
    {
        if (!$statement) {
            return null;
        }
        return new User($statement['id'], $statement['email'], $statement['password'], $statement['name'], $statement['surname']);
    }
}