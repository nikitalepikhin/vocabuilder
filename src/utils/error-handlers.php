<?php

/**
 * @param $errorCode string error code from the url
 * @return string the full description of the error
 */
function getErrorMessage(string $errorCode): string
{
    switch ($errorCode) {
        case "user-not-found":
            return "User with the specified email or username does not exist.";
        case "wrong-password":
            return "The password provided does not match our records.";
        case "internal-error":
            return "Ouch, something went wrong on our end. Please try again.";
        case "first-too-long":
            return "The first name that you have entered is too long";
        case "last-too-long":
            return "The last name that you have entered is too long";
        case "first-invalid":
            return "The first name that you have entered does not match the required format.";
        case "last-invalid":
            return "The last name that you have entered does not match the required format.";
        case "empty-fields":
            return "All the required fields must be filled out.";
        case "email-too-long":
            return "The email that you have entered exceeds the allowed length.";
        case "username-too-long":
            return "The username that you have entered exceeds the allowed length.";
        case "password-too-long":
            return "The password that you have entered exceeds the allowed length.";
        case "invalid-birthdate":
            return "You are not allowed to use this service! The user must be at least 14 years of age and be born after 1920.";
        case "passwords-dont-match":
            return "The passwords that you have entered do not match.";
        case "email-exists":
            return "The email that you have entered is already in use with another account.";
        case "invalid-email":
            return "The e-mail that you have entered does not match the required format.";
        case "invalid-username":
            return "The username that you have entered does not match the required format.";
        case "username-exists":
            return "The username that you have entered is already taken.";
        case "empty-set":
            return "You have to provide a name for this vocabulary set.";
        case "set-too-long":
            return "The vocabulary set name that you have entered exceeds the allowed length.";
        case "invalid-set":
            return "The vocabulary set name that you have entered does not match the required format.";
        case "invalid-word-key":
            return "The word that you have entered does not match the required format.";
        case "invalid-word-value":
            return "The definition that you have entered does not match the required format.";
        case "empty-word":
            return "You have to provide a word and a definition to complete the entry.";
        case "empty-word-key":
            return "You have to provide a word to complete the entry.";
        case "word-key-too-long":
            return "The word that you have entered exceeds the allowed length.";
        case "word-value-too-long":
            return "The definition that you have entered exceeds the allowed length.";
        case "empty-word-value":
            return "You have to provide a definition to complete the entry.";
        case "weak-password":
            return "The password that you have entered is too weak.<br/>It should be at least 10 characters long and contain at least one symbol from each of the following group: capital letters (A-Z), small letters (a-z), digits (0-9) and special characters (*, ^, %, $, ?, etc).";
        case "missing-token":
            return "The token is missing. Please reload the form.";
        case "invalid-token":
            return "The token is invalid. Please reload the form.";
        case "token-expired":
            return "The token has expired. Please reload the form.";
        default:
            return "Sorry, an unknown error has occurred. Please try again.";
    }
}