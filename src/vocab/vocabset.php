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
    $vocabSetId = $_GET["id"];
    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        $row = retrieveVocabSetById($conn, $vocabSetId);
        if ($row === false) {
            header("Location: ../profile/profile.php?error=invalidsetid");
        }
        $vocabSetName = $row["VOCAB_SET_NAME"];
    }
    ?>

    <div>
        <div>
            <a href="../profile/profile.php">Go back to profile</a>
            <a href="../vocab/addword.php?id=<?php echo $vocabSetId ?>">Add a new word to this set</a>
            <a href="../controllers/removevocabset.controller.php?id=<?php echo $vocabSetId ?>">Delete this set</a>
        </div>
        <div>
            <?php
            if (isset($conn)) {
                $result = retrieveWordEntries($conn, $vocabSetId, 1, 10);
                if ($result != false) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $key = $row["WORD_ENTRY_KEY"];
                        $value = $row["WORD_ENTRY_VALUE"];
                        $wordEntryId = $row["WORD_ENTRY_ID"];
                        echo "<a href='../vocab/word.php?id=$wordEntryId'><div>" . $key . " = " . $value . "</div></a>";
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php
    include_once "../footer/footer.php"
    ?>
