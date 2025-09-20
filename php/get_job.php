<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "recruiter") {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Missing job ID"]);
    exit();
}

$job_id = intval($_GET['id']);
$recruiter_id = $_SESSION['user_id'];

$sql = "SELECT id, title, company_name, description, location FROM jobs WHERE id=? AND recruiter_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $job_id, $recruiter_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "Job not found"]);
}

$stmt->close();
$conn->close();
?>
