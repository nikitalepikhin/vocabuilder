<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create an account</title>
</head>
<body>
<?php
include_once "../header/header.php"
?>
<div class="wrapper">
    <form action="signup.inc.php" method="post">
        <label>First Name: <input type="text" placeholder="First name" class="input first-name-input"></label>
        <label>Last Name: <input type="text" placeholder="Last name" class="input last-name-input"></label>
        <label>Date of birth: <input type="date" class="input date-of-birth-input"></label>
        <label>E-mail: <input type="email" placeholder="E-mail" class="input email-input"></label>
        <label>Username: <input type="text" placeholder="Username" class="input username-input"></label>
        <label>Password: <input type="password" placeholder="Password" class="input password-input"></label>
        <label>Repeat password: <input type="password" placeholder="Repeat password" class="input password-input"></label>
        <button type="submit">Create an account</button>
    </form>
</div>

<?php
include_once "../footer/footer.php"
?>
</body>
</html>


