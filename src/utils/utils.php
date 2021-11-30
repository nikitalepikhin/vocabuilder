<?php

error_reporting(0);

function birthdateIsValid($birthDate)
{
    if (!userBornAfter1920($birthDate)) return false;
    if (!userIsAtLeastFourteen($birthDate)) return false;
    return true;
}

function userBornAfter1920($birthDate)
{
    $birthDate = explode("-", $birthDate);
    $birthYear = (int)$birthDate[0];
    return $birthYear > 1920;
}

function userIsAtLeastFourteen($birthDate)
{
    $birthDate = explode("-", $birthDate);
    $birthYear = (int)$birthDate[0];
    $birthMonth = (int)$birthDate[1];
    $birthDay = (int)$birthDate[2];
    $today = date("Y-m-d");
    $today = explode("-", $today);
    $todayYear = (int)$today[0];
    $todayMonth = (int)$today[1];
    $todayDay = (int)$today[2];
    $age = $todayYear - $birthYear; // calculate the year difference
    if ($birthMonth === $todayMonth) {
        if ($birthDay > $todayDay) {
            $age -= 1;
        }
    } else if ($birthMonth > $todayMonth) {
        $age -= 1;
    }
    return $age > 14;
}

function emailIsValid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function passwordsDoMatch($password, $passwordRepeat)
{
    return strcmp($password, $passwordRepeat) === 0;
}

function emailDoesExist($conn, $email)
{
    $sql = "SELECT * FROM USER WHERE USER_EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function usernameDoesExist($conn, $username)
{
    $sql = "SELECT * FROM USER WHERE USER_USERNAME = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function passwordIsStrong($password)
{
    if (strlen($password) < 10) return false;
    if (preg_match("#[0-9]+#", $password) == 0) return false; // should contain digits

    if (preg_match("#[A-Z]+#", $password) == 0) return false; // should contain capital letters

    if (preg_match("#[a-z]+#", $password) == 0) return false; // should contain small letters
    if (preg_match("#[\~`!@\#$%^&*()-_+={}\[\]|\\\/:;\"'<>,.?]+#", $password) == 0) return false; // should contain special characters
    $regex = "#[0-9A-Za-z\~`!@\#$%^&*()-_+={}\[\]|\\\/:;\"'<>,.?]{10,}#"; // does not contain anything else
    $modified = preg_replace($regex, "", $password);
    return strlen($modified) === 0;
}

function usernameIsValid($username)
{
    $regex = "#([a-z0-9_]+\.?[a-z0-9_]+)+\.?([a-z0-9_]+\.?[a-z0-9_]+)+#"; // using delimiters #
    $modified = preg_replace($regex, "", $username);
    return strlen($modified) === 0;
}

function anyNameIsValid($name)
{
    $regex = "#[a-zA-Z- ]+#"; // using delimiters #
    $modified = preg_replace($regex, "", $name);
    return strlen($modified) === 0;
}

function retrieveUserByUsername($conn, $username)
{
    $sql = "SELECT * FROM USER WHERE USER_EMAIL='$username' OR USER_USERNAME='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function usernameOrEmailExists($conn, $username)
{
    $emailExists = emailDoesExist($conn, $username);
    $usernameExists = usernameDoesExist($conn, $username);
    return $emailExists || $usernameExists;
}

function retrieveVocabSetById($conn, $vocabSetId)
{
    $sql = "SELECT * FROM VOCAB_SET WHERE VOCAB_SET_ID='$vocabSetId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function retrieveVocabSets($conn, $userId, $pageNumber, $rowsPerPage, $orderBy, $filter)
{
    $offset = strval(($pageNumber - 1) * $rowsPerPage);
    $limit = strval($rowsPerPage);
    $sql = "SELECT * FROM VOCAB_SET WHERE VOCAB_SET_USER_ID='$userId' ORDER BY VOCAB_SET_TIMESTAMP $orderBy LIMIT $limit OFFSET $offset";
    if ($filter !== "null") {
        $filterLowercase = strtolower($filter);
        $sql = "SELECT * FROM VOCAB_SET WHERE VOCAB_SET_USER_ID='$userId' AND VOCAB_SET_NAME LIKE '$filter%' OR '$filterLowercase%' ORDER BY VOCAB_SET_TIMESTAMP $orderBy LIMIT $limit OFFSET $offset";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        return false;
    }
}

function getNumberOfSets($conn, $userId, $filter)
{
    $sql = "SELECT COUNT(*) AS VOCAB_SET_COUNT FROM VOCAB_SET WHERE VOCAB_SET_USER_ID='$userId'";
    if ($filter !== "null") {
        $filterLowercase = strtolower($filter);
        $sql = "SELECT COUNT(*) AS VOCAB_SET_COUNT FROM VOCAB_SET WHERE VOCAB_SET_USER_ID='$userId' AND VOCAB_SET_NAME LIKE '$filter%' OR '$filterLowercase%'";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function getNumberOfWords($conn, $vocabSetId, $filter)
{
    $sql = "SELECT COUNT(*) AS WORD_ENTRY_COUNT FROM WORD_ENTRY WHERE WORD_ENTRY_VOCAB_SET_ID='$vocabSetId'";
    if ($filter !== "null") {
        $filterLowercase = strtolower($filter);
        $sql = "SELECT COUNT(*) AS WORD_ENTRY_COUNT FROM WORD_ENTRY WHERE WORD_ENTRY_VOCAB_SET_ID='$vocabSetId' AND WORD_ENTRY_KEY LIKE '$filter%' OR '$filterLowercase%'";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function retrieveWordById($conn, $wordId)
{
    $sql = "SELECT * FROM WORD_ENTRY WHERE WORD_ENTRY_ID='$wordId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function retrieveWordEntries($conn, $vocabSetId, $pageNumber, $rowsPerPage, $orderBy, $filter)
{
    $offset = strval(($pageNumber - 1) * $rowsPerPage);
    $limit = strval($rowsPerPage);
    $sql = "SELECT * FROM WORD_ENTRY WHERE WORD_ENTRY_VOCAB_SET_ID='$vocabSetId' ORDER BY WORD_ENTRY_TIMESTAMP $orderBy LIMIT $limit OFFSET $offset";
    if ($filter !== "null") {
        $filterLowercase = strtolower($filter);
        $sql = "SELECT * FROM WORD_ENTRY WHERE WORD_ENTRY_VOCAB_SET_ID='$vocabSetId' AND WORD_ENTRY_KEY  LIKE '$filter%' OR '$filterLowercase%' ORDER BY WORD_ENTRY_TIMESTAMP $orderBy LIMIT $limit OFFSET $offset";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        return false;
    }
}
