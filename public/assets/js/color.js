// Enable Dark Mode Function
document.addEventListener("DOMContentLoaded", function() {
    const themeToggleBtn = document.getElementById('toggle-theme');
    const themeIcon = document.getElementById('theme-icon');
    const body = document.body;
    const logo = document.getElementById('logo');

    // Check if dark mode is already active from a previous session
    if (localStorage.getItem('dark-mode') === 'true') {
        enableDarkMode(); // Enable dark mode if it was active last time
    }

    // Toggle theme on button click
    themeToggleBtn.addEventListener('click', function() {
        if (localStorage.getItem('dark-mode') === 'true') {
            disableDarkMode(); // Switch to light mode
        } else {
            enableDarkMode(); // Switch to dark mode
        }
    });

    // Function to enable dark mode
    function enableDarkMode() {
        body.classList.add('dark-theme'); // Add dark theme class to body
        logo.src = "/assets/img/dark-logo.png"; // Change logo to dark version
        themeIcon.classList.remove('fi-rr-brightness'); // Change icon to moon
        themeIcon.classList.add('fi-rr-moon');
        localStorage.setItem('dark-mode', 'true'); // Save dark mode state
        document.getElementById('dark-theme-css').disabled = false; // Load dark theme CSS
    }

    // Function to disable dark mode
    function disableDarkMode() {
        body.classList.remove('dark-theme'); // Remove dark theme class from body
        logo.src = "/assets/img/logo.png"; // Change logo back to the light version
        themeIcon.classList.remove('fi-rr-moon'); // Change icon back to brightness
        themeIcon.classList.add('fi-rr-brightness');
        localStorage.setItem('dark-mode', 'false'); // Remove dark mode state
        document.getElementById('dark-theme-css').disabled = true; // Disable dark theme CSS
    }
});


