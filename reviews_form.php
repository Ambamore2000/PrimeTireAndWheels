<?php

class Reviews_Form {

    private $rating;
    private $first_name;
    private $last_name;
    private $email;
    private $review_message;

    private $rating_error;
    private $first_name_error;
    private $last_name_error;
    private $email_error;
    private $review_message_error;

    private $db;
    private $processed_message;

    public function __construct() {
        $this->initialize();
    }

    private function initialize() {
        $this->rating =
        $this->first_name =
        $this->last_name =
        $this->email =
        $this->review_message =
            "";

        $this->rating_error =
        $this->first_name_error =
        $this->last_name_error =
        $this->email_error =
        $this->review_message_error =
            "";
    }

    public function getRating() {
        return $this->rating;
    }
    public function getFirstName() {
        return $this->first_name;
    }
    public function getLastName() {
        return $this->last_name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getReviewMessage() {
        return $this->review_message;
    }

    public function getRatingError() {
        return $this->rating_error;
    }
    public function getFirstNameError() {
        return $this->first_name_error;
    }
    public function getLastNameError() {
        return $this->last_name_error;
    }
    public function getEmailError() {
        return $this->email_error;
    }
    public function getReviewMessageError() {
        return $this->review_message_error;
    }

    public function getProcessedMessage() {
        return $this->processed_message;
    }

    public function validateForm(): bool {
        $is_valid_data = true;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["rating"])) {
                $this->rating_error = "Rating is required.";
                $is_valid_data = false;
            } else {
                $this->rating = $_POST["rating"];
            }

            if (empty($_POST["first_name"])) {
                $this->first_name_error =  "First name is required.";
                $is_valid_data = false;
            } else {
                $this->first_name = $_POST["first_name"];

                if (!preg_match("/^[a-zA-Z]+$/", $this->first_name)) {
                    $this->first_name_error = "First name can only include alphabets.";
                    $is_valid_data = false;
                }
            }

            if (!empty($_POST["last_name"])) {
                $this->last_name = $_POST["last_name"];
                if (!preg_match("/^[a-zA-Z]+$/", $this->last_name)) {
                    $this->last_name_error = "Last name can only include alphabets.";
                    $is_valid_data = false;
                }
            }

            if (empty($_POST["email"])) {
                $this->email_error =  "Email is required.";
                $is_valid_data = false;
            } else {
                $this->email = $_POST["email"];

                if (!preg_match("/^[\w]+@([\w]+\.)+[\w]{2,63}$/", $this->email)) {
                    $this->email_error =  "Email is invalid.";
                    $is_valid_data = false;
                }
            }

            if (empty($_POST["review_message"])) {
                $this->review_message_error = "Review message is required.";
                $is_valid_data = false;
            } else {
                $this->review_message = $_POST["review_message"];
            }
        }

        if ($is_valid_data) {
            $full_name = $this->getFirstName();

            if ($this->getLastName()) {
                $full_name .= " " . $this->getLastName();
            }
            if ($this->getEmail()) {
                $full_name .= " (" . $this->getEmail() . ")";
            }

            $this->processed_message = "Thank you " .
                $full_name .
                " for submitting your review. You have submitted a " .
                $this->getRating() .
                "/5 review with the message: " .
                $this->getReviewMessage();
        }

        return $is_valid_data;
    }
}