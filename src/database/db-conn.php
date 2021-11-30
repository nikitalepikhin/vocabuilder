<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'vocabuilder';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_db);

if (!$conn) {
    echo "ERRNO: " . mysqli_connect_errno();
    echo "ERROR: " . mysqli_connect_error();
    die("Connection failed: " . mysqli_connect_error());
}