<?php
session_start();
if (!isset($_COOKIE["theme"])) {
    setcookie("theme", "light", time() + 60 * 60 * 24 * 30, "/");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vocabuilder</title>
    <link rel="stylesheet" href="styles/styles.css">
    <?php if (empty($_COOKIE["theme"]) || $_COOKIE["theme"] == "light"): ?>
        <link rel="stylesheet" href="styles/light.css">
    <?php else: ?>
        <link rel="stylesheet" href="styles/dark.css">
    <?php endif ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/47aca44441.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="main-container">

    <header>
        <nav class="nav-panel">
            <div class="nav-left">
                <a href="./index.php" class="nav-link">
                    <div class="nav-item logo">
                        Vocabuilder
                    </div>
                </a>
            </div>

            <div class="nav-right">
                <?php if (isset($_SESSION["userid"])): ?>
                    <a href="profile.php" class="nav-link">
                        <div class="nav-item">
                            Vocabulary
                        </div>
                    </a>
                    <a href="logout.php" class="nav-link">
                        <div class="nav-item">
                            Log out (<?php echo $_SESSION["username"] ?>)
                        </div>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">
                        <div class="nav-item">
                            Log In
                        </div>
                    </a>
                    <a href="signup.php" class="nav-link">
                        <div class="nav-item">
                            Sign Up
                        </div>
                    </a>
                <?php endif; ?>

                <?php if (empty($_COOKIE["theme"]) || $_COOKIE["theme"] == "light"): ?>
                    <a href="controllers/change-theme-controller.php?theme=dark" class="nav-link">
                        <div class="nav-item">
                            <i class="fas fa-adjust"></i>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="controllers/change-theme-controller.php?theme=light" class="nav-link">
                        <div class="nav-item">
                            <i class="fas fa-adjust"></i>
                        </div>
                    </a>
                <?php endif ?>

            </div>
        </nav>
    </header>
