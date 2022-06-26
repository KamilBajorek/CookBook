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

    public function createUser(User $user): int
    {
        $pdo = $this->database->connect();
        $statement = $pdo->prepare('
            INSERT INTO users (email, password, name, surname)
            VALUES (?, ?, ?, ?)
        ');

        $result = $statement->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname()
        ]);

        return $pdo->lastInsertId();
    }

    public function convertFromStatement($statement): ?User
    {
        if (!$statement) {
            return null;
        }
        $user = new User($statement['email'], $statement['password'], $statement['name'], $statement['surname']);

        $user->setId($statement['id']);
        $user->setIsAdmin($statement['isAdmin']);

        return $user;
    }
}