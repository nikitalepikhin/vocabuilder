<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
?>

<div>
    <div>
        <a href="addset.php">Create a new set</a>
    </div>
    <div>
        <?php
        require_once "database/db.conn.php";
        require_once "utils/utils.php";
        ?>

        <?php
        if (isset($conn)) {
            $userId = $_SESSION["userid"];
            $result = retrieveVocabSets($conn, $userId, 1, 10);
            if ($result != false) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userId = $row["VOCAB_SET_USER_ID"];
                    $vocabSetId = $row["VOCAB_SET_ID"];
                    echo "<a href='vocabset.php?id=$vocabSetId'><div>" . $row["VOCAB_SET_NAME"] . "</div></a>";
                }
            }
        }
        ?>
    </div>
</div>

<?php
include_once "footer.php"
?>

