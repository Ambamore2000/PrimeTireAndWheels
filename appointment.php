<?php

$first_name = $last_name = $email = $phone_number = $reason = "";
$first_name_error = $last_name_error = $email_error = $phone_number_error = $reason_error = "";

$is_valid_data = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if (empty($_POST["phone_number"])) {
        $phone_number_error =  "Phone number is required.";
        $is_valid_data = false;
    } else {
        $phone_number = $_POST["phone_number"];

        if (!preg_match("/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/", $phone_number)) {
            $phone_number_error =  "Phone number is invalid.";
            $is_valid_data = false;
        }
    }

    if (empty($_POST["reason"])) {
        $reason_error = "Reason message is required.";
        $is_valid_data = false;
    } else {
        $reason = $_POST["reason"];
    }

    if ($is_valid_data) {
        $full_name = $first_name;
        if ($last_name) {
            $full_name .= " " . $last_name;
        }
        if ($email) {
            $full_name .= " (" . $email . ")";
        }

        $processed_message = "Thank you " . $full_name . " for submitting your appointment. " .
            "We will reach out to your number " . $phone_number . " shortly. " . "Your reason for " .
            "appointment: " . $reason;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Appointment</title>
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="audiogalaxy.css">
        <link rel="stylesheet" href="appointment.css">
        <link rel="stylesheet" href="nav.css">
        <script src="nav.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="nav">
        </div>

        <div class="section">
            <h1 id="first_header">SCHEDULE APPOINTMENT</h1>
            <form id="form" action="" method="post">
                <div class="row">
                    <div class="column">
                        <label><input type="text" name="first_name" placeholder="First Name: "></label>
                        <span class="error" id="first_name_error"><?=$first_name_error?>&nbsp;</span>
                    </div>
                    <div class="column">
                        <label><input type="text" name="last_name" placeholder="Last Name: "></label>
                        <span class="error" id="last_name_error"><?=$last_name_error?>&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label><input type="text" name="email" placeholder="E-Mail: "></label>
                        <span class="error" id="email_error"><?=$email_error?>&nbsp;</span>
                    </div>
                    <div class="column">
                        <label><input type="text" name="phone_number" placeholder="Phone Number: "></label>
                        <span class="error" id="phone_number_error"><?=$phone_number_error?>&nbsp;</span>
                    </div>
                </div>
                <label>
                    <textarea id="reason_message" name="reason" placeholder="Type your review here..." ></textarea>
                    <span class="error" id="reason_error"><?=$reason_error?>&nbsp;</span>
                </label>
                <input type="submit"/>
                <br><span><?=$processed_message?></span><br>
            </form>
        </div>

    </body>
</html>