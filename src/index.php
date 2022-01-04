<?php
session_start();
require_once "header.php";
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/error-handlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
$vocabSetId = $_GET["id"];
?>
    <link rel="stylesheet" href="styles/styles.css">

    <main class="main-image-container">
        <?php if (isset($_SESSION["userid"])): ?>
            <div class="motto">Welcome back,
                <?php if (empty($_SESSION["first"])) echo $_SESSION["username"]; else echo $_SESSION["first"] . " " . $_SESSION["last"]; ?>
            </div>
            <a class="link inviting-link motto-link" href="profile.php">Let's Go!</a>
        <?php else: ?>
            <div class="motto">Sign up and start learning vocabulary today!</div>
            <a class="link inviting-link motto-link" href="signup.php">Let's Go!</a>
        <?php endif; ?>
        <?php if (isset($errorCode)): ?>
            <div class="message error-message">
                <?php echo $errorMessage ?>
            </div>
        <?php endif ?>
    </main>

<?php
require_once "footer.php"
?>