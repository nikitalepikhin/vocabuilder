<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vocabuilder</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">

    <?php
    include_once "header/header.php"
    ?>

    <main>
        <div>Sign up and start learning vocabulary today!</div>
        <?php if (isset($_SESSION["userid"])): ?>
            <form action="profile/profile.php" method="get">
                <button type="submit">Let's Go!</button>
            </form>
        <?php else: ?>
            <form action="signup/signup.php" method="get">
                <button type="submit">Let's Go!</button>
            </form>
        <?php endif; ?>
    </main>

<?php
include_once "footer/footer.php"
?>