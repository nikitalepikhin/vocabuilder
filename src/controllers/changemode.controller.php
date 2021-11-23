<?php

session_start();
$_SESSION["theme"] = $_GET["theme"];

if (isset($_SESSION["userid"])) {
    header("Location: ../profile.php");
} else {
    header("Location: ../index.php");
}
