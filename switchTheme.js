document.addEventListener("DOMContentLoaded", () => {
    const themeSwitcher = document.getElementById("themeSwitcher");
    const body = document.body;
    const navbar = document.querySelector(".navbar");

    // Check for saved user theme preference
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark-mode");
        navbar.classList.replace("navbar-light", "navbar-dark");
        themeSwitcher.innerHTML = '<i class="bi bi-sun-fill"></i>';
    }

    // Toggle theme on button click
    themeSwitcher.addEventListener("click", () => {
        body.classList.toggle("dark-mode");
        navbar.classList.toggle("navbar-dark");
        navbar.classList.toggle("navbar-light");

        // Update button icon and save theme preference
        if (body.classList.contains("dark-mode")) {
            themeSwitcher.innerHTML = '<i class="bi bi-sun-fill"></i>';
            localStorage.setItem("theme", "dark");
        } else {
            themeSwitcher.innerHTML = '<i class="bi bi-moon-fill"></i>';
            localStorage.setItem("theme", "light");
        }
    });
});