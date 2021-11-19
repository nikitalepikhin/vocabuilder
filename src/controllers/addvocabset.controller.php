<?php

session_start();

function addSet($conn, $userId, $setName)
{
    $sql = "INSERT INTO VOCAB_SET (VOCAB_SET_USER_ID, VOCAB_SET_NAME) VALUES ('$userId', '$setName')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["submit"])) {
    $setName = $_POST["setName"];
    $userId = $_SESSION["userid"];

    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($setName)) {
            header("Location: ../addset.php?error=emptyset");
            exit();
        }
        $result = addSet($conn, $userId, $setName);
        if ($result === false) {
            header("Location: ../addset.php?error=internalerror");
        }
        mysqli_close($conn);
        header("Location: ../profile.php");
    }

} else {
    header("Location: ../notfound.php");
}