<?php

require_once "../database/db-conn.php";
require_once "../utils/utils.php";

/**
 * @param $conn mysqli
 * @param $email string
 * @param $username string
 * @param $password string
 * @param $firstName string
 * @param $lastName string
 * @param $birthdate string
 * @return bool
 */
function createUser(mysqli $conn, string $email, string $username, string $password, string $firstName, string $lastName, string $birthdate): bool
{
    $sql = "INSERT INTO USER (USER_EMAIL, USER_USERNAME, USER_PASSWORD, USER_FIRST_NAME, USER_LAST_NAME, USER_BIRTH_DATE) values ('$email', '$username', '$password', '$firstName', '$lastName', '$birthdate')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// if the form has been properly submitted
if (isset($_POST["submit"])) {
    // retrieve the form fields data
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    if (isset($conn)) {
//        Check if all the required fields are filled out.
        if (empty($birthdate) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
            header("Location: ../signup.php?error=empty-fields&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate ?? "null") . "&email="
                . ($email ?? "null") . "&username="
                . ($username ?? "null"));
            return;
        }

//        Validate the first name
        if (strlen($firstName) > 50) {
            header("Location: ../signup.php?error=first-too-long"
                . "&last=" . ($lastName ?? "null") . "&birthdate="
                . ($birthdate ?? "null") . "&email="
                . ($email ?? "null") . "&username="
                . ($username ?? "null"));
            return;
        }

        if (!anyNameIsValid($firstName)) {
            header("Location: ../signup.php?error=first-invalid"
                . "&last=" . ($lastName ?? "null") . "&birthdate="
                . ($birthdate ?? "null") . "&email="
                . ($email ?? "null") . "&username="
                . ($username ?? "null"));
            return;
        }

//        Validate the last name
        if (strlen($lastName) > 50) {
            header("Location: ../signup.php?error=last-too-long"
                . "&first=" . ($firstName ?? "null") . "&birthdate="
                . ($birthdate ?? "null") . "&email="
                . ($email ?? "null") . "&username="
                . ($username ?? "null"));
            return;
        }

        if (!anyNameIsValid($lastName)) {
            header("Location: ../signup.php?error=last-invalid"
                . "&first=" . ($firstName ?? "null") . "&birthdate="
                . ($birthdate ?? "null") . "&email="
                . ($email ?? "null") . "&username="
                . ($username ?? "null"));
            return;
        }

//        Validate the provided birthdate. User has to be at least 14 y.o. and be born after 1920.
        if (!birthdateIsValid($birthdate)) {
            header("Location: ../signup.php?error=invalid-birthdate");
            return;
        }

//        Validate the provided email.
        if (strlen($email) > 100) {
            header("Location: ../signup.php?error=email-too-long&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&username=" . ($username));
            return;
        }

        if (!emailIsValid($email)) {
            header("Location: ../signup.php?error=invalid-email&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&username=" . ($username));
            return;
        }

        if (emailDoesExist($conn, $email)) {
            header("Location: ../signup.php?error=email-exists&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&username=" . ($username));
            return;
        }

//        Validate the provided username.
        if (strlen($username) > 50) {
            header("Location: ../signup.php?error=username-too-long&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&email=" . ($email) . "&pwd=");
            return;
        }

        if (!usernameIsValid($username)) {
            header("Location: ../signup.php?error=invalid-username&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&email=" . ($email) . "&pwd=");
            return;
        }

        if (usernameDoesExist($conn, $username)) {
            header("Location: ../signup.php?error=username-exists&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&email=" . ($email) . "&pwd=");
            return;
        }

//        Validate the provided passwords.
        if (strlen($password) > 100 || strlen($passwordRepeat) > 100) {
            header("Location: ../signup.php?error=password-too-long&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&email=" . ($email) . "&username=" . ($username));
            return;
        }

        if (!passwordsDoMatch($password, $passwordRepeat)) {
            header("Location: ../signup.php?error=passwords-dont-match&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&email=" . ($email) . "&username=" . ($username));
            return;
        }

        if (!passwordIsStrong($password)) {
            header("Location: ../signup.php?error=weak-password&first="
                . ($firstName ?? "null") . "&last="
                . ($lastName ?? "null") . "&birthdate="
                . ($birthdate) . "&email=" . ($email) . "&username=" . ($username));
            return;
        }

//        hash and salt the password
        $passwordSalted = $password . "zwasalt2021"; // salt the password
        $passwordHashed = hash("sha512", $passwordSalted); // hash the password with sha512
        $result = createUser($conn, $email, $username, $passwordHashed, $firstName, $lastName, $birthdate);
        if ($result === false) {
            mysqli_close($conn);
            header("Location: ../signup.php?error=internal-error");
            return;
        }
        mysqli_close($conn);
        header("Location: ../login.php?error=none");
        return;
    } else {
        header("Location: ../signup.php?error=internal-error");
        return;
    }
} else {
    header("Location: ../not-found.php");
}