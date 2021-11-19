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
?>

<form class="form add-set-form" action="controllers/addvocabset.controller.php" method="post">
    <h1 class="form-heading">Add a new vocabulary set</h1>

    <div class="form-items-container">
        <div class="form-item form-item-set-name">
            <label for="setName">Set name</label>
            <input type="text" id="setName" name="setName">
        </div>
    </div>

    <button class="btn" type="submit" name="submit">Add</button>

    <?php if ($errorCode !== null): ?>
        <div class="message error-message">
            <?php echo $errorMessage ?>
        </div>
    <?php endif ?>
</form>

<div><a class="link" href="profile.php">Go back to profile</a></div>

<?php
include_once "footer.php"
?>
