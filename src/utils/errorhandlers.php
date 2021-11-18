<?php

function getErrorMessage($errorCode)
{
    switch ($errorCode) {
        case "doesnotexist":
            return "User with the specified email or username does not exist.";
        case "wrongpassword":
            return "The password you have entered is incorrect.";
        case "internalerror":
            return "Sorry, something went wrong on our side.";
        case "emptyfields":
            return "Please fill out all the required fields and try again.";
        case "invalidbirthdate":
            return "The user must be at least 14 years of age.";
        case "passwordsdontmatch":
            return "The passwords that you have entered do not match.";
        case "emailexists":
            return "The email that you have entered is already in use with another account.";
        case "invalidemail":
            return "The e-mail that you have entered is invalid.";
        case "invalidusername":
            return "The username that you have entered is invalid.";
        case "usernameexists":
            return "The username that you have entered is already taken.";
        default:
            return "An unknown error has occurred.";
    }
}