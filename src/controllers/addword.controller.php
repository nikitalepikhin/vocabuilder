<?php

function addWordToVocabSet($conn, $vocabSetId, $key, $value)
{
    $sql = "INSERT INTO WORD_ENTRY (WORD_ENTRY_KEY, WORD_ENTRY_VALUE, WORD_ENTRY_VOCAB_SET_ID) VALUES ('$key', '$value', '$vocabSetId')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["submit"])) {
    $vocabSetId = $_GET["id"];
    $key = $_POST["word"];
    $value = $_POST["definition"];

    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        $result = addWordToVocabSet($conn, $vocabSetId, $key, $value);
        if (!$result) {
            mysqli_close($conn);
            header("Location: ../vocab/vocabset.php?id=$vocabSetId&error=internalerror");
        }
        mysqli_close($conn);
        header("Location: ../vocab/vocabset.php?id=$vocabSetId&error=none");
    } else {
        header("Location: ../vocab/vocabset.php?id=$vocabSetId&error=internalerror");
    }
} else {
    header("Location: ../profile/profile.php?error=invalidsubmit");
    exit();
}