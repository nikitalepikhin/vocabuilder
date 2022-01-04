<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'vocabuilder';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_db);

if (!$conn) {
    header("Location: ../index.php?error=internal-error");
}