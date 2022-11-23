function rate(amount) {
    let i;
    for (i = amount; i > 0; i--) {
        document.getElementById(i).setAttribute("src", "/img/star-filled-animation.gif");
    }
    for (i = 5; i > amount; i--) {
        document.getElementById(i).setAttribute("src", "/img/star-empty.png");
    }
}

function attachHandlers() {
    document.getElementById("1").onclick = function () { rate(1) };
    document.getElementById("2").onclick = function () { rate(2) };
    document.getElementById("3").onclick = function () { rate(3) };
    document.getElementById("4").onclick = function () { rate(4) };
    document.getElementById("5").onclick = function () { rate(5) };
}

window.addEventListener("load", attachHandlers, true);