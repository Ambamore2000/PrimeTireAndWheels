<?php

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

    if (!empty($_POST["email"])) {
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
        $full_name = $first_name;
        if ($last_name) {
            $full_name .= " " . $last_name;
        }
        if ($email) {
            $full_name .= " (" . $email . ")";
        }

        $processed_message = "Thank you " . $full_name . " for submitting your review. " .
            "You have submitted a " . $rating . "/5 review with the message:" . $review_message;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reviews</title>
        <link rel="stylesheet" href="reviews.css">
        <link rel="stylesheet" href="nav.css">
    </head>
    <body>
        <div class="nav">
            <!--TODO: Fix image sizing... crop? new logo?
            <img src="img/logo.png" alt="Logo">-->
            <a href="appointment.html">Appointment</a>
            <a href="contact.html">Contact</a>
            <a class="active" href="reviews.php">Reviews</a>
            <a href="services.html">Services</a>
            <a href="index.html">Home</a>
        </div>

        <div id="reviews">
            <h1>REVIEWS</h1>
            <h2>RATING</h2>
            <!--TODO: Get Reviews Data; Sum(All Ratings)/5 = Rating -->
            <h2>LEAVE REVIEW</h2>
            <form action="" method="post">
                <label><input type="text" name="first_name" placeholder="First Name"></label>
                <span class="error" id="first_name_error"></span><br>
                <label><input type="text" name="last_name" placeholder="Last Name"></label>
                <br>
                <label><input type="text" name="email" placeholder="E-Mail"></label>
                <br>
                <fieldset>
                    <label><input type="radio" name="rating" value="5"/>5</label>
                    <label><input type="radio" name="rating" value="4"/>4</label>
                    <label><input type="radio" name="rating" value="3"/>3</label>
                    <label><input type="radio" name="rating" value="2"/>2</label>
                    <label><input type="radio" name="rating" value="1"/>1</label>
                </fieldset>
                <label>
                    <textarea name="review_message" rows="5" cols="50" placeholder="Type your review here..."></textarea>
                </label>
                <br>
                <input type="submit"/>
            </form>
            <h2>PAST REVIEW</h2>
        </div>
    </body>
</html>