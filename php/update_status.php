<?php
session_start();
include 'config.php';

// ✅ Ensure recruiter is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// ✅ Process POST request (JSON)
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['application_id']) && isset($data['status'])) {
    $application_id = intval($data['application_id']);
    $status = $data['status'];

    $sql = "UPDATE applications SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $application_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Status updated successfully!"]);
    } else {
        echo json_encode(["error" => "Failed to update status"]);
    }
} else {
    echo json_encode(["error" => "Invalid request data"]);
}
?>
