<?php

// if the form has been properly submitted
if (isset($_POST["submit"])) {
    // retrieve the form fields data
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $birthDate = $_POST["date-of-birth"];
    $email = $_POST["e-mail"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($birthDate) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
            header("Location: ../signup/signup.php?error=emptyfields&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . (isset($birthDate) ? $birthDate : "null") . "&email="
                . (isset($email) ? $email : "null") . "&username="
                . (isset($username) ? $username : "null"));
            exit();
        }
        if (!birthDateIsValid($birthDate)) {
            header("Location: ../signup/signup.php?error=invalidbirthdate");
            exit();
        }
        if (!emailCorrect($email)) {
            header("Location: ../signup/signup.php?error=invalidemail&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . ($birthDate) . "&username=" . ($username));
            exit();
        }
        if (emailExists($conn, $email)) {
            header("Location: ../signup/signup.php?error=emailexists&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . ($birthDate) . "&username=" . ($username));
            exit();
        }
        if (!usernameCorrect($username)) {
            header("Location: ../signup/signup.php?error=invalidusername&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . ($birthDate) . "&email=" . ($email) . "&pwd=");
            exit();
        }
        if (usernameExists($conn, $username)) {
            header("Location: ../signup/signup.php?error=usernameexists&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . ($birthDate) . "&email=" . ($email) . "&pwd=");
            exit();
        }
        if (!passwordsMatch($password, $passwordRepeat)) {
            header("Location: ../signup/signup.php?error=passwordsdontmatch&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . ($birthDate) . "&email=" . ($email) . "&username=" . ($username));
            exit();
        }
        if (!passwordIsStrong($password)) {
            header("Location: ../signup/signup.php?error=weakpassword&first="
                . (isset($firstName) ? $firstName : "null") . "&last="
                . (isset($lastName) ? $lastName : "null") . "&birthdate="
                . ($birthDate) . "&email=" . ($email) . "&username=" . ($username));
            exit();
        }

        $passwordSalted = $password . "zwasalt2021"; // salt the password
        $passwordHashed = hash("sha512", $passwordSalted); // hash the password with sha512
        createUser($conn, $email, $username, $passwordHashed, $firstName, $lastName, $birthDate);
        mysqli_close($conn);
        header("Location: ../signup/signup.php?error=none");
    } else {
        header("Location: ../signup/signup.php?error=internalerror");
        exit();
    }
} else {
    header("Location: ../signup/signup.php?error=invalidsubmit");
}