<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vocabuilder</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">

    <header>
        <nav>
            <div class="nav-left">
                <a href="index.php" class="nav-link">
                    <div class="nav-item logo">
                        Vocabuilder
                    </div>
                </a>
            </div>
            <div class="nav-right">
                <?php if (isset($_SESSION["userid"])): ?>
                    <a href="profile.php" class="nav-link">
                        <div class="nav-item">
                            <?php echo $_SESSION["username"] ?>
                        </div>
                    </a>
                    <a href="logout.php" class="nav-link">
                        <div class="nav-item">
                            Log Out
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

            </div>
        </nav>
    </header>
