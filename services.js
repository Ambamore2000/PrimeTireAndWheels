const COLUMN_COUNT = 8;

function move(input) {
    let carsDiv = document.getElementById("cars_section");
    let carsList = Array.from(carsDiv.children);
    carsList = carsList.splice(1, carsList.length - 2);

    let firstInstanceOfShow = -1;
    let i;
    for (i = 0; i < carsList.length; i++) {
        let elementToCheck = document.getElementById((i + 1).toString());
        if (elementToCheck.className === "cars_show") {
            firstInstanceOfShow = i + 1;
            break;
        }
    }

    for (i = firstInstanceOfShow; i < firstInstanceOfShow + COLUMN_COUNT; i++) {
        let elementToCheck = document.getElementById((i).toString());
        elementToCheck.className = "cars_hidden";
    }

    let firstExpression;
    let secondExpression;

    if (input === "right") {
        if (firstInstanceOfShow + COLUMN_COUNT >= carsList.length) {
            firstExpression = 1;
            secondExpression = COLUMN_COUNT + 1;
        } else {
            firstExpression = firstInstanceOfShow + COLUMN_COUNT;
            secondExpression = firstInstanceOfShow + COLUMN_COUNT * 2;
        }
    } else if (input === "left") {
        if (firstInstanceOfShow === 1) {
            firstExpression = carsList.length + 1 - COLUMN_COUNT;
            secondExpression = carsList.length + 1;
        } else {
            firstExpression = firstInstanceOfShow - COLUMN_COUNT;
            secondExpression = firstInstanceOfShow;
        }
    }

    for (i = firstExpression; i < secondExpression; i++) {
        let elementToCheck = document.getElementById((i).toString());
        elementToCheck.className = "cars_show";
    }
}

function attachHandlers() {
    document.getElementById("right_button").onclick = function () { move("right") };
    document.getElementById("left_button").onclick = function () { move("left") };
}

window.addEventListener("load", attachHandlers, true);