<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/RecipeController.php';

class Routing
{
    public static $routes;

    public static function get($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function run($url)
    {
        $urlElements = explode("/", $url);
        $action = $urlElements[0];
        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        if (!isset($_SESSION['user'])) {
            if ($action != 'login' && $action != 'signup') {
                $action = 'login';
                $urlElements = [];
            }
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        if (sizeof($urlElements) > 1) {
            $object->$action($urlElements[1]);
        } else {
            $object->$action();
        }
    }
}