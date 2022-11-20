<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Services</title>
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="services.css">
        <link rel="stylesheet" href="nav.css">
        <script src="nav.js" type="text/javascript"></script>
        <script src="services.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="nav">
        </div>

        <div id="services">
            <h1>SERVICES</h1>
            <h2>SERVICES OFFERED</h2>
            <ul>
                <?php
                foreach(file("services.txt", FILE_IGNORE_NEW_LINES) as $service_info) {
                    list($service_name, $service_desc) = explode(":", $service_info);
                    ?>
                    <li title="<?=$service_desc?>" class="services"><?=$service_name?></li>
                    <?php
                }
                ?>
            </ul>

            <div id="cars">
                <h2>CARS WE SERVICE</h2>

                <div id="cars_img">
                    <img id="1" src="img/cars/car_placeholder.png" alt="Car" >
                    <img id="2" src="img/cars/car_placeholder_two.png" alt="Car" >
                    <img id="3" src="img/cars/car_placeholder.png" alt="Car" >
                    <img id="4" src="img/cars/car_placeholder_two.png" alt="Car" >
                    <img id="5" src="img/cars/car_placeholder.png" alt="Car" >
                    <img id="6" src="img/cars/car_placeholder_two.png" alt="Car" >
                    <img id="7" src="img/cars/car_placeholder.png" alt="Car" >
                    <img id="8" src="img/cars/car_placeholder_two.png" alt="Car" >
                    <img id="9" src="img/cars/car_placeholder.png" alt="Car" >
                    <img id="10" src="img/cars/car_placeholder_two.png" alt="Car" >
                    <img id="11" src="img/cars/car_placeholder.png" alt="Car" >
                    <img id="12" src="img/cars/car_placeholder_two.png" alt="Car" >
                </div>

                <button id="ok">Click me</button>
            </div>
        </div>

    </body>
</html>