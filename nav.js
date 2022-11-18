function getATag(hyperlink, text, current) {
    let aTag = document.createElement('a');
    aTag.setAttribute('href',hyperlink);
    aTag.innerText = text;
    if (hyperlink === current) {
        aTag.setAttribute('class', "active");
    }
    return aTag;
}

function loadNavBar(current) {
    let nav_element = document.getElementById("nav");

    let appointmentATag = getATag("appointment.html", "Appointment", current);
    let contactATag = getATag("contact.html", "Contact", current);
    let reviewsATag = getATag("reviews.php", "Reviews", current);
    let servicesATag = getATag("services.php", "Services", current);
    let homeATag = getATag("index.html", "Home", current);

    nav_element.appendChild(appointmentATag);
    nav_element.appendChild(contactATag);
    nav_element.appendChild(reviewsATag);
    nav_element.appendChild(servicesATag);
    nav_element.appendChild(homeATag);
}