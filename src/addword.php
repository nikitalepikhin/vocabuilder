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

<div>
    <form action="controllers/addword.controller.php?id=<?php echo $vocabSetId ?>" method="post">
        <h1>Add a new word</h1>

        <label for="word">Word</label>
        <?php if (isset($_GET["key"])): ?>
            <input type="text" id="word" name="word" value="<?php echo $_GET["key"] ?>">
        <?php else: ?>
            <input type="text" id="word" name="word">
        <?php endif ?>

        <label for="definition">Definition</label>
        <?php if (isset($_GET["value"])): ?>
            <input type="text" id="definition" name="definition" value="<?php echo $_GET["value"] ?>">
        <?php else: ?>
            <input type="text" id="definition" name="definition">
        <?php endif ?>

        <button type="submit" id="submit" name="submit">Add</button>
    </form>

    <?php if ($errorCode !== null): ?>
        <div class="message error-message">
            <?php echo $errorMessage ?>
        </div>
    <?php endif ?>

    <a href="vocabset.php?id=<?php echo $vocabSetId ?>">Go back to the set</a>
</div>

<?php
include_once "footer.php"
?>
