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

<div class="form-container">
    <h1 class="title">Create an account</h1>
    <form action="../controllers/signup.controller.php" method="post">
        <div class="form-elements-wrapper">
            <div class="form-element">
                <label for="first-name">First Name: </label>
                <?php
                if (isset($_GET["first"]) && $_GET["first"] != "null") {
                    $first = $_GET["first"];
                    echo '<input id="first-name" name="first-name" type="text" placeholder="First name" class="input first-name-input" value="' . $first . '" autocomplete="off"/>';
                } else {
                    echo '<input id="first-name" name="first-name" type="text" placeholder="First name" class="input first-name-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="last-name">Last Name: </label>
                <?php
                if (isset($_GET["last"]) && $_GET["last"] != "null") {
                    $last = $_GET["last"];
                    echo '<input id="last-name" name="last-name" type="text" placeholder="Last name" class="input last-name-input" value="' . $last . '" autocomplete="off"/>';
                } else {
                    echo '<input id="last-name" name="last-name" type="text" placeholder="Last name" class="input last-name-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="date-of-birth" class="required-input-label">Date of birth: </label>
                <?php
                if (isset($_GET["birthdate"]) && $_GET["birthdate"] != "null") {
                    $birthdate = $_GET["birthdate"];
                    echo '<input required id="date-of-birth" name="date-of-birth" type="date" class="input date-of-birth-input" value="' . $birthdate . '" autocomplete="off"/>';
                } else {
                    echo '<input required id="date-of-birth" name="date-of-birth" type="date" class="input date-of-birth-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="e-mail" class="required-input-label">E-mail: </label>
                <?php
                if (isset($_GET["email"]) && $_GET["email"] != "null") {
                    $email = $_GET["email"];
                    echo '<input required id="e-mail" name="e-mail" type="email" placeholder="E-mail" class="input email-input" value="' . $email . '" autocomplete="off"/>';
                } else {
                    echo '<input required id="e-mail" name="e-mail" type="email" placeholder="E-mail" class="input email-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="username" class="required-input-label">Username: </label>
                <?php
                if (isset($_GET["username"]) && $_GET["username"] != "null") {
                    $username = $_GET["username"];
                    echo '<input required id="username" name="username" type="text" placeholder="Username" class="input username-input" value="' . $username . '" autocomplete="off"/>';
                } else {
                    echo '<input required id="username" name="username" type="text" placeholder="Username" class="input username-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="password" class="required-input-label">Password: </label>
                <input required id="password" name="password" type="password" placeholder="Password"
                       class="input password-input" autocomplete="off"/>
            </div>

            <div class="form-element">
                <label for="password-repeat" class="required-input-label">Repeat password: </label>
                <input required id="password-repeat" name="password-repeat" type="password"
                       placeholder="Repeat password"
                       class="input password-input" autocomplete="off"/>
            </div>

            <button class="btn" type="submit" name="submit">Sign Up</button>
        </div>
    </form>
    <form action="../login/login.php">
        <div>Already have an account? <button type="submit">Log in</button>.</div>
    </form>
</div>

<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    switch ($error) {
        case "none":
            echo '<div class="message info-message">';
            echo '<p>You have successfully signed up!</p>';
            echo '</div>';
            break;
        case "internalerror":
            echo '<div class="message error-message">';
            echo '<p>Internal error: something went wrong.</p>';
            echo '</div>';
            break;
        case "invalidsubmit":
            echo '<div class="message error-message">';
            echo '<p>Error: the form has to be submitted via the \"Create an account\" button.</p>';
            echo '</div>';
            break;
        case "invalidbirthdate":
            echo '<div class="message error-message">';
            echo '<p>Error: you are not allowed to sign up, the user must be at least 14 years of age to sign up.</p>';
            echo '</div>';
            break;
        case "passwordsdontmatch":
            echo '<div class="message error-message">';
            echo '<p>Error: the passwords that you have entered do not match.</p>';
            echo '</div>';
            break;
        case "emailexists":
            echo '<div class="message error-message">';
            echo '<p>Error: the email that you have entered is already in use with another account.</p>';
            echo '</div>';
            break;
        case "invalidemail":
            echo '<div class="message error-message">';
            echo '<p>Error: the e-mail that you have entered is invalid.</p>';
            echo '</div>';
            break;
        case "invalidusername":
            echo '<div class="message error-message">';
            echo '<p>Error: the username that you have entered is invalid.</p>';
            echo '</div>';
            break;
        case "usernameexists":
            echo '<div class="message error-message">';
            echo '<p>Error: the username that you have entered is already taken.</p>';
            echo '</div>';
            break;
        case "weakpassword":
            echo '<div class="message error-message">';
            echo '<p>Error: the password that you have entered is weak.<br/>Password must be at least 10 characters long and contain at least one symbol from the following groups:</p>';
            echo '<ul><li>Capital letters (A-Z)</li><li>Small letters (a-z)</li><li>Digits (0-9)</li><li>Special characters (*, ^, %, $, ?, etc)</li></ul>';
            echo '</div>';
            break;
        case "emptyfields":
            echo '<div class="message error-message">';
            echo '<p>Error: all required fields must be filled out.</p>';
            echo '</div>';
            break;
    }
}
?>

<?php
include_once "../footer/footer.php"
?>



