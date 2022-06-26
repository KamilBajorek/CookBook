<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class LoggedController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    /**
     * @throws Exception
     */
    public function getLoggedUser(): User
    {
        if (isset($_SESSION['user'])) {
            return $this->userRepository->findById($_SESSION['user']);
        }
        throw new Exception("Logged user is missing!");
    }

    public function render(string $template = null, array $variables = [])
    {
        $user = null;
        try {
            $user = $this->getLoggedUser();
        } catch (Exception $e) {
            parent::render($template, ['messages' => $e->getMessage()]);
            return;
        }
        $variables['user'] = $user;

        parent::render($template, $variables);
    }
}