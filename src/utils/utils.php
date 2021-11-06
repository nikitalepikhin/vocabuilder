<?php

// create a user and insert in into the database
function createUser($conn, $email, $username, $password, $firstName, $lastName, $dateOfBirth)
{
    $sql = "insert into USER (USER_EMAIL, USER_USERNAME, USER_PASSWORD, USER_FIRST_NAME, USER_LAST_NAME, USER_BIRTH_DATE) values (?, ?, ?, ?, ?, ?)";

    if (!$stmt = mysqli_prepare($conn, $sql)) {
        header("Location: ../signup/signup.php?error=internalerror");
        exit();
    }

    if (!mysqli_stmt_bind_param($stmt, 'ssssss', $email, $username, $password, $firstName, $lastName, $dateOfBirth)) {
        header("Location: ../signup/signup.php?error=internalerror");
        exit();
    }

    if (!mysqli_stmt_execute($stmt)) {
        header("Location: ../signup/signup.php?error=internalerror");
        exit();
    }
}

function birthDateIsValid($birthDate)
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

function emailCorrect($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function passwordsMatch($password, $passwordRepeat)
{
    return strcmp($password, $passwordRepeat) === 0;
}

function emailExists($conn, $email)
{
    $sql = "SELECT * FROM USER WHERE USER_EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function usernameExists($conn, $username)
{
    $sql = "SELECT * FROM USER WHERE USER_USERNAME = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function passwordIsStrong($password)
{
    if (strlen($password) < 10) return false;
    if (preg_match("#[0-9]+#", $password) == 0) return false;
    if (preg_match("#[A-Z]+#", $password) == 0) return false;
    if (preg_match("#[a-z]+#", $password) == 0) return false;
    if (preg_match("#[~`!@#$%^&*()-_+={}\[\]|\\\/:;\"'<>,.?]+#", $password)) return false;
    return true;
}

function usernameCorrect($username)
{
    $regex = "#([a-z0-9_]+\.?[a-z0-9_]+)+\.?([a-z0-9_]+\.?[a-z0-9_]+)+#"; // using delimiters #
    $modified = preg_replace($regex, "", $username);
    return strlen($modified) === 0;
}

function loginUser($conn, $username, $password)
{
    $exists = usernameOrEmailExists($conn, $username);
    if (!$exists) {
        header("Location: ../login/login.php?error=doesnotexist");
        exit();
    } else {
        $passwordHashed = hash("sha512", $password . "zwasalt2021");
        $passwordStored = retrieveUser($conn, $username)["USER_PASSWORD"];
        if (strcmp($passwordHashed, $passwordStored) !== 0) {
            header("Location: ../login/login.php?error=wrongpassword");
            exit();
        } else {
            session_start();
            $_SESSION["userid"] = retrieveUser($conn, $username)["USER_ID"];
            $_SESSION["username"] = retrieveUser($conn, $username)["USER_USERNAME"];
            header("Location: ../profile/profile.php?error=none");
            exit();
        }
    }
}

function retrieveUser($conn, $username)
{
    $sql = "SELECT * FROM USER WHERE USER_EMAIL='$username' OR USER_USERNAME='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        header("Location: ../login/login.php?error=doesnotexist");
        exit();
    }
}

function usernameOrEmailExists($conn, $username)
{
    $emailExists = emailExists($conn, $username);
    $usernameExists = usernameExists($conn, $username);
    return $emailExists || $usernameExists;
}