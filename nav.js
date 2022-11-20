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

    let appointmentATag = getATag("appointment.html", "Appointment", page);
    let contactATag = getATag("contact.html", "Contact", page);
    let reviewsATag = getATag("reviews.php", "Reviews", page);
    let servicesATag = getATag("services.php", "Services", page);
    let homeATag = getATag("index.html", "Home", page);

    nav_element.appendChild(appointmentATag);
    nav_element.appendChild(contactATag);
    nav_element.appendChild(reviewsATag);
    nav_element.appendChild(servicesATag);
    nav_element.appendChild(homeATag);
}

window.onload = loadNavBar;