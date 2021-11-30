<?php

session_start();

function addSet($conn, $userId, $setName, $timestamp)
{
    $sql = "INSERT INTO VOCAB_SET (VOCAB_SET_USER_ID, VOCAB_SET_NAME, VOCAB_SET_TIMESTAMP) VALUES ('$userId', '$setName', '$timestamp')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function setNameIsValid($setName)
{
    $regex = "#[A-Za-z0-9-:/.,?!=+()*&@\#$%^'<>_ ]+#";
    $modified = preg_replace($regex, "", $setName);
    return strlen($modified) === 0;
}

if (isset($_POST["submit"])) {
    $setName = $_POST["setName"];
    $userId = $_SESSION["userid"];
    $timestamp = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

    if (strlen($setName) > 40) {
        header("Location: ../add-set.php?error=set-too-long");
        return;
    }

    if (!setNameIsValid($setName)) {
        header("Location: ../add-set.php?error=invalid-set");
        return;
    }

    require_once "../database/db-conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($setName)) {
            header("Location: ../add-set.php?error=empty-set");
            return;
        }
        $result = addSet($conn, $userId, $setName, $timestamp);
        if ($result === false) {
            header("Location: ../add-set.php?error=internal-error");
        }
        mysqli_close($conn);
        header("Location: ../profile.php");
    }

} else {
    header("Location: ../not-found.php");
}