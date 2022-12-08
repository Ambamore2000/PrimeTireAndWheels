function rate(amount) {
    let i;
    for (i = amount; i > 0; i--) {
        document.getElementById(i).setAttribute("src", "/img/star-filled.png");
    }
    for (i = 5; i > amount; i--) {
        document.getElementById(i).setAttribute("src", "/img/star-empty.png");
    }
    let ratingInput = document.getElementById("rating");
    ratingInput.setAttribute("value", amount);
}

function sortBy() {
    let sort_by_value = document.getElementById("sort_by").value;

    if (sort_by_value === "oldest"
        || sort_by_value === "newest"
        || sort_by_value === "highest"
        || sort_by_value === "lowest") {
        document.forms.namedItem("past_review_form").submit();
    }
}

function filterBy() {
    let filter_value = document.getElementById("filter_by").value;

    if (filter_value >= 1 && filter_value <= 5) {
        document.forms.namedItem("past_review_form").submit();
    }
}

function attachHandlers() {
    document.getElementById("1").onclick = function () { rate(1) };
    document.getElementById("2").onclick = function () { rate(2) };
    document.getElementById("3").onclick = function () { rate(3) };
    document.getElementById("4").onclick = function () { rate(4) };
    document.getElementById("5").onclick = function () { rate(5) };
    document.getElementById("sort_by").onclick = function () { sortBy() };
    document.getElementById("filter_by").onclick = function () { filterBy() };
}

window.addEventListener("load", attachHandlers, true);