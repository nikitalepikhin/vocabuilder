<?php
include_once "header.php";
error_reporting(0);
if (isset($_SESSION["userid"])) {
    header("Location: profile.php");
}
?>

<div class="form-container">
    <h1 class="title">Create an account</h1>
    <form action="controllers/signup.controller.php" method="post">
        <div class="form-elements-wrapper">
            <div class="form-element">
                <label for="first-name">First Name: </label>
                <?php
                if (isset($_GET["first"]) && $_GET["first"] != "null") {
                    $first = $_GET["first"];
                    echo '<input id="first-name" name="first-name" type="text" placeholder="First name" class="input first-name-input" value="' . $first . '" autocomplete="off"/>';
                } else {
                    echo '<input id="first-name" name="first-name" type="text" placeholder="First name" class="input first-name-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="last-name">Last Name: </label>
                <?php
                if (isset($_GET["last"]) && $_GET["last"] != "null") {
                    $last = $_GET["last"];
                    echo '<input id="last-name" name="last-name" type="text" placeholder="Last name" class="input last-name-input" value="' . $last . '" autocomplete="off"/>';
                } else {
                    echo '<input id="last-name" name="last-name" type="text" placeholder="Last name" class="input last-name-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="date-of-birth" class="required-input-label">Date of birth: </label>
                <?php
                if (isset($_GET["birthdate"]) && $_GET["birthdate"] != "null") {
                    $birthdate = $_GET["birthdate"];
                    echo '<input required id="date-of-birth" name="date-of-birth" type="date" class="input date-of-birth-input" value="' . $birthdate . '" autocomplete="off"/>';
                } else {
                    echo '<input required id="date-of-birth" name="date-of-birth" type="date" class="input date-of-birth-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="e-mail" class="required-input-label">E-mail: </label>
                <?php
                if (isset($_GET["email"]) && $_GET["email"] != "null") {
                    $email = $_GET["email"];
                    echo '<input required id="e-mail" name="e-mail" type="email" placeholder="E-mail" class="input email-input" value="' . $email . '" autocomplete="off"/>';
                } else {
                    echo '<input required id="e-mail" name="e-mail" type="email" placeholder="E-mail" class="input email-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="username" class="required-input-label">Username: </label>
                <?php
                if (isset($_GET["username"]) && $_GET["username"] != "null") {
                    $username = $_GET["username"];
                    echo '<input required id="username" name="username" type="text" placeholder="Username" class="input username-input" value="' . $username . '" autocomplete="off"/>';
                } else {
                    echo '<input required id="username" name="username" type="text" placeholder="Username" class="input username-input" autocomplete="off"/>';
                }
                ?>
            </div>

            <div class="form-element">
                <label for="password" class="required-input-label">Password: </label>
                <input required id="password" name="password" type="password" placeholder="Password"
                       class="input password-input" autocomplete="off"/>
            </div>

            <div class="form-element">
                <label for="password-repeat" class="required-input-label">Repeat password: </label>
                <input required id="password-repeat" name="password-repeat" type="password"
                       placeholder="Repeat password"
                       class="input password-input" autocomplete="off"/>
            </div>

            <button class="btn" type="submit" name="submit">Sign Up</button>
        </div>
    </form>
    <div>Already have an account? <a href="login.php">Log in</a>.</div>
</div>

<?php
if (isset($_GET["error"])) {
    $errorCode = $_GET["error"];
    require_once "utils/errorhandlers.php";
    $errorMessage = getErrorMessage($errorCode);
}
?>

<?php if ($errorCode === "weakpassword"): ?>
    <div class="message error-message">
        <p>The password that you have entered is weak.</p>
        <p>Password must be at least 10 characters long and
            contain at least one symbol from each of the following groups:</p>
        <p>capital letters (A-Z), small letters (a-z), digits (0-9) and special characters (*, ^, %, $, ?, etc).</p>
    </div>
<?php elseif ($errorCode !== null): ?>
    <div class="message error-message">
        <p><?php echo $errorMessage ?></p>
    </div>
<?php endif ?>

<?php
include_once "footer.php"
?>



