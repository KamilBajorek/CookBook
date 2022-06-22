<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/8a1c41654d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta charset="UTF-8">
    <title>Create recipe</title>
</head>
<body>
<div class="container">
    <div class="menu">
        <a href="#">
            <img class="menu-logo" src="public/img/CookBook_Logo.svg" alt="CookBook"></a>
        <div class="menu-links">
            <a href="">All recipes</a>
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

    <section class="recipe-form">
        <h1>Create new recipe</h1>
        <form action="createRecipe" method="POST" ENCTYPE="multipart/form-data" class="create-recipe-form">
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
                    <option value="1">Italian kitchen</option>
                    <option value="2">Chinese kitchen</option>
                    <option value="3">Dessert</option>
                </select>
            </label>
            <input type="file" name="file" class="file-input"/><br/>

            <textarea name="description" rows=5 placeholder="Description"></textarea>
            <h3>Ingredients list</h3>
            <div class="ingredient-select-container">
                <select name="ingredient" class="ingredient-select">
                    <option value="1">Milk</option>
                    <option value="2">Flour</option>
                </select>
                <input name="amount" type="number" placeholder="amount" class="amount-input">
                <select name="amount-type" class="amount-select">
                    <option value="1">ml</option>
                    <option value="2">oz</option>
                    <option value="3">g</option>
                </select>
            </div>
            <button class="icon-button"><i class="fa-solid fa-plus"></i></button>

            <button type="submit">Create</button>
        </form>
    </section>
</div>
</body>
</html>