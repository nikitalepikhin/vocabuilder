<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: ../index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vocabuilder</title>
    <link rel="stylesheet" href="./vocabset.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">

    <?php
    include_once "../header/header.php"
    ?>

    <?php
    $vocabSetId = $_GET["set"];
    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        $row = retrieveVocabSetById($conn, $vocabSetId);
        if ($row === false) {
            header("Location: ../profile/profile.php?error=invalidsetid");
        }
        $vocabSetName = $row["VOCAB_SET_NAME"];
        echo $vocabSetName;


    }
    ?>

    <?php
    include_once "../footer/footer.php"
    ?>
