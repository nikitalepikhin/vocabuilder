<?php
include_once "header.php";
error_reporting(0);
if (isset($_SESSION["userid"])) {
    header("Location: ../profile/profile.php");
}

?>
    <body>

    <div class="form-container">
        <h1 class="title">Log In</h1>
        <form action="controllers/login.controller.php" method="post">
            <div class="form-elements-wrapper">
                <div class="form-element">
                    <label for="username">Username or e-mail: </label>
                    <input id="username" name="username" type="text" placeholder="Username or e-mail"
                           class="input username-input">
                </div>

                <div class="form-element">
                    <label for="password">Password: </label>
                    <input id="password" name="password" type="password" placeholder="Password"
                           class="input password-input">
                </div>
                <button class="btn" type="submit" name="submit">Log In</button>
            </div>
        </form>
    </div>

<?php
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/errorhandlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
?>

<?php if ($errorCode === "none"): ?>
    <div class="message info-message">
        You have successfully logged in.
    </div>
<?php elseif ($errorCode !== null): ?>
    <div class="message error-message">
        <?php echo $errorMessage ?>
    </div>
<?php endif ?>


<?php
include_once "footer.php";
?>