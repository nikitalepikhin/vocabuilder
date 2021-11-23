<?php
include_once "header.php";
error_reporting(0);
if (isset($_SESSION["userid"])) {
    header("Location: profile.php");
}
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/errorhandlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
?>

<script src="scripts/signup.js" defer></script>

<form class="form signup-form" action="controllers/signup.controller.php" method="post">
    <h1 class="form-heading">Create an account</h1>

    <div class="form-items-container">
        <div class="form-item form-item-first-name">
            <label for="first-name">First name </label>
            <?php if (isset($_GET["first"]) && $_GET["first"] != "null"): ?>
                <?php $first = $_GET["first"]; ?>
                <input title="Letters and spaces only" pattern="[A-Za-z ]+" id="first-name" name="first-name" type="text"
                       class="input first-name-input"
                       value="<?php echo $first ?>" autocomplete="off"/>
            <?php else: ?>
                <input title="Letters and spaces only" pattern="[A-Za-z ]+" id="first-name" name="first-name" type="text"
                       class="input first-name-input" autocomplete="off"/>
            <?php endif ?>
        </div>

        <div class="form-item form-item-last-name">
            <label for="last-name">Last name </label>
            <?php if (isset($_GET["last"]) && $_GET["last"] != "null"): ?>
                <?php $last = $_GET["last"] ?>
                <input title="Letters and spaces only" pattern="[A-Za-z ]+" id="last-name" name="last-name" type="text"
                       class="input last-name-input"
                       value="<?php echo $last ?>" autocomplete="off"/>
            <?php else: ?>
                <input title="Letters and spaces only" pattern="[A-Za-z ]+" id="last-name" name="last-name" type="text"
                       class="input last-name-input"
                       autocomplete="off"/>
            <?php endif ?>
        </div>

        <div class="form-item form-item-birthdate">
            <label for="date-of-birth" class="required-input-label">Date of birth </label>
            <?php if (isset($_GET["birthdate"]) && $_GET["birthdate"] != "null"): ?>
                <?php $birthdate = $_GET["birthdate"] ?>
                <input required id="date-of-birth" name="date-of-birth" type="date" class="input date-of-birth-input"
                       value="<?php echo $birthdate ?>" autocomplete="off"/>
            <?php else: ?>
                <input required id="date-of-birth" name="date-of-birth" type="date" class="input date-of-birth-input"
                       autocomplete="off"/>
            <?php endif ?>
        </div>

        <div class="form-item form-item-email">
            <label for="email" class="required-input-label">Email </label>
            <?php if (isset($_GET["email"]) && $_GET["email"] != "null"): ?>
                <?php $email = $_GET["email"] ?>
                <input title="Correct email format" pattern="[A-Za-z0-9._]+@[A-Za-z0-9.]+.[A-Za-z0-9.]+" required id="email" name="email"
                       type="email" class="input email-input"
                       value="<?php echo $email ?>" autocomplete="off"/>
            <?php else: ?>
                <input title="Correct email format" pattern="[A-Za-z0-9._]+@[A-Za-z0-9.]+.[A-Za-z0-9.]+" required id="email" name="email"
                       type="email" class="input email-input"
                       autocomplete="off"/>
            <?php endif ?>
        </div>

        <div class="form-item form-item-username">
            <label for="username" class="required-input-label">Username </label>
            <?php if (isset($_GET["username"]) && $_GET["username"] != "null") : ?>
                <?php $username = $_GET["username"] ?>
                <input title="Lowercase letters, numbers, underscores and full stops. Cannot start with a full stop symbol."
                       pattern="([a-z0-9_]+\.?[a-z0-9_]+)+\.?([a-z0-9_]+\.?[a-z0-9_]+)+" required id="username" name="username" type="text"
                       class="input username-input" value="<?php echo $username ?>" autocomplete="off"/>
            <?php else: ?>
                <input title="Lowercase letters, numbers, underscores and full stops. Cannot start with a full stop symbol."
                       pattern="([a-z0-9_]+\.?[a-z0-9_]+)+\.?([a-z0-9_]+\.?[a-z0-9_]+)+" required id="username" name="username" type="text"
                       class="input username-input" autocomplete="off"/>
            <?php endif ?>
        </div>

        <div class="form-item form-item-password">
            <label for="password" class="required-input-label">Password </label>
            <input title="Letters, numbers and special characters. At least one of each. Should be at least 10 characters long."
                   pattern="[A-Za-z0-9~`!@#$%^&*()-_+={}\[\]|\\\/:;\&quot;'<>,.?]+" required
                   id="password" name="password" type="password"
                   class="input password-input" autocomplete="off"/>
        </div>

        <div class="form-item form-item-password-repeat">
            <label for="password-repeat" class="required-input-label">Repeat password </label>
            <input title="Letters, numbers and special characters. At least one of each. Should be at least 10 characters long."
                   pattern="[A-Za-z0-9~`!@#$%^&*()-_+={}\[\]|\\\/:;\&quot;'<>,.?]+" required id="password-repeat" name="password-repeat"
                   type="password"
                   class="input password-input password-repeat-input" autocomplete="off"/>
        </div>
    </div>

    <button class="btn" type="submit" name="submit">Sign up</button>

    <?php if ($errorCode === "weakpassword"): ?>
        <div class="message error-message">
            The password that you have entered is weak. Password must be at least 10 characters long and contain at
            least
            one symbol from each of the following groups: capital letters (A-Z), small letters (a-z), digits (0-9) and
            special characters (*, ^, %, $, ?, etc).
        </div>
    <?php elseif ($errorCode !== null): ?>
        <div class="message error-message">
            <?php echo $errorMessage ?>
        </div>
    <?php endif ?>

</form>

<div>Already have an account? <a class="link inviting-link" href="login.php">Log in</a>.</div>

<?php
include_once "footer.php"
?>



