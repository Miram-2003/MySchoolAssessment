document.addEventListener("DOMContentLoaded", function() {
    // Get the current URL
    var currentUrl = window.location.href;

    // Select all the links in the navigation
    var navLinks = document.querySelectorAll("#side_nav a");

    // Loop through each link
    navLinks.forEach(function(link) {
        // Check if the link's href matches the current URL
        if (link.href === currentUrl) {
            // Add the 'active' class to the parent <li> element
            link.parentElement.classList.add("active");
        }
    });
});
