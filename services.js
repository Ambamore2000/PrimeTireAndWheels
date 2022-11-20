function doThis() {
    alert("OKKKKAAAAYYY");
}
function attachHandlers() {
    document.getElementById("ok").onclick = doThis;
}

window.addEventListener("load", attachHandlers, true);