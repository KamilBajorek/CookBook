<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user || $user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ["User with email $email does not exist!"]]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['user'] = $user->getId();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/recipes");
    }

    public function logout()
    {
        session_destroy();
        return $this->render('login', ['messages' => ['Successfully logged out']]);
    }
}