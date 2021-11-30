<?php

session_start();

function renameSet($conn, $setId, $setName)
{
    $timestamp = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    $sql = "UPDATE VOCAB_SET SET VOCAB_SET_NAME='$setName', VOCAB_SET_TIMESTAMP='$timestamp' WHERE VOCAB_SET_ID=$setId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function entryIsValid($entry)
{
    $regex = "#[A-Za-z0-9-:/.,?!=+()*&@\#$%^'<>_ ]+#";
    $modified = preg_replace($regex, "", $entry);
    return strlen($modified) === 0;
}

if (isset($_POST["submit"])) {
    $setName = $_POST["setName"];
    $userId = $_SESSION["userid"];
    $setId = $_GET["id"];

    require_once "../database/db-conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($setName)) {
            header("Location: ../rename-set.php?id=$setId&error=empty-set");
            return;
        }

        if (strlen($setName) > 40) {
            header("Location: ../rename-set.php?id=$setId&error=set-too-long");
            return;
        }

        if (!entryIsValid($setName)) {
            header("Location: ../rename-set.php?id=$setId&error=invalid-set");
            return;
        }
        $result = renameSet($conn, $setId, $setName);
        if ($result === false) {
            header("Location: ../rename-set.php?id=$setId&error=internal-error");
        }
        mysqli_close($conn);
        header("Location: ../vocab-set.php?id=$setId");
    }
} else {
    header("Location: ../not-found.php");
}