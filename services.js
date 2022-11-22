const COLUMN_COUNT = 8;

function doThis() {
    let carsDiv = document.getElementById("cars_img");
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

function attachHandlers() {
    document.getElementById("ok").onclick = doThis;
}

window.addEventListener("load", attachHandlers, true);