<?php
include_once "header.php"
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
    </main>

<?php
include_once "footer.php"
?>