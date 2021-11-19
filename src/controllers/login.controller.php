<?php

require_once "../database/db.conn.php";
require_once "../utils/utils.php";

function loginUser($conn, $username, $password)
{
    $exists = usernameOrEmailExists($conn, $username);
    if (!$exists) {
        header("Location: ../login.php?error=usernotfound");
        exit();
    } else {
        $passwordHashed = hash("sha512", $password . "zwasalt2021");
        $passwordStored = retrieveUserByUsername($conn, $username)["USER_PASSWORD"];
        if (strcmp($passwordHashed, $passwordStored) !== 0) {
            header("Location: ../login.php?username=$username&error=wrongpassword");
            exit();
        } else {
            session_start();
            $userId = retrieveUserByUsername($conn, $username)["USER_ID"];
            $retrievedUsername = retrieveUserByUsername($conn, $username)["USER_USERNAME"];
            $first = retrieveUserByUsername($conn, $username)["USER_FIRST_NAME"];
            $last = retrieveUserByUsername($conn, $username)["USER_LAST_NAME"];
            $email = retrieveUserByUsername($conn, $username)["USER_EMAIL"];

            if ($userId == false) {
                header("Location: ../logout.php?error=internalerror");
            }
            if ($retrievedUsername == false) {
                header("Location: ../logout.php?error=internalerror");
            }
            if ($first == false) {
                header("Location: ../logout.php?error=internalerror");
            }
            if ($last == false) {
                header("Location: ../logout.php?error=internalerror");
            }
            if ($email == false) {
                header("Location: ../logout.php?error=internalerror");
            }
            $_SESSION["userid"] = $userId;
            $_SESSION["username"] = $retrievedUsername;
            $_SESSION["first"] = $first;
            $_SESSION["last"] = $last;
            $_SESSION["email"] = $email;
            header("Location: ../profile.php");
            exit();
        }
    }
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (isset($conn)) {
        if (empty($username) || empty($password)) {
            header("Location: ../login.php?error=emptyfields");
            exit();
        }
        loginUser($conn, $username, $password);
    }
} else {
    header("Location: ../notfound.php");
}