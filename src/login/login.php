<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>
<body>
<?php
include_once "../header/header.php"
?>
<div class="wrapper">
    <form action="login.inc.php" method="post">
        <label>Username or e-mail: <input type="text" placeholder="Username or e-mail" class="input username-input"></label>
        <label>Password: <input type="password" placeholder="Password" class="input password-input"></label>
        <button type="submit">Log In</button>
    </form>
</div>
<?php
include_once "../footer/footer.php"
?>
</body>
</html>


