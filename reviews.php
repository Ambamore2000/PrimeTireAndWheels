<?php

$db = new SQLite3('reviews.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

$db->exec(
    'CREATE TABLE IF NOT EXISTS "reviews" (
    "email" VARCHAR(100) PRIMARY KEY NOT NULL,
    "firstName" VARCHAR(50) NOT NULL,
    "lastName" VARCHAR(50),
    "rating" INTEGER NOT NULL,
    "reviewMessage" TEXT NOT NULL,
    "date" DATE NOT NULL
  )'
);

$reviews_sql = $db->prepare("SELECT * FROM 'reviews'");
$reviews = $reviews_sql->execute();

$count_ratings_sql = $db->prepare("SELECT COUNT(email) AS count FROM 'reviews'");
$count_ratings = $count_ratings_sql->execute();

$count = $count_ratings->fetchArray(SQLITE3_ASSOC)["count"];

$average_ratings_sql = $db->prepare("SELECT AVG(rating) AS average FROM 'reviews'");
$average_ratings = $average_ratings_sql->execute();

$average = round($average_ratings->fetchArray(SQLITE3_ASSOC)["average"],2);

$rating = $first_name = $last_name = $email = $review_message = "";
$rating_error = $first_name_error = $last_name_error = $email_error = $review_message_error = "";

$is_valid_data = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["rating"])) {
        $rating_error = "Rating is required.";
        $is_valid_data = false;
    } else {
        $rating = $_POST["rating"];
    }

    if (empty($_POST["first_name"])) {
        $first_name_error =  "First name is required.";
        $is_valid_data = false;
    } else {
        $first_name = $_POST["first_name"];

        if (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
            $first_name_error = "First name can only include alphabets.";
            $is_valid_data = false;
        }
    }

    if (!empty($_POST["last_name"])) {
        $last_name = $_POST["last_name"];
        if (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
            $last_name_error = "Last name can only include alphabets.";
            $is_valid_data = false;
        }
    }

    if (empty($_POST["email"])) {
        $email_error =  "Email is required.";
        $is_valid_data = false;
    } else {
        $email = $_POST["email"];

        if (!preg_match("/^[\w]+@([\w]+\.)+[\w]{2,63}$/", $email)) {
            $email_error =  "Email is invalid.";
            $is_valid_data = false;
        }
    }

    if (empty($_POST["review_message"])) {
        $review_message_error = "Review message is required.";
        $is_valid_data = false;
    } else {
        $review_message = $_POST["review_message"];
    }

    if ($is_valid_data) {

        $exec_string = "INSERT INTO 'reviews' VALUES";
        $exec_string .= "('" . $email . "', '";
        $exec_string .= $first_name . "', '";
        $exec_string .= $last_name . "', '";
        $exec_string .= $rating . "', '";
        $exec_string .= $review_message . "', '";
        $exec_string .= date("Y-n-j") . "')";

        $db->exec($exec_string);

        $full_name = $first_name;
        if ($last_name) {
            $full_name .= " " . $last_name;
        }
        if ($email) {
            $full_name .= " (" . $email . ")";
        }

        $processed_message = "Thank you " . $full_name . " for submitting your review. " .
            "You have submitted a " . $rating . "/5 review with the message: " . $review_message;
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
            <div id="rating">
                <div id="rating_stars">
                    <?php
                    $rating_count = $average;
                    for ($x = 0; $x < $rating_count; $x++) {
                        ?><img src="/img/star-filled.png" alt="<?=$x + 1?>"><?php
                    }
                    for ($x = $rating_count; $x < 5; $x++) {
                        ?><img src="/img/star-empty.png" alt="<?=$x + 1?>"><?php
                    }
                    ?>
                </div>
                <p><?=$average?>/5 STARS</p>
                <p><?=$count?> TOTAL REVIEWS</p>
            </div>
        </div>

        <div class="section">
            <h2>LEAVE REVIEW</h2>
            <form id="form" action="" method="post">
                <div class="row">
                    <div class="column"> <!-- TODO: Fix usage of &nbsp; -->
                        <label><input type="text" name="first_name" placeholder="First Name"></label><br>
                        <span class="error" id="first_name_error"><?=$first_name_error?>&nbsp;</span>
                    </div>
                    <div class="column">
                        <label><input type="text" name="last_name" placeholder="Last Name"></label><br>
                        <span class="error" id="last_name_error"><?=$last_name_error?>&nbsp;</span>
                    </div>
                    <div class="column">
                        <label><input type="text" name="email" placeholder="E-Mail"></label><br>
                        <span class="error" id="email_error"><?=$email_error?>&nbsp;</span>
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
                <span class="error" id="rating_error"><?=$rating_error?>&nbsp;</span>
                <label>
                    <textarea id="review_message" name="review_message" placeholder="Type your review here..." ></textarea>
                </label>
                <span class="error" id="review_message_error"><?=$review_message_error?>&nbsp;</span><br>
                <input type="submit"/>
                <br><p><?=$processed_message?></p><br>
            </form>
        </div>

        <div class="section">
            <h2>PAST REVIEW</h2>
            <div id="reviews">
                <?php while ($review = $reviews->fetchArray(SQLITE3_ASSOC)) {
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
                            $rating_count = $review["rating"];
                                for ($x = 0; $x < $rating_count; $x++) {
                                    ?><img src="/img/star-filled.png" alt="<?=$x + 1?>"><?php
                                }
                                for ($x = $rating_count; $x < 5; $x++) {
                                    ?><img src="/img/star-empty.png" alt="<?=$x + 1?>"><?php
                                }
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