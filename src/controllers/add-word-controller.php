<?php

/**
 * @param $conn mysqli
 * @param $vocabSetId string id of the corresponding vocabulary set
 * @param $key string the word itself
 * @param $value string word definition
 * @param $timestamp string date string of the last update
 * @return bool
 */
function addWordToVocabSet(mysqli $conn, string $vocabSetId, string $key, string $value, string $timestamp): bool
{
    $sql = "INSERT INTO WORD_ENTRY (WORD_ENTRY_KEY, WORD_ENTRY_VALUE, WORD_ENTRY_VOCAB_SET_ID, WORD_ENTRY_TIMESTAMP) VALUES ('$key', '$value', '$vocabSetId', '$timestamp')";
    if (mysqli_query($conn, $sql)) {
        $timestamp = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $sql = "UPDATE VOCAB_SET SET VOCAB_SET_TIMESTAMP='$timestamp' WHERE VOCAB_SET_ID=$vocabSetId";
        mysqli_query($conn, $sql);
        return true;
    } else {
        return false;
    }
}

/**
 * @param $entry string the value to validate
 * @return bool  whether the provided value is valid or not
 */
function entryIsValid($entry): bool
{
    $regex = "#[A-Za-z0-9-:/.,?!=+()*&@\#$%^'<>_ ]+#";
    $modified = preg_replace($regex, "", $entry);
    return strlen($modified) === 0;
}

// the form is only valid when submitted by clicking the submit button
if (isset($_POST["submit"])) {
    $vocabSetId = $_GET["id"];
    $key = $_POST["word"];
    $value = $_POST["definition"];
    $timestamp = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

    if (empty($key) && empty($value)) {
        header("Location: ../add-word.php?id=$vocabSetId&error=empty-word");
        return;
    } elseif (empty($value)) {
        header("Location: ../add-word.php?id=$vocabSetId&key=$key&error=empty-word-value");
        return;
    } elseif (empty($key)) {
        header("Location: ../add-word.php?id=$vocabSetId&value=$value&error=empty-word-key");
        return;
    }

    if (strlen($key) > 100) {
        header("Location: ../add-word.php?id=$vocabSetId&value=$value&error=word-key-too-long");
        return;
    }

    if (!entryIsValid($key)) {
        header("Location: ../add-word.php?id=$vocabSetId&value=$value&error=invalid-word-key");
        return;
    }

    if (strlen($value) > 500) {
        header("Location: ../add-word.php?id=$vocabSetId&value=$value&error=word-value-too-long");
        return;
    }

    if (!entryIsValid($value)) {
        header("Location: ../add-word.php?id=$vocabSetId&key=$key&error=invalid-word-value");
        return;
    }

    require_once "../database/db-conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
//        if everything is ok, then persist to the db
        $result = addWordToVocabSet($conn, $vocabSetId, $key, $value, $timestamp);
        if (!$result) {
            mysqli_close($conn);
            header("Location: ../vocab-set.php?id=$vocabSetId&error=internal-error");
        }
        mysqli_close($conn);
        header("Location: ../vocab-set.php?id=$vocabSetId");
    } else {
        header("Location: ../vocab-set.php?id=$vocabSetId&error=internal-error");
    }
} else {
    header("Location: ../not-found.php");
}