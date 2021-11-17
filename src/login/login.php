<?php
include_once "../header/header.php"
?>

<?php
session_start();
if (isset($_SESSION["userid"])) {
    header("Location: ../profile/profile.php");
}
?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Vocabuilder</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
<body>
<div class="wrapper">

<?php
include_once "../header/header.php"
?>
<body>

    <div class="form-container">
        <h1 class="title">Log In</h1>
        <form action="../controllers/login.controller.php" method="post">
            <div class="form-elements-wrapper">
                <div class="form-element">
                    <label for="username">Username or e-mail: </label>
                    <input id="username" name="username" type="text" placeholder="Username or e-mail"
                           class="input username-input">
                </div>

                <div class="form-element">
                    <label for="password">Password: </label>
                    <input id="password" name="password" type="password" placeholder="Password"
                           class="input password-input">
                </div>
                <button class="btn" type="submit" name="submit">Log In</button>
            </div>
        </form>
    </div>

<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    switch ($error) {
        case "none":
            echo '<div class="message info-message">';
            echo '<p>You have successfully logged in!</p>';
            echo '</div>';
            break;
        case "emptyfields":
            echo '<div class="message error-message">';
            echo '<p>Error: all fields must be filled in.</p>';
            echo '</div>';
            break;
        case "doesnotexist":
            echo '<div class="message error-message">';
            echo '<p>Error: user with this email or username does not exist.</p>';
            echo '</div>';
            break;
        case "wrongpassword":
            echo '<div class="message error-message">';
            echo '<p>Error: the password provided is incorrect.</p>';
            echo '</div>';
            break;
    }
}
?>

<?php
include_once "../footer/footer.php";
?>