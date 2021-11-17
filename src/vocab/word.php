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
    <link rel="stylesheet" href="./word.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">

    <?php
    include_once "../header/header.php";
    $wordId = $_GET["id"];
    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    $row = retrieveWordById($conn, $wordId);
    if ($row === false) {
        header("Location: ../profile/profile.php?error=invalidwordid");
    }
    $key = $row["WORD_ENTRY_KEY"];
    $value = $row["WORD_ENTRY_VALUE"];
    ?>

    <div>
        <div class="word-key">
            <?php echo $key ?>
        </div>
        <hr/>
        <div class="word-value">
            <?php echo $value ?>
        </div>
        <a href="../controllers/removeword.controller.php?id=<?php echo $wordId ?>">Remove this entry</a>
    </div>

    <?php
    include_once "../footer/footer.php"
    ?>

