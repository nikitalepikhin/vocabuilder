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
    if ($row["VOCAB_SET_USER_ID"] !== $_SESSION["userid"]) {
        header("Location: notfound.php");
    }
    $vocabSetName = $row["VOCAB_SET_NAME"];
}
?>

<div class="main-content-container">
    <div class="toolbar">
        <div class="toolbar-item">
            <a class="link basic-link" href="profile.php">Go back to profile</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="addword.php?id=<?php echo $vocabSetId ?>">Add a new word to this set</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="renameset.php?id=<?php echo $vocabSetId ?>">Rename this set</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="controllers/removevocabset.controller.php?id=<?php echo $vocabSetId ?>">Delete this set</a>
        </div>
    </div>
    <div class="content">
        <?php
        if (isset($conn)) {
            $result = retrieveWordEntries($conn, $vocabSetId, 1, 10);
            if ($result != false) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $key = $row["WORD_ENTRY_KEY"];
                    $value = $row["WORD_ENTRY_VALUE"];
                    $wordEntryId = $row["WORD_ENTRY_ID"];
                    echo "<a class='link' href='word.php?id=$wordEntryId'><div class='vocab-set-card'><div><p class='word'>$key</p><p class='definition'>$value</p></div><div><a class='link removal-link' href='controllers/removeword.controller.php?id=$wordEntryId'>Remove</a></div></div></a>";
                }
            } else {
                echo "<div class='vocab-set-card'>This vocabulary set is empty.</div>";
            }
        }
        ?>
    </div>
</div>

<?php
include_once "footer.php"
?>
