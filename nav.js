function getATag(hyperlink, text, current) {
    let aTag = document.createElement('a');
    aTag.setAttribute('href',hyperlink);
    aTag.innerText = text;
    if (hyperlink === current) {
        aTag.setAttribute('class', "active");
    }
    return aTag;
}

function loadNavBar() {
    let path = window.location.pathname;
    let page = path.split("/").pop();

    let nav_element = document.getElementById("nav");

    let homeATag = getATag("index.html", "Home", page);
    let servicesATag = getATag("services.php", "Services", page);
    let reviewsATag = getATag("reviews.php", "Reviews", page);
    let contactATag = getATag("contact.html", "Contact", page);
    let appointmentATag = getATag("appointment.php", "Appointment", page);

    nav_element.appendChild(homeATag);
    nav_element.appendChild(servicesATag);
    nav_element.appendChild(reviewsATag);
    nav_element.appendChild(contactATag);
    nav_element.appendChild(appointmentATag);
}

window.onload = loadNavBar;