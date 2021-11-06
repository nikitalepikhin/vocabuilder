<?php
include_once "../header/header.php"
?>

<?php
$username = $_SESSION["username"];
echo '<div class="message info-message">';
echo '<p>Welcome back, ' . $username . '. You have successfully logged in!</p>';
echo '</div>';
?>

<?php
include_once "../footer/footer.php"
?>

