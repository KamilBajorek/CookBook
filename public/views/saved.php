<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/8a1c41654d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="public/js/search.js" defer></script>
    <script type="text/javascript" src="public/js/recipeOperations.js" defer></script>
    <meta charset="UTF-8">
    <title>Saved</title>
</head>
<body>
<div class="container">
    <?php $title = 'menu';
    include("templates/menu.php"); ?>

    <?php $title = 'action-menu';
    include("templates/action-menu.php"); ?>

    <?php $title = 'recipes';
    include("templates/recipes-view.php"); ?>
</div>
</body>
</html>