<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Services</title>
        <link rel="stylesheet" href="services.css">
        <link rel="stylesheet" href="nav.css">
        <script src="services.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="nav">
            <!--TODO: Fix image sizing... crop? new logo?
            <img src="img/logo.png" alt="Logo">-->
            <a href="appointment.html">Appointment</a>
            <a href="contact.html">Contact</a>
            <a href="reviews.php">Reviews</a>
            <a class="active" href="services.php">Services</a>
            <a href="index.html">Home</a>
        </div>

        <div id="services">
            <h1>SERVICES</h1>
            <h2>SERVICES OFFERED</h2>
            <ul>
                <?php
                foreach(file("services.txt", FILE_IGNORE_NEW_LINES) as $service_info) {
                    list($service_name, $service_desc) = explode(":", $service_info);
                    ?>
                    <li title="<?=$service_desc?>"><?=$service_name?></li>
                    <?php
                }
                ?>
            </ul>

            <div id="cars">
                <h2>CARS WE SERVICE</h2>

                <div id="cars_img">
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                    <img src="img/cars/car_placeholder.png" alt="Car" >
                </div>
            </div>
        </div>

    </body>
</html>