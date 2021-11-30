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
require_once "database/db-conn.php";
require_once "utils/utils.php";
$row = retrieveVocabSetById($conn, $_GET["id"]);
if ($row === false) {
    header("Location: profile.php?error=invalid-set-id");
}
$currentSetName = $row["VOCAB_SET_NAME"];
?>

<form class="form add-set-form" action="controllers/rename-vocab-set-controller.php?id=<?php echo $_GET["id"] ?>" method="post">
    <h1 class="form-heading">Rename the vocabulary set</h1>

    <div class="form-items-container">
        <div class="form-item form-item-set-name">
            <label for="setName">Set name</label>
            <input title="Letters, numbers and special characters" class="input" type="text" id="setName" name="setName"
                   pattern="[A-Za-z0-9-:/.,?!=+()*&@#$%^'<>_ ]+" value="<?php echo $currentSetName ?>">
        </div>
    </div>

    <button class="btn" type="submit" name="submit">Rename</button>

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
