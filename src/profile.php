<?php
include_once "header.php";
require_once "database/db-conn.php";
require_once "utils/utils.php";
if (empty($_SESSION["userid"])) {
    header("Location: index.php");
}
$userId = $_SESSION["userid"];
$pageNumber = $_GET["page"] ?? 1;
$limit = $_GET["limit"] ?? 5;
$orderBy = $_GET["order"] ?? "DESC";
$filter = $_GET["filter"] ?? null;
?>

<div class="main-content-container">
    <div class="toolbar">
        <div class="toolbar-item">
            <a class="link basic-link" href="add-set.php">Create a new set</a>
        </div>
    </div>
    <div class="content">
        <form class="form-display-controls" action="profile.php" method="get">

            <div class="form-display-controls-upper">
                <div class="form-display-controls-items-container">
                    <?php require_once "includes/form-select-include.php" ?>
                    <label>
                        <input name="page" value="<?php echo $pageNumber ?>" type="text" hidden/>
                    </label>
                    <a class="btn btn-link btn-display-options" type="submit" href='profile.php'>Default</a>
                </div>

                <div class="page-selector">
                    <?php
                    $result = getNumberOfSets($conn, $userId, $filter);
                    if ($result !== false) {
                        $setsTotal = $result["VOCAB_SET_COUNT"];
                        $numberOfPages = ceil($setsTotal / $limit);
                    }
                    ?>

                    <?php if ($numberOfPages > 0): ?>
                        <span>Page number:</span>
                    <?php endif ?>

                    <?php for ($i = 1; $i <= $numberOfPages; $i++): ?>
                        <a class='link inviting-link'
                           href='profile.php?page=<?php echo $i ?>&limit=<?php echo $limit ?>&order=<?php echo $orderBy ?>&filter=<?php echo $filter == null ? "null" : $filter ?>'>
                            <?php echo $i ?>
                        </a>
                    <?php endfor ?>
                </div>

                <div class="page-title">Your Vocabulary Sets</div>

                <div class="cards-content">
                    <?php $result = retrieveVocabSets($conn, $userId, $pageNumber, $limit, $orderBy, $filter); ?>
                    <?php if ($result != false) : ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                            $userId = $row["VOCAB_SET_USER_ID"];
                            $vocabSetId = $row["VOCAB_SET_ID"];
                            $vocabSetName = $row["VOCAB_SET_NAME"];
                            ?>
                            <a class='link' href='vocab-set.php?id=<?php echo $vocabSetId ?>'>
                                <div class='vocab-set-card'><?php echo $vocabSetName ?></div>
                            </a>
                        <?php endwhile ?>
                    <?php else : ?>
                        <div class='vocab-set-card vocab-set-card-empty'>No vocabulary sets have been found</div>
                    <?php endif ?>
                </div>
            </div>

            <div class="form-display-controls-lower">
                <div class="page-selector">
                    <?php
                    $result = getNumberOfSets($conn, $userId, $filter);
                    if ($result !== false) {
                        $setsTotal = $result["VOCAB_SET_COUNT"];
                        $numberOfPages = ceil($setsTotal / $limit);
                    }
                    ?>

                    <?php if ($numberOfPages > 0): ?>
                        <span>Page number:</span>
                    <?php endif ?>

                    <?php for ($i = 1; $i <= $numberOfPages; $i++): ?>
                        <a class='link inviting-link'
                           href='profile.php?page=<?php echo $i ?>&limit=<?php echo $limit ?>&order=<?php echo $orderBy ?>&filter=<?php echo $filter == null ? "null" : $filter ?>'>
                            <?php echo $i ?>
                        </a>
                    <?php endfor ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include_once "footer.php"
?>

