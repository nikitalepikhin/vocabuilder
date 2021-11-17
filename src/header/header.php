<?php
session_start();
?>

<header>
    <nav>
        <div class="nav-left">
            <a href="../index.php" class="nav-link">
                <div class="nav-item logo">
                    Vocabuilder
                </div>
            </a>
        </div>
        <div class="nav-right">
            <?php if (isset($_SESSION["userid"])): ?>
                <a href="../profile/profile.php" class="nav-link">
                    <div class="nav-item">
                        Profile
                    </div>
                </a>
                <a href="../logout/logout.php" class="nav-link">
                    <div class="nav-item">
                        Log Out
                    </div>
                </a>
            <?php else: ?>
                <a href="../login/login.php" class="nav-link">
                    <div class="nav-item">
                        Log In
                    </div>
                </a>
                <a href="../signup/signup.php" class="nav-link">
                    <div class="nav-item">
                        Sign Up
                    </div>
                </a>
            <?php endif; ?>

        </div>
    </nav>
</header>
