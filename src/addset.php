<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
?>

<div>
    <form action="controllers/addvocabset.controller.php" method="post">
        <h1>Add a new vocabulary set</h1>
        <label for="setName">Set name</label>
        <input type="text" id="setName" name="setName">
        <button type="submit" id="submit" name="submit">Add</button>
    </form>
    <a href="profile.php">Go back to profile</a>
</div>


<?php
include_once "footer.php"
?>
