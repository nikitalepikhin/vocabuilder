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
    <link rel="stylesheet" href="./profile.css">
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

    <form action="../controllers/addSetController.php" method="post">
        <h1>Add a new vocabulary set</h1>
        <label for="setName">Set name</label>
        <input type="text" id="setName" name="setName">
        <button type="submit" id="submit" name="submit">Add</button>
    </form>

    <?php
    include_once "../footer/footer.php"
    ?>
