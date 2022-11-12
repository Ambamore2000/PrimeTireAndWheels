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