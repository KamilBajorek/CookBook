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
    <?php $title = 'menu'; include("templates/menu.php"); ?>

    <div class="action-menu">
        <a href="/createRecipe"><i class="fa-solid fa-pen"></i>Create recipe</a>
    </div>

    <section class="recipes">
        <?php foreach ($recipes as $recipe): ?>
            <div id="project-<?= $recipe->getId(); ?>" class="card">
                <a href="/recipe/<?= $recipe->getId(); ?>">
                 <img src="public/uploads/<?= $recipe->getImage(); ?>">
                </a>
                <div>
                    <div>
                        <h2 class="recipe-title"><?= $recipe->getTitle(); ?></h2>
                    </div>
                    <p><?= $recipe->getDescription(); ?></p>
                    <div class="user-container">
                        <i class="fa-solid fa-user"></i>
                        <a><?= $recipe->getAuthor()->getName(); ?>
                            <?= $recipe->getAuthor()->getSurname(); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>
</body>
</html>