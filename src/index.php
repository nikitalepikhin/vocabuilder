<?php
include_once "header.php"
?>
    <link rel="stylesheet" href="styles.css">

    <main class="main-image-container">
        <div>Sign up and start learning vocabulary today!</div>
        <?php if (isset($_SESSION["userid"])): ?>
            <a class="link" href="profile.php">Let's Go!</a>
        <?php else: ?>
            <a class="link" href="signup.php">Let's Go!</a>
        <?php endif; ?>
    </main>

<?php
include_once "footer.php"
?>