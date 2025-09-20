<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($password !== $confirm_password) {
        die("Passwords do not match. <a href='../register.html'>Try Again</a>");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($role === "seeker") {
        $sql = "INSERT INTO job_seekers (username, email, password) 
                VALUES ('$username', '$email', '$hashed_password')";
    } elseif ($role === "recruiter") {
        $sql = "INSERT INTO recruiters (username, email, password) 
                VALUES ('$username', '$email', '$hashed_password')";
    } else {
        die("Invalid role selected.");
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='../login.html'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
