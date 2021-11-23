<?php
include_once "header.php";
error_reporting(0);
if (isset($_SESSION["userid"])) {
    header("Location: ../profile/profile.php");
}
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/errorhandlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
?>
<script src="scripts/login.js" defer></script>

    <form class="form login-form" action="controllers/login.controller.php" method="post">
        <h1 class="form-heading">Log In</h1>

        <div class="form-items-container">
            <div class="form-item form-item-username">
                <label class="required-input-label" for="username">Username or email</label>
                <?php if (empty($_GET["username"])): ?>
                    <input required id="username" name="username" type="text"
                           class="input username-input">
                <?php else: ?>
                    <input required id="username" name="username" type="text"
                           class="input username-input" value="<?php echo $_GET["username"] ?>">
                <?php endif ?>
            </div>

            <div class="form-item form-item-password">
                <label class="required-input-label" for="password">Password</label>
                <input required id="password" name="password" type="password"
                       class="input password-input">
            </div>
        </div>

        <button class="btn" type="submit" name="submit">Log In</button>

        <?php if ($errorCode !== null): ?>
            <div class="message error-message">
                <?php echo $errorMessage ?>
            </div>
        <?php endif ?>
    </form>

    <div>Still not registered? <a class="link inviting-link" href="signup.php">Sign up</a>.</div>

<?php
include_once "footer.php";
?>