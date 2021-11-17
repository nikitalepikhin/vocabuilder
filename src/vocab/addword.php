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
    <link rel="stylesheet" href="./addword.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">

    <?php
    include_once "../header/header.php";
    $vocabSetId = $_GET["id"];
    ?>

    <form action="../controllers/addword.controller.php?id=<?php echo $vocabSetId?>" method="post">
        <h1>Add a new word</h1>
        <label for="word">Word</label>
        <input type="text" id="word" name="word">
        <label for="definition">Definition</label>
        <input type="text" id="definition" name="definition">
        <button type="submit" id="submit" name="submit">Add</button>
    </form>

    <?php
    include_once "../footer/footer.php"
    ?>
