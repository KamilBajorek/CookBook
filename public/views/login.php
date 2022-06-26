<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/login.js" defer></script>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/CookBook_Logo.svg" alt="CookBook">
    </div>
    <div class="login">
        <div class="hoverable_menu">
            <a class="active" href="#" id="login_menu">Login</a>
            <a href="#" id="signup_menu">Signup</a>
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
        <form class="login-form" action="login" method="POST" id="login-form">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">Login</button>
        </form>

        <form class="signup-form" action="signup" method="POST" id="signup-form">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <input name="repeat-password" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <button type="submit">Signup</button>
        </form>
    </div>
</div>
</body>
</html>