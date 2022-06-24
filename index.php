<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('recipes', 'RecipeController');
Routing::post('login', 'SecurityController');
Routing::post('createRecipe', 'RecipeController');

Routing::run($path);
