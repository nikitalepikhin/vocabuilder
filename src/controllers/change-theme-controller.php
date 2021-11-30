<?php
session_start();
setcookie("theme", $_GET["theme"], time() + 60 * 60 * 24 * 30, "/");
if (isset($_SESSION["userid"])) {
    header("Location: ../profile.php");
} else {
    header("Location: ../index.php");
}
