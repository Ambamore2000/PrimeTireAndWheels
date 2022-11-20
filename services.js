let badVariable = 8;

function doThis() {
    let carsDiv = document.getElementById("cars_img");
    let carsList = carsDiv.children;

    if (badVariable === 0) {
        let i;

        for (i = 32 - 8; i < 32; i++) {
            let car = carsList[i];
            car.className = "cars_hidden";
        }

        for (i = 0; i < 8; i++) {
            let car = carsList[i];
            car.className = "cars_show";
        }
    } else {
        let i;

        for (i = badVariable - 8; i < badVariable; i++) {
            let car = carsList[i];
            car.className = "cars_hidden";
        }

        for (i = badVariable; i < badVariable + 8; i++) {
            let car = carsList[i];
            car.className = "cars_show";
        }
    }

    badVariable += 8;

    if (badVariable === 32) {
        badVariable = 0;
    }
}

function loadImages() {
    let carsDiv = document.getElementById("cars_img");
    let carsList = carsDiv.children;
    let i;
    for (i = 8; i < carsList.length; i++) {
        let car = carsList[i];
        car.className = "cars_hidden";
    }
}

function attachHandlers() {
    loadImages();
    document.getElementById("ok").onclick = doThis;
}

window.addEventListener("load", attachHandlers, true);