// =======================
// main.js
// General JS functions (form validation, alerts, etc.)
// =======================

// Validate Login Form
function validateLoginForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (email === "" || password === "") {
        alert("⚠️ Please fill in both email and password.");
        return false;
    }

    // Basic email check
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        alert("⚠️ Please enter a valid email address.");
        return false;
    }

    return true; // allow submit
}

// Validate Register Form
function validateRegisterForm() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();

    if (name === "" || email === "" || password === "" || confirmPassword === "") {
        alert("⚠️ All fields are required.");
        return false;
    }

    if (password.length < 6) {
        alert("⚠️ Password must be at least 6 characters long.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("⚠️ Passwords do not match.");
        return false;
    }

    return true;
}

// Highlight active nav link (optional)
document.addEventListener("DOMContentLoaded", () => {
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll(".navbar ul li a");

    menuItems.forEach(item => {
        if (item.getAttribute("href") === currentLocation.split("/").pop()) {
            item.classList.add("active-link");
        }
    });
});
