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

    <div>
        <div>
            <a href="../vocab/addset.php">Create a new set</a>
        </div>
        <div>
            <?php
            require_once "../database/db.conn.php";
            require_once "../utils/utils.php";

            if (isset($conn)) {
                $userId = $_SESSION["userid"];
                $result = retrieveVocabSets($conn, $userId, 1, 10);
                if ($result != false) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $userId = $row["VOCAB_SET_USER_ID"];
                        $vocabSetId = $row["VOCAB_SET_ID"];
                        echo "<a href='../vocab/vocabset.php?id=$vocabSetId'><div>" . $row["VOCAB_SET_NAME"] . "</div></a>";
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php
    include_once "../footer/footer.php"
    ?>

