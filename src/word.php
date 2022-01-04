<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
    exit();
}
require_once "header.php";
$wordId = $_GET["id"];
require_once "database/db-conn.php";
require_once "utils/utils.php";

$wordRow = retrieveWordById($conn, $wordId);
$vocabRow = retrieveVocabSetById($conn, $wordRow["WORD_ENTRY_VOCAB_SET_ID"]);
$wordOwnerId = $vocabRow["VOCAB_SET_USER_ID"];
if ($wordRow === false) {
    header("Location: profile.php?error=invalid-word-id");
}
if ($wordOwnerId !== $_SESSION["userid"]) {
    header("Location: not-found.php");
}
$key = $wordRow["WORD_ENTRY_KEY"];
$value = $wordRow["WORD_ENTRY_VALUE"];
?>

<div class="main-content-container">
    <div class="toolbar">
        <div class="toolbar-item">
            <a class="link basic-link" href="vocab-set.php?id=<?php echo htmlspecialchars(htmlspecialchars($wordRow["WORD_ENTRY_VOCAB_SET_ID"])) ?>">
                Go back to the vocabulary set
            </a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="controllers/remove-word-controller.php?id=<?php echo htmlspecialchars(htmlspecialchars($wordId)) ?>">
                Remove this entry
            </a>
        </div>
    </div>
    <div class="content">
        <div class="word-card">
            <div class="word-card-key"><?php echo htmlspecialchars($key) ?></div>
            <div class="word-card-value"><?php echo htmlspecialchars($value) ?></div>
        </div>
    </div>
</div>

<?php
require_once "footer.php"
?>

