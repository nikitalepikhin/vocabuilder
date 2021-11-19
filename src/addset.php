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

<div>
    <form action="controllers/addvocabset.controller.php" method="post">
        <h1>Add a new vocabulary set</h1>
        <label for="setName">Set name</label>
        <input type="text" id="setName" name="setName">
        <button type="submit" id="submit" name="submit">Add</button>
    </form>

    <?php if ($errorCode !== null): ?>
        <div class="message error-message">
            <?php echo $errorMessage ?>
        </div>
    <?php endif ?>

    <a href="profile.php">Go back to profile</a>
</div>


<?php
include_once "footer.php"
?>
