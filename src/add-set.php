<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
    exit();
}
require_once "header.php";
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/error-handlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
?>

<form class="form add-set-form" action="controllers/add-vocab-set-controller.php" method="post">
    <h1 class="form-heading">Add a new vocabulary set</h1>

    <div class="form-items-container">
        <div class="form-item form-item-set-name">
            <label for="setName">Set name</label>
            <input title="Letters, numbers and special characters" pattern="[A-Za-z0-9-:/.,?!=+()*&@#$%^'<>_ ]+" class="input" type="text" id="setName" name="setName">
        </div>
    </div>

    <button class="btn" type="submit" name="submit">Add</button>

    <?php if (isset($errorCode)): ?>
        <div class="message error-message">
            <?php echo $errorMessage ?>
        </div>
    <?php endif ?>
</form>

<div><a class="link basic-link" href="profile.php">Go back to profile</a></div>

<?php
require_once "footer.php"
?>
