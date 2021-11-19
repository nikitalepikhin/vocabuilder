<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
$wordId = $_GET["id"];
require_once "database/db.conn.php";
require_once "utils/utils.php";

$wordRow = retrieveWordById($conn, $wordId);
$vocabRow = retrieveVocabSetById($conn, $wordRow["WORD_ENTRY_VOCAB_SET_ID"]);
$wordOwnerId = $vocabRow["VOCAB_SET_USER_ID"];
if ($wordRow === false) {
    header("Location: ../profile.php?error=invalidwordid");
}
if ($wordOwnerId !== $_SESSION["userid"]) {
    header("Location: notfound.php");
}
$key = $wordRow["WORD_ENTRY_KEY"];
$value = $wordRow["WORD_ENTRY_VALUE"];
?>

<div class="main-content-container">
    <div class="toolbar">
        <div class="toolbar-item"><a class="link basic-link" href="vocabset.php?id=<?php echo $wordRow["WORD_ENTRY_VOCAB_SET_ID"] ?>">Go back to
                the vocabulary set</a></div>
        <div class="toolbar-item"><a class="link basic-link" href="controllers/removeword.controller.php?id=<?php echo $wordId ?>">Remove this
                entry</a>
        </div>
    </div>
    <div class="content">
        <div class="word-card">
            <div class="word-card-key"><?php echo $key?></div>
            <div class="word-card-value"><?php echo $value?></div>
        </div>
    </div>
</div>

<?php
include_once "footer.php"
?>

