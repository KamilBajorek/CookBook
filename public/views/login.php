<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/CookBook_Logo.svg" alt="CookBook">
    </div>
    <form class="login" action="login" method="POST">
        <div class="hoverable_menu">
            <a class="active" href="#">Login</a>
            <a href="#">Signup</a>
        </div>
        <div class="messages">
            <?php
            if (isset($messages)) {
                foreach ($messages as $message) {
                    echo $message;
                }
            }
            ?>
        </div>
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button type="submit">Login</button>
    </form>

</div>
</body>
</html>