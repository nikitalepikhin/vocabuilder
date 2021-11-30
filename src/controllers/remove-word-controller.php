<?php
session_start();

require_once "../database/db-conn.php";
require_once "../utils/utils.php";

function removeWordEntry($conn, $wordEntryId)
{
    $sql = "DELETE FROM WORD_ENTRY WHERE WORD_ENTRY_ID='$wordEntryId'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

$wordEntryId = $_GET["id"];
$vocabSetId = retrieveWordById($conn, $wordEntryId)["WORD_ENTRY_VOCAB_SET_ID"];
if (isset($conn)) {
    if (removeWordEntry($conn, $wordEntryId) == true) {
        header("Location: ../vocab-set.php?id=$vocabSetId");
    } else {
        header("Location: ../word.php?id=$wordEntryId&error=internal-error");
    }
} else {
    header("Location: ../not-found.php");
}
