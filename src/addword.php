<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
$vocabSetId = $_GET["id"];
?>

<div>
    <form action="controllers/addword.controller.php?id=<?php echo $vocabSetId ?>" method="post">
        <h1>Add a new word</h1>
        <label for="word">Word</label>
        <input type="text" id="word" name="word">
        <label for="definition">Definition</label>
        <input type="text" id="definition" name="definition">
        <button type="submit" id="submit" name="submit">Add</button>
    </form>
    <a href="vocabset.php?id=<?php echo $vocabSetId ?>">Go back to the set</a>
</div>

<?php
include_once "footer.php"
?>
