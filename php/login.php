<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check job seeker
    $sql_seeker = "SELECT * FROM job_seekers WHERE email='$email'";
    $result_seeker = $conn->query($sql_seeker);

    if ($result_seeker->num_rows > 0) {
        $row = $result_seeker->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = "seeker";
            header("Location: ../pages/seeker/dashboard.html");
            exit();
        }
    }

    // Check recruiter
    $sql_recruiter = "SELECT * FROM recruiters WHERE email='$email'";
    $result_recruiter = $conn->query($sql_recruiter);

    if ($result_recruiter->num_rows > 0) {
        $row = $result_recruiter->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = "recruiter";
            header("Location: ../pages/recruiter/dashboard.html");
            exit();
        }
    }

    echo "Invalid login credentials. <a href='../login.html'>Try Again</a>";
}
?>
