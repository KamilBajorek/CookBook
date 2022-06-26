<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $user = $this->userRepository->getUser($email);

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

    public function signup()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['repeat-password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if ($password !== $confirmedPassword) {
            return $this->render('login', ['messages' => ['Passwords are not the same']]);
        }

        $user = new User($email, md5($password), $name, $surname);

        $this->userRepository->createUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout()
    {
        session_destroy();
        return $this->render('login', ['messages' => ['Successfully logged out']]);
    }
}