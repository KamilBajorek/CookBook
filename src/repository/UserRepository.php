<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    private static string $TABLE_NAME = 'users';

    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('
        SELECT * FROM users WHERE email = :email ');

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }
        return new User($user['email'], $user['password'], $user['name'], $user['surname']);
    }

    public function getById(int $id): ?User
    {
        $user = $this->findById(self::$TABLE_NAME, $id);

        return $this->getUserFromStatement($user);
    }

    public function getAll(): array
    {
        $users = $this->findAll(self::$TABLE_NAME);
        $result = [];

        foreach ($users as $user) {
            $result[] = $this->getUserFromStatement($user);
        }

        return $result;
    }

    private function getUserFromStatement($user): ?User
    {
        if (!$user) {
            return null;
        }
        return new User($user['email'], $user['password'], $user['name'], $user['surname']);
    }
}