<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/8a1c41654d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
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