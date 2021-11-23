<?php

session_start();

function renameSet($conn, $setId, $setName)
{
    $sql = "UPDATE VOCAB_SET SET VOCAB_SET_NAME='$setName' WHERE VOCAB_SET_ID=$setId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["submit"])) {
    $setName = $_POST["setName"];
    $userId = $_SESSION["userid"];
    $setId = $_GET["id"];

    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($setName)) {
            header("Location: ../renameset.php?error=emptyset");
            exit();
        }
        $result = renameSet($conn, $setId, $setName);
        if ($result === false) {
            header("Location: ../renameset.php?error=internalerror");
        }
        mysqli_close($conn);
        header("Location: ../vocabset.php?id=$setId");
    }

} else {
    header("Location: ../notfound.php");
}