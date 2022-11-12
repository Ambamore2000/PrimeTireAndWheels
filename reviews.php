<?php include("reviews_process.php"); ?>
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
            <form action="reviews_process.php" method="post">
                <label><input type="text" name="first_name" placeholder="First Name"></label>
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