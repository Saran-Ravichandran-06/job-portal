<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "recruiter") {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Job ID is missing"]);
    exit();
}

$job_id = intval($_GET['id']);
$recruiter_id = $_SESSION['user_id'];

// Delete only if the job belongs to this recruiter
$sql = "DELETE FROM jobs WHERE id = ? AND recruiter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $job_id, $recruiter_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete job"]);
}

$stmt->close();
$conn->close();
?>
