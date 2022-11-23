const COLUMN_COUNT = 8;

function moveRight() {
    let carsDiv = document.getElementById("cars_array");
    let carsList = carsDiv.children;

    let firstInstanceOfShow = -1;
    let i;

    for (i = 0; i < carsList.length; i++) {
        if (carsList[i].className === "cars_show") {
            firstInstanceOfShow = i;
            break;
        }
    }

    for (i = firstInstanceOfShow; i < firstInstanceOfShow + COLUMN_COUNT; i++) {
        carsList[i].className = "cars_hidden";
    }

    let firstExpression;
    let secondExpression;

    if (firstInstanceOfShow + COLUMN_COUNT >= carsList.length) {
        firstExpression = 0;
        secondExpression = COLUMN_COUNT;
    } else {
        firstExpression = firstInstanceOfShow + COLUMN_COUNT;
        secondExpression = firstInstanceOfShow + COLUMN_COUNT*2;
    }

    for (i = firstExpression; i < secondExpression; i++) {
        carsList[i].className = "cars_show";
    }

}

function moveLeft() {
    let carsDiv = document.getElementById("cars_array");
    let carsList = carsDiv.children;

    let firstInstanceOfShow = -1;
    let i;

    for (i = 0; i < carsList.length; i++) {
        if (carsList[i].className === "cars_show") {
            firstInstanceOfShow = i;
            break;
        }
    }

    for (i = firstInstanceOfShow; i < firstInstanceOfShow + COLUMN_COUNT; i++) {
        carsList[i].className = "cars_hidden";
    }

    let firstExpression;
    let secondExpression;

    if (firstInstanceOfShow === 0) {
        firstExpression = carsList.length - COLUMN_COUNT;
        secondExpression = carsList.length;
    } else {
        firstExpression = firstInstanceOfShow - COLUMN_COUNT;
        secondExpression = firstInstanceOfShow;
    }

    for (i = firstExpression; i < secondExpression; i++) {
        carsList[i].className = "cars_show";
    }

}

function attachHandlers() {
    document.getElementById("right_button").onclick = moveRight;
    document.getElementById("left_button").onclick = moveLeft;
}

window.addEventListener("load", attachHandlers, true);