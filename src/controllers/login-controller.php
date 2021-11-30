<?php

require_once "../database/db-conn.php";
require_once "../utils/utils.php";

function logInTheUser($conn, $username, $password)
{
    if (preg_match("#@#", $username) === 1) {
        if (strlen($username) > 100) {
            header("Location: ../login.php?error=email-too-long");
            return;
        }
    } else {
        if (strlen($username) > 50) {
            header("Location: ../login.php?error=username-too-long");
            return;
        }
    }

    $exists = usernameOrEmailExists($conn, $username);
    if (!$exists) {
        header("Location: ../login.php?error=user-not-found");
        return;
    }

    $passwordHashed = hash("sha512", $password . "zwasalt2021");
    $passwordStored = retrieveUserByUsername($conn, $username)["USER_PASSWORD"];
    if (strcmp($passwordHashed, $passwordStored) !== 0) {
        header("Location: ../login.php?username=$username&error=wrong-password");
        return;
    }

    $userId = retrieveUserByUsername($conn, $username)["USER_ID"];
    $retrievedUsername = retrieveUserByUsername($conn, $username)["USER_USERNAME"];
    $first = retrieveUserByUsername($conn, $username)["USER_FIRST_NAME"];
    $last = retrieveUserByUsername($conn, $username)["USER_LAST_NAME"];
    $email = retrieveUserByUsername($conn, $username)["USER_EMAIL"];

    if ($userId == false) {
        header("Location: ../logout.php?error=internal-error");
        return;
    }
    if ($retrievedUsername == false) {
        header("Location: ../logout.php?error=internal-error");
        return;
    }
    if ($first == false) {
        header("Location: ../logout.php?error=internal-error");
        return;
    }
    if ($last == false) {
        header("Location: ../logout.php?error=internal-error");
        return;
    }
    if ($email == false) {
        header("Location: ../logout.php?error=internal-error");
        return;
    }

    session_start();
    $_SESSION["userid"] = $userId;
    $_SESSION["username"] = $retrievedUsername;
    $_SESSION["first"] = $first;
    $_SESSION["last"] = $last;
    $_SESSION["email"] = $email;
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (isset($conn)) {
        if (empty($username) || empty($password)) {
            header("Location: ../login.php?error=empty-fields");
        } else {
            logInTheUser($conn, $username, $password);
        }
    }
} else {
    header("Location: ../not-found.php");
}