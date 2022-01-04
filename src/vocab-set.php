<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
    exit();
}
require_once "header.php";
$userId = $_SESSION["userid"];
$pageNumber = $_GET["page"] ?? 1;
$limit = $_GET["limit"] ?? 5;
$orderBy = $_GET["order"] ?? "DESC";
$filter = $_GET["filter"] ?? "null";
?>

<?php
$vocabSetId = $_GET["id"];
require_once "database/db-conn.php";
require_once "utils/utils.php";

if (isset($conn)) {
    $row = retrieveVocabSetById($conn, $vocabSetId);
    if ($row === false) {
        header("Location: profile.php?error=internal-error");
    }
    if ($row["VOCAB_SET_USER_ID"] !== $_SESSION["userid"]) {
        header("Location: not-found.php");
    }
    $vocabSetName = $row["VOCAB_SET_NAME"];
}
?>

<div class="main-content-container">
    <div class="toolbar">
        <div class="toolbar-item">
            <a class="link basic-link" href="profile.php">Go back to profile</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="add-word.php?id=<?php echo htmlspecialchars($vocabSetId) ?>">Add a new word to this set</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="rename-set.php?id=<?php echo htmlspecialchars($vocabSetId) ?>">Rename this set</a>
        </div>
        <div class="toolbar-item">
            <a class="link basic-link" href="controllers/remove-vocab-set-controller.php?id=<?php echo htmlspecialchars($vocabSetId) ?>">Delete this set</a>
        </div>
    </div>
    <div class="content">

        <form class="form-display-controls" action="vocab-set.php" method="get">

            <div class="form-display-controls-upper">
                <div class="form-display-controls-items-container">
                    <?php require_once "includes/form-select-include.php" ?>
                    <label>
                        <input name="id" value="<?php echo htmlspecialchars($vocabSetId) ?>" type="text" hidden/>
                    </label>
                    <label>
                        <input name="page" value="<?php echo htmlspecialchars($pageNumber) ?>" type="text" hidden/>
                    </label>
                    <a class="btn btn-link btn-display-options" type="submit" href='vocab-set.php?id=<?php echo htmlspecialchars($vocabSetId) ?>'>Default</a>
                </div>

                <div class="page-selector">
                    <?php
                    $result = getNumberOfWords($conn, $vocabSetId, $filter);
                    if ($result !== false) {
                        $wordsTotal = $result["WORD_ENTRY_COUNT"];
                        $numberOfPages = ceil($wordsTotal / $limit);
                    }
                    ?>

                    <?php if ($numberOfPages > 0): ?>
                        <span>Page number:</span>
                    <?php endif ?>

                    <?php for ($i = 1; $i <= $numberOfPages; $i++): ?>
                        <a class='link inviting-link'
                           href='vocab-set.php?id=<?php echo htmlspecialchars($vocabSetId) ?>&page=<?php echo htmlspecialchars($i) ?>&limit=<?php echo htmlspecialchars($limit) ?>&order=<?php echo htmlspecialchars($orderBy) ?>&filter=<?php echo htmlspecialchars($filter == null ? "null" : $filter) ?>'>
                            <?php echo htmlspecialchars($i) ?>
                        </a>
                    <?php endfor ?>
                </div>

                <div class="page-title"><?php echo htmlspecialchars($row["VOCAB_SET_NAME"]) ?></div>

                <div class="cards-content">
                    <?php $result = retrieveWordEntries($conn, $vocabSetId, $pageNumber, $limit, $orderBy, $filter); ?>
                    <?php if ($result != false): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                            $key = $row["WORD_ENTRY_KEY"];
                            $value = $row["WORD_ENTRY_VALUE"];
                            $wordEntryId = $row["WORD_ENTRY_ID"];
                            ?>
                            <a class='link vocab-set-link' href='./word.php?id=<?php echo htmlspecialchars($wordEntryId) ?>'>
                                <div class='vocab-set-card'>
                                    <div class="vocab-set-card-entry">
                                        <p class='word'><?php echo htmlspecialchars($key) ?></p>
                                        <p class='definition'><?php echo htmlspecialchars($value) ?></p>
                                    </div>
                                    <div class="vocab-set-card-removal-btn">
                                        <a class='link removal-link'
                                           href='controllers/remove-word-controller.php?id=<?php echo htmlspecialchars($wordEntryId) ?>'>Remove</a>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class='vocab-set-card vocab-set-card-empty'>No words have been found</div>
                    <?php endif ?>
                </div>
            </div>

            <div class="form-display-controls-lower">
                <div class="page-selector">
                    <?php
                    $result = getNumberOfWords($conn, $vocabSetId, $filter);
                    if ($result !== false) {
                        $wordsTotal = $result["WORD_ENTRY_COUNT"];
                        $numberOfPages = ceil($wordsTotal / $limit);
                    }
                    ?>

                    <?php if ($numberOfPages > 0): ?>
                        <span>Page number:</span>
                    <?php endif ?>

                    <?php for ($i = 1; $i <= $numberOfPages; $i++): ?>
                        <a class='link inviting-link'
                           href='vocab-set.php?id=<?php echo htmlspecialchars($vocabSetId) ?>&page=<?php echo htmlspecialchars($i) ?>&limit=<?php echo htmlspecialchars($limit) ?>&order=<?php echo htmlspecialchars($orderBy) ?>&filter=<?php echo htmlspecialchars($filter == null ? "null" : $filter) ?>'>
                            <?php echo htmlspecialchars($i) ?>
                        </a>
                    <?php endfor ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require_once "footer.php"
?>
