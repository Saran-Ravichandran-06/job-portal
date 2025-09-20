<?php
session_start();
include 'config.php';

// Check if recruiter is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "recruiter") {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

$recruiter_id = $_SESSION['user_id'];

// Fetch jobs for this recruiter including company name
$sql = "SELECT id, title, company_name, description, location, created_at 
        FROM jobs 
        WHERE recruiter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recruiter_id);
$stmt->execute();
$result = $stmt->get_result();

$jobs = [];
while ($row = $result->fetch_assoc()) {
    $jobs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($jobs);

$stmt->close();
$conn->close();
?>
