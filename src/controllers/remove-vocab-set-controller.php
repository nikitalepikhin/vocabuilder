<?php
session_start();

require_once "../database/db-conn.php";
require_once "../utils/utils.php";

/**
 * @param $conn mysqli
 * @param $vocabSetId string id of the corresponding vocabulary set
 * @return bool
 */
function removeVocabSet(mysqli $conn, string $vocabSetId): bool
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
    header("Location: ../not-found.php");
}
