<?php

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($username) || empty($password)) {
            header("Location: ../login/login.php?error=emptyfields");
            exit();
        }

        loginUser($conn, $username, $password);
    }

} else {
    header("Location: ../login/login.php");
    exit();
}