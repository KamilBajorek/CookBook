<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('recipes', 'RecipeController');
Routing::get('saved', 'RecipeController');
Routing::get('recipe', 'RecipeController');
Routing::get('delete', 'RecipeController');

Routing::post('login', 'SecurityController');
Routing::post('signup', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('createRecipe', 'RecipeController');
Routing::post('save', 'RecipeController');
Routing::post('unSave', 'RecipeController');
Routing::post('search', 'RecipeController');

Routing::run($path);
