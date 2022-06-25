<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('recipes', 'RecipeController');
Routing::get('recipe', 'RecipeController');

Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('createRecipe', 'RecipeController');

Routing::run($path);
