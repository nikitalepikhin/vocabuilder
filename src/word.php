<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
$wordId = $_GET["id"];
require_once "database/db.conn.php";
require_once "utils/utils.php";

$row = retrieveWordById($conn, $wordId);
if ($row === false) {
    header("Location: ../profile.php?error=invalidwordid");
}
if ($row["WORD_ENTRY_USER_ID"] !== $_SESSION["userid"]) {
    header("Location: notfound.php");
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
    <a href="controllers/removeword.controller.php?id=<?php echo $wordId ?>">Remove this entry</a>
</div>

<?php
include_once "footer.php"
?>

