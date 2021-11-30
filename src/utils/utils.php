<?php

/**
 * @param $birthdate string
 * @return bool
 */
function birthdateIsValid(string $birthdate): bool
{
    if (!userBornAfter1920($birthdate)) return false;
    if (!userIsAtLeastFourteen($birthdate)) return false;
    return true;
}

/**
 * @param $birthdate string
 * @return bool
 */
function userBornAfter1920(string $birthdate): bool
{
    $birthdate = explode("-", $birthdate);
    $birthYear = (int)$birthdate[0];
    return $birthYear > 1920;
}

/**
 * @param $birthdate string
 * @return bool
 */
function userIsAtLeastFourteen(string $birthdate): bool
{
    $birthdate = explode("-", $birthdate);
    $birthYear = (int)$birthdate[0];
    $birthMonth = (int)$birthdate[1];
    $birthDay = (int)$birthdate[2];
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

/**
 * @param $email string
 * @return mixed
 */
function emailIsValid(string $email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param $password string
 * @param $passwordRepeat string
 * @return bool
 */
function passwordsDoMatch(string $password, string $passwordRepeat): bool
{
    return strcmp($password, $passwordRepeat) === 0;
}

/**
 * @param $conn mysqli
 * @param $email string
 * @return bool
 */
function emailDoesExist(mysqli $conn, string $email): bool
{
    $sql = "SELECT * FROM USER WHERE USER_EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

/**
 * @param $conn mysqli
 * @param $username string
 * @return bool
 */
function usernameDoesExist(mysqli $conn, string $username): bool
{
    $sql = "SELECT * FROM USER WHERE USER_USERNAME = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

/**
 * @param $password string
 * @return bool
 */
function passwordIsStrong(string $password): bool
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

/**
 * @param $username string
 * @return bool
 */
function usernameIsValid(string $username): bool
{
    $regex = "#([a-z0-9_]+\.?[a-z0-9_]+)+\.?([a-z0-9_]+\.?[a-z0-9_]+)+#"; // using delimiters #
    $modified = preg_replace($regex, "", $username);
    return strlen($modified) === 0;
}

/**
 * @param $name string
 * @return bool
 */
function anyNameIsValid(string $name): bool
{
    $regex = "#[a-zA-Z- ]+#"; // using delimiters #
    $modified = preg_replace($regex, "", $name);
    return strlen($modified) === 0;
}

/**
 * @param $conn mysqli
 * @param $username string
 * @return array|false|string[]|null
 */
function retrieveUserByUsername(mysqli $conn, string $username)
{
    $sql = "SELECT * FROM USER WHERE USER_EMAIL='$username' OR USER_USERNAME='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

/**
 * @param $conn mysqli
 * @param $username string
 * @return bool
 */
function usernameOrEmailExists(mysqli $conn, string $username): bool
{
    $emailExists = emailDoesExist($conn, $username);
    $usernameExists = usernameDoesExist($conn, $username);
    return $emailExists || $usernameExists;
}

/**
 * @param $conn mysqli
 * @param $vocabSetId string
 * @return array|false|string[]|null
 */
function retrieveVocabSetById(mysqli $conn, string $vocabSetId)
{
    $sql = "SELECT * FROM VOCAB_SET WHERE VOCAB_SET_ID='$vocabSetId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

/**
 * @param $conn mysqli
 * @param $userId string
 * @param $pageNumber int
 * @param $rowsPerPage int
 * @param $orderBy string
 * @param $filter string
 * @return bool|mysqli_result
 */
function retrieveVocabSets(mysqli $conn, string $userId, int $pageNumber, int $rowsPerPage, string $orderBy, string $filter)
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

/**
 * @param $conn mysqli
 * @param $userId string
 * @param $filter string
 * @return array|false|string[]|null
 */
function getNumberOfSets(mysqli $conn, string $userId, string $filter)
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

/**
 * @param $conn mysqli
 * @param $vocabSetId string
 * @param $filter string
 * @return array|false|string[]|null
 */
function getNumberOfWords(mysqli $conn, string $vocabSetId, string $filter)
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

/**
 * @param $conn mysqli
 * @param $wordId string
 * @return array|false|string[]|null
 */
function retrieveWordById(mysqli $conn, string $wordId)
{
    $sql = "SELECT * FROM WORD_ENTRY WHERE WORD_ENTRY_ID='$wordId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

/**
 * @param $conn mysqli
 * @param $vocabSetId string
 * @param $pageNumber int
 * @param $rowsPerPage int
 * @param $orderBy string
 * @param $filter string
 * @return bool|mysqli_result
 */
function retrieveWordEntries(mysqli $conn, string $vocabSetId, int $pageNumber, int $rowsPerPage, string $orderBy, string $filter)
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
