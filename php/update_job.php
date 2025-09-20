<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "recruiter") {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'], $data['title'], $data['company_name'], $data['description'], $data['location'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit();
}

$job_id = intval($data['id']);
$title = $conn->real_escape_string($data['title']);
$company_name = $conn->real_escape_string($data['company_name']);
$description = $conn->real_escape_string($data['description']);
$location = $conn->real_escape_string($data['location']);
$recruiter_id = $_SESSION['user_id'];

$sql = "UPDATE jobs SET title=?, company_name=?, description=?, location=? WHERE id=? AND recruiter_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssii", $title, $company_name, $description, $location, $job_id, $recruiter_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update job"]);
}

$stmt->close();
$conn->close();
?>
