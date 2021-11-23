<?php
$error = $_GET["error"];
$errorText = "";
if (!empty($error)) {
    $errorText = "/error=" . $error;
}
session_start();
$theme = $_SESSION["theme"];
session_unset();
session_destroy();
session_start();
$_SESSION["theme"] = $theme;
header("Location: index.php" . $errorText);

