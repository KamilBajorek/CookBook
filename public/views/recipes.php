<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/8a1c41654d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta charset="UTF-8">
    <title>Recipes</title>
</head>
<body>
<div class="container">
    <div class="menu">
        <a href="#">
            <img class="menu-logo" src="public/img/CookBook_Logo.svg" alt="CookBook"></a>
        <div class="menu-links">
            <a class="active" href="#home">All recipes</a>
            <a href="#news">Saved</a>
        </div>
        <div class="search-container">
            <input class="input-search" name="search" type="text" placeholder="search"/>
        </div>
        <div class="user-container">
            <i class="fa-solid fa-user"></i>
            <a href="#about">John Kowalsky</a>
        </div>
    </div>
    <div class="action-menu">
        <a href="/createRecipe"><i class="fa-solid fa-pen"></i>Create recipe</a>
    </div>

    <section class="recipes">
        <?php foreach ($recipes as $recipe): ?>
            <div id="project-1">
                <img src="public/uploads/<?= $recipe->getImage(); ?>">

                <div>
                    <h2><?= $recipe->getTitle(); ?></h2>
                    <p><?= $recipe->getDescription(); ?></p>

                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>
</body>
</html>