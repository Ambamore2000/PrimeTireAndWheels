<?php

include("reviews_sql.php");
$reviews_sql = new Reviews_SQL();

include("reviews_form.php");
$reviews_form = new Reviews_Form();

if ($_POST["is_submit"]) {
    if ($reviews_form->validateForm()) {
        $reviews_sql->addReview(
            $reviews_form->getEmail(),
            $reviews_form->getFirstName(),
            $reviews_form->getLastName(),
            $reviews_form->getRating(),
            $reviews_form->getReviewMessage());
    }
}

$filter = "";
if ($_POST["filter_by"] || $_POST["sort_by"]) {
    $filter = $_POST["filter_by"];

    if ($filter == "no_filter") {
        $filter = "";
    }
    $sort_power = $_POST["sort_by"];

    if ($sort_power === "newest") {
        $reviews_sql->setReviewsDefault("date", "DESC", $filter);
    } else if ($sort_power === "oldest") {
        $reviews_sql->setReviewsDefault("date", "ASC", $filter);
    } else if ($sort_power === "highest") {
        $reviews_sql->setReviewsDefault("rating", "DESC", $filter);
    } else if ($sort_power === "lowest") {
        $reviews_sql->setReviewsDefault("rating", "ASC", $filter);
    }
}

function loadStars($count) {
    $count_int = (int) $count;
    for ($x = 0; $x < $count_int; $x++) {
        ?><img src="/img/star-filled.png" alt="<?=$x + 1?>"><?php
    }
    for ($x = $count_int; $x < 5; $x++) {
        ?><img src="/img/star-empty.png" alt="<?=$x + 1?>"><?php
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reviews</title>
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="audiogalaxy.css">
        <link rel="stylesheet" href="reviews.css">
        <link rel="stylesheet" href="nav.css">
        <script src="nav.js" type="text/javascript"></script>
        <script src="reviews.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="nav">
        </div>

        <div class="section">
            <h1>REVIEWS</h1>
            <h2>RATING</h2>
            <div id="rating_section">
                <div id="rating_stars">
                    <?php
                    loadStars(floor($reviews_sql->getAverage()));
                    ?>
                </div>
                <p><?=$reviews_sql->getAverage()?>/5 STARS</p>
                <p><?=$reviews_sql->getCount()?> TOTAL REVIEWS</p>
            </div>
        </div>

        <div class="section">
            <h2>LEAVE REVIEW</h2>
            <form id="review_form" action="" method="post">
                <input type="hidden" id="is_submit" name="is_submit" value="true">
                <div class="row">
                    <div class="column"> <!-- TODO: Fix usage of &nbsp; -->
                        <label><input type="text" name="first_name" placeholder="First Name"></label><br>
                        <span class="error" id="first_name_error"><?=$reviews_form->getFirstNameError()?>&nbsp;</span>
                    </div>
                    <div class="column">
                        <label><input type="text" name="last_name" placeholder="Last Name"></label><br>
                        <span class="error" id="last_name_error"><?=$reviews_form->getLastNameError()?>&nbsp;</span>
                    </div>
                    <div class="column">
                        <label><input type="text" name="email" placeholder="E-Mail"></label><br>
                        <span class="error" id="email_error"><?=$reviews_form->getEmailError()?>&nbsp;</span>
                    </div>
                </div>
                <div id="stars">
                    <img src="/img/star-empty.png" id="1" alt="1">
                    <img src="/img/star-empty.png" id="2" alt="2">
                    <img src="/img/star-empty.png" id="3" alt="3">
                    <img src="/img/star-empty.png" id="4" alt="4">
                    <img src="/img/star-empty.png" id="5" alt="5">
                </div>
                <input type="hidden" id="rating" name="rating">
                <span class="error" id="rating_error"><?=$reviews_form->getRatingError()?>&nbsp;</span>
                <label>
                    <textarea id="review_message" name="review_message" placeholder="Type your review here..." ></textarea>
                </label>
                <span class="error" id="review_message_error"><?=$reviews_form->getReviewMessageError()?>&nbsp;</span><br>
                <input type="submit"/>
                <br><p><?=$reviews_form->getProcessedMessage()?></p><br>
            </form>
        </div>

        <div class="section">
            <h2>PAST REVIEW</h2>
            <form id="past_review_form" action="" method="post">
                <label for="sort_by"></label>
                <select name="sort_by" id="sort_by">
                    <option value="none" selected disabled hidden>Sort By</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="highest">Highest Rated</option>
                    <option value="lowest">Lowest Rated</option>
                </select>
                <script>
                    restoreElement("sort_by", "<?= $_POST['sort_by'] ?>");
                </script>
                <label for="filter_by"></label>
                <select name="filter_by" id="filter_by">
                    <option value="none" selected disabled hidden>Filter By</option>
                    <option value="no_filter">No Filter</option>
                    <option value="5">5 stars</option>
                    <option value="4">4 stars</option>
                    <option value="3">3 stars</option>
                    <option value="2">2 stars</option>
                    <option value="1">1 stars</option>
                </select>
                <script>
                    restoreElement("filter_by", "<?= $_POST['filter_by'] ?>");
                </script>
            </form>
            <div id="reviews">
                <?php while ($review = $reviews_sql->getReviews()->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                    <div id="review">
                        <?php
                        $name = $review["firstName"];
                        if ($review["lastName"]) {
                            $name .= " " . $review["lastName"];
                        }
                        ?>
                        <h3><?= $name ?></h3>
                        <p><?= $review["date"] ?></p>
                        <div id="reviews_stars">
                            <?php
                            loadStars($review["rating"]);
                            ?>
                        </div>
                        <p><?= $review["reviewMessage"] ?></p>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </body>
</html>