<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
?>

<?php
$vocabSetId = $_GET["id"];
require_once "database/db.conn.php";
require_once "utils/utils.php";

if (isset($conn)) {
    $row = retrieveVocabSetById($conn, $vocabSetId);
    if ($row === false) {
        header("Location: ../profile.php?error=invalidsetid");
    }
    $vocabSetName = $row["VOCAB_SET_NAME"];
}
?>

<div>
    <div>
        <a href="profile.php">Go back to profile</a>
        <a href="addword.php?id=<?php echo $vocabSetId ?>">Add a new word to this set</a>
        <a href="controllers/removevocabset.controller.php?id=<?php echo $vocabSetId ?>">Delete this set</a>
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
                    echo "<a href='word.php?id=$wordEntryId'><div>" . $key . " = " . $value . "</div></a>";
                }
            }
        }
        ?>
    </div>
</div>

<?php
include_once "footer.php"
?>
