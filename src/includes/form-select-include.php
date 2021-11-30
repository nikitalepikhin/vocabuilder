<div class="display-select">
    <label for="limit-per-page-select">Items per page:</label>
    <select class="display-options-select" name="limit" id="limit-per-page-select">
        <?php if (isset($_GET["limit"]) && $_GET["limit"] == 5) : ?>
            <option selected value="5">5</option>
        <?php else : ?>
            <option value="5">5</option>
        <?php endif ?>

        <?php if (isset($_GET["limit"]) && $_GET["limit"] == 10) : ?>
            <option selected value="10">10</option>
        <?php else : ?>
            <option value="10">10</option>
        <?php endif ?>

        <?php if (isset($_GET["limit"]) && $_GET["limit"] == 20) : ?>
            <option selected value="20">20</option>
        <?php else : ?>
            <option value="20">20</option>
        <?php endif ?>

        <?php if (isset($_GET["limit"]) && $_GET["limit"] == 25) : ?>
            <option selected value="25">25</option>
        <?php else : ?>
            <option value="25">25</option>
        <?php endif ?>
    </select>
</div>

<div class="display-select">
    <label for="order-by-time-select">Order by last modified:</label>
    <select class="display-options-select" name="order" id="order-by-time-select">
        <?php if (isset($_GET["order"]) && $_GET["order"] == "DESC") : ?>
            <option selected value="DESC">Newest first</option>
        <?php else : ?>
            <option value="DESC">Newest first</option>
        <?php endif ?>
        <?php if (isset($_GET["order"]) && $_GET["order"] == "ASC") : ?>
            <option selected value="ASC">Oldest first</option>
        <?php else : ?>
            <option value="ASC">Oldest first</option>
        <?php endif ?>
    </select>
</div>

<div class="display-select">
    <label for="filter-by-first-letter-select">Filter by the first letter:</label>
    <select class="display-options-select" name="filter" id="filter-by-first-letter-select">
        <?php if (isset($_GET["filter"]) && $_GET["filter"] == null) : ?>
            <option selected value="null">-</option>
        <?php else : ?>
            <option value="null">-</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "A") : ?>
            <option selected value="A">A</option>
        <?php else : ?>
            <option value="A">A</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "B") : ?>
            <option selected value="B">B</option>
        <?php else : ?>
            <option value="B">B</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "C") : ?>
            <option selected value="C">C</option>
        <?php else : ?>
            <option value="C">C</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "D") : ?>
            <option selected value="D">D</option>
        <?php else : ?>
            <option value="D">D</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "E") : ?>
            <option selected value="E">E</option>
        <?php else : ?>
            <option value="E">E</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "F") : ?>
            <option selected value="F">F</option>
        <?php else : ?>
            <option value="F">F</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "G") : ?>
            <option selected value="G">G</option>
        <?php else : ?>
            <option value="G">G</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "H") : ?>
            <option selected value="H">H</option>
        <?php else : ?>
            <option value="H">H</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "I") : ?>
            <option selected value="I">I</option>
        <?php else : ?>
            <option value="I">I</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "J") : ?>
            <option selected value="J">J</option>
        <?php else : ?>
            <option value="J">J</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "K") : ?>
            <option selected value="K">K</option>
        <?php else : ?>
            <option value="K">K</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "L") : ?>
            <option selected value="L">L</option>
        <?php else : ?>
            <option value="L">L</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "M") : ?>
            <option selected value="M">M</option>
        <?php else : ?>
            <option value="M">M</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "N") : ?>
            <option selected value="N">N</option>
        <?php else : ?>
            <option value="N">N</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "O") : ?>
            <option selected value="O">O</option>
        <?php else : ?>
            <option value="O">O</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "P") : ?>
            <option selected value="P">P</option>
        <?php else : ?>
            <option value="P">P</option>
        <?php endif ?>
        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "Q") : ?>
            <option selected value="Q">Q</option>
        <?php else : ?>
            <option value="Q">Q</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "R") : ?>
            <option selected value="R">R</option>
        <?php else : ?>
            <option value="R">R</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "S") : ?>
            <option selected value="S">S</option>
        <?php else : ?>
            <option value="S">S</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "T") : ?>
            <option selected value="T">T</option>
        <?php else : ?>
            <option value="T">T</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "U") : ?>
            <option selected value="U">U</option>
        <?php else : ?>
            <option value="U">U</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "V") : ?>
            <option selected value="V">V</option>
        <?php else : ?>
            <option value="V">V</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "W") : ?>
            <option selected value="W">W</option>
        <?php else : ?>
            <option value="W">W</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "X") : ?>
            <option selected value="X">X</option>
        <?php else : ?>
            <option value="X">X</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "Y") : ?>
            <option selected value="Y">Y</option>
        <?php else : ?>
            <option value="Y">Y</option>
        <?php endif ?>

        <?php if (isset($_GET["filter"]) && $_GET["filter"] == "Z") : ?>
            <option selected value="Z">Z</option>
        <?php else : ?>
            <option value="Z">Z</option>
        <?php endif ?>
    </select>
</div>

<button class="btn btn-display-options" type="submit">Apply</button>