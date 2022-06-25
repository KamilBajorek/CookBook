<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/8a1c41654d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./public/js/createRecipe.js" defer></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta charset="UTF-8">
    <title>Create recipe</title>
</head>
<body>
<div class="container">
    <?php $title = 'menu'; include("templates/menu.php");?>

    <section class="recipe-form">
        <h1>Create new recipe</h1>
        <form id="recipe-form" action="createRecipe" method="POST" ENCTYPE="multipart/form-data"
              class="create-recipe-form">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="title" type="text" placeholder="Title">
            <label for="category" class="labeled-select">Category:
                <select name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <input type="file" name="file" class="file-input"/><br/>

            <textarea name="description" rows=5 placeholder="Description"></textarea>
            <h3>Ingredients list</h3>
            <div class="ingredient-select-container" id="ingredients">
                <select name="ingredient-1" class="ingredient-select" id="ingredient-select-1">
                    <?php foreach ($ingredients as $ingredient): ?>
                        <option value="<?= $ingredient->getId() ?>"><?= $ingredient->getName() ?></option>
                    <?php endforeach; ?>
                </select>
                <input name="amount-1" type="number" placeholder="amount" class="amount-input" id="amount-1">
                <select name="amount-type-1" class="amount-select" id="amount-type-1">
                    <?php foreach ($amountTypes as $amountType): ?>
                        <option value="<?= $amountType->getId() ?>"><?= $amountType->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="icon-button" type="button" id="add-ingredient-button"><i class="fa-solid fa-plus"></i></button>

            <button type="submit">Create</button>
        </form>
    </section>
</div>
</body>
</html>