<?php
$error = $_GET["error"];
$errorText = "";
if (!empty($error)) {
    $errorText = "/error=" . $error;
}
session_start();
session_unset();
session_destroy();
header("Location: index.php" . $errorText);

