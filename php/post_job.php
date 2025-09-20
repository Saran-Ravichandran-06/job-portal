<?php
session_start();
include 'config.php';

// Ensure the user is logged in and is a recruiter
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'recruiter') {
    die("Unauthorized access!");
}

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    $title = trim($_POST['title']);
    $company_name = trim($_POST['company_name']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $recruiter_id = $_SESSION['user_id'];

    // Validate required fields
    if (empty($title) || empty($company_name) || empty($description) || empty($location)) {
        header("Location: ../pages/recruiter/post_job.html?error=1");
        exit();
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO jobs (title, company_name, description, location, recruiter_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $company_name, $description, $location, $recruiter_id);

    if ($stmt->execute()) {
        header("Location: ../pages/recruiter/post_job.html?success=1");
        exit();
    } else {
        header("Location: ../pages/recruiter/post_job.html?error=1");
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
