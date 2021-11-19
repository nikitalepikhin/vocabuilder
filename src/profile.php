<?php
include_once "header.php";
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
?>

<div class="main-content-container">
    <div class="toolbar">
        <div class="toolbar-item">
            <a class="link basic-link" href="addset.php">Create a new set</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="#">Update your profile (coming later)</a>
        </div>

    </div>
    <div class="content">
        <?php
        require_once "database/db.conn.php";
        require_once "utils/utils.php";
        if (isset($conn)) {
            $userId = $_SESSION["userid"];
            $result = retrieveVocabSets($conn, $userId, 1, 10);
            if ($result != false) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userId = $row["VOCAB_SET_USER_ID"];
                    $vocabSetId = $row["VOCAB_SET_ID"];
                    $vocabSetName = $row["VOCAB_SET_NAME"];
                    echo "<a class='link' href='vocabset.php?id=$vocabSetId'><div class='vocab-set-card'>$vocabSetName</div></a>";
                }
            } else {
                echo "<div class='vocab-set-card'>You have no vocabulary sets.</div>";
            }
        }
        ?>
    </div>
</div>

<?php
include_once "footer.php"
?>

