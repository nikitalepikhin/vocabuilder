<?php
include_once "header.php";
error_reporting(0);
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/errorhandlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
$vocabSetId = $_GET["id"];
?>

<form class="form add-word-form" action="controllers/addword.controller.php?id=<?php echo $vocabSetId ?>" method="post">
    <h1 class="form-heading">Add a new word</h1>

    <div class="form-items-container">
        <div class="form-item form-item-word">
            <label for="word">Word</label>
            <?php if (isset($_GET["key"])): ?>
                <input type="text" id="word" name="word" value="<?php echo $_GET["key"] ?>">
            <?php else: ?>
                <input title="Letters and spaces only" pattern="[A-Za-z ]+" type="text" id="word" name="word">
            <?php endif ?>
        </div>

        <div class="form-item form-item-definition">
            <label for="definition">Definition</label>
            <?php if (isset($_GET["value"])): ?>
                <input class="input" type="text" id="definition" name="definition" value="<?php echo $_GET["value"] ?>">
            <?php else: ?>
                <input title="Letters and spaces only" pattern="[A-Za-z ]+" class="input" type="text" id="definition" name="definition">
            <?php endif ?>
        </div>
    </div>

    <button class="btn" type="submit" name="submit">Add</button>

    <?php if ($errorCode !== null): ?>
        <div class="message error-message">
            <?php echo $errorMessage ?>
        </div>
    <?php endif ?>
</form>

<div><a class="link basic-link" href="vocabset.php?id=<?php echo $vocabSetId ?>">Go back to the set</a></div>

<?php
include_once "footer.php"
?>
