<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/8a1c41654d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <meta charset="UTF-8">
    <title><?php echo $recipe->getTitle() ?></title>
</head>
<body>
<div class="container">
    <?php $title = 'menu';
    include("templates/menu.php"); ?>

    <?php
    if ($recipe) { ?>
        <div class="recipe">
            <img src="../public/uploads/<?= $recipe->getImage(); ?>">
            <div>
                <div>
                    <h2 class="recipe-title"><?= $recipe->getTitle(); ?></h2>
                </div>
                <div class="recipe-view">
                    <div class="ingredients-view">
                        <h3>Ingredients</h3>
                        <ul>
                            <?php foreach ($recipe->getIngredients() as $ingredient): ?>
                               <li> <?= $ingredient->getIngredient()->getName(); ?> <?= $ingredient->getAmount(); ?> <?= $ingredient->getAmountType()->getName(); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="description-view">
                        <h3>Description</h3>
                        <?= $recipe->getDescription(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>