<?php
session_start();

require_once "../database/db.conn.php";
require_once "../utils/utils.php";

function removeVocabSet($conn, $vocabSetId)
{
    $sql = "DELETE FROM VOCAB_SET WHERE VOCAB_SET_ID='$vocabSetId'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

$vocabSetId = $_GET["id"];
if (isset($conn)) {
    if (removeVocabSet($conn, $vocabSetId) == true) {
        header("Location: ../profile.php");
    } else {
        header("Location: ../profile.php");
    }
} else {
    header("Location: ../notfound.php");
}
