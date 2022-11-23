<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Services</title>
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="audiogalaxy.css">
        <link rel="stylesheet" href="services.css">
        <link rel="stylesheet" href="nav.css">
        <script src="nav.js" type="text/javascript"></script>
        <script src="services.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="nav">
        </div>

        <div class="section">
            <h1 id="first_header">SERVICES</h1>
            <h2>SERVICES OFFERED</h2>
            <div id="services">
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
            </div>
        </div>

        <div class="section">
            <h2>CARS WE SERVICE</h2>
            <div id="cars_section">
                <input class="cars_button" id="left_button" type="image" src="/img/left.png"  alt="Left"/>
                <div id="cars_array">
                    <img id="1" src="img/cars/red_square.png" alt="Car" class="cars_show">
                    <img id="2" src="img/cars/blue_square.png" alt="Car" class="cars_show">
                    <img id="3" src="img/cars/green_square.png" alt="Car" class="cars_show">
                    <img id="4" src="img/cars/red_square.png" alt="Car" class="cars_show">
                    <img id="5" src="img/cars/blue_square.png" alt="Car" class="cars_show">
                    <img id="6" src="img/cars/green_square.png" alt="Car" class="cars_show">
                    <img id="7" src="img/cars/red_square.png" alt="Car" class="cars_show">
                    <img id="8" src="img/cars/blue_square.png" alt="Car" class="cars_show">
                    <img id="9" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="10" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="11" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="12" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="13" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="14" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="15" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="16" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="17" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="18" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="19" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="20" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="21" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="22" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="23" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="24" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="25" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="26" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="27" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="28" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="29" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                    <img id="30" src="img/cars/green_square.png" alt="Car" class="cars_hidden">
                    <img id="31" src="img/cars/red_square.png" alt="Car" class="cars_hidden">
                    <img id="32" src="img/cars/blue_square.png" alt="Car" class="cars_hidden">
                </div>
                <input class="cars_button" id="right_button" type="image" src="/img/right.png"  alt="Right"/>
            </div>
        </div>

    </body>
</html>