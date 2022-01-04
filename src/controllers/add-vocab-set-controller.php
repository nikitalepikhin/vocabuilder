<?php

session_start();

/**
 * @param $conn
 * @param $userId string id of the owning user
 * @param $setName string name of the vocabulary set
 * @param $timestamp string date string of the last update
 * @return bool
 */
function addSet($conn, string $userId, string $setName, string $timestamp): bool
{
    $sql = "INSERT INTO VOCAB_SET (VOCAB_SET_USER_ID, VOCAB_SET_NAME, VOCAB_SET_TIMESTAMP) VALUES ('$userId', '$setName', '$timestamp')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $setName string the name of the vocabulary set to validate
 * @return bool whether the provided name is valid or not
 */
function vocabSetNameIsValid(string $setName): bool
{
    $regex = "#[A-Za-z0-9-:/.,?!=+()*&@\#$%^'<>_ ]+#";
    $modified = preg_replace($regex, "", $setName);
    return strlen($modified) === 0;
}

// the form is only valid when submitted by clicking the submit button
if (isset($_POST["submit"])) {
    $setName = $_POST["setName"];
    $userId = $_SESSION["userid"];
    $timestamp = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

    // if the token field is not set or token data is not present in the session, then return
    if (!isset($_POST["token"]) || !isset($_SESSION["token"]) || !isset($_SESSION["token-expiration"])) {
        header("Location: ../add-set.php?error=missing-token");
        return;
    } elseif ($_SESSION["token"] == $_POST["token"]) {
        // if token in session is equal to the token in the request
        // if the token has expired, then return
        if (time() >= $_SESSION["token-expiration"]) {
            header("Location: ../add-set.php?error=token-expired");
            return;
        }
        // check the vocab set name
        if (strlen($setName) > 40) {
            header("Location: ../add-set.php?error=set-too-long");
            return;
        }

        // validate the vocab set name format
        if (!vocabSetNameIsValid($setName)) {
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
            // if everything is ok, then persist to the db
            $result = addSet($conn, $userId, $setName, $timestamp);
            if ($result === false) {
                header("Location: ../add-set.php?error=internal-error");
            }
            mysqli_close($conn);
            // unset the token session values before returning
            unset($_SESSION["token"]);
            unset($_SESSION["token-expiration"]);
            header("Location: ../profile.php");
        }
    } else {
        header("Location: ../add-set.php?error=invalid-token");
        return;
    }
} else {
    header("Location: ../not-found.php");
}