<?php
session_start();
include 'config.php'; // mysqli connection

header('Content-Type: application/json');

// ✅ Check if recruiter is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$recruiterId = $_SESSION['user_id']; // recruiter_id is stored as user_id in session

$sql = "
    SELECT 
        js.username AS applicant_name,
        js.email,
        j.title AS job_title,
        a.status,
        a.id AS application_id,
        a.resume_path
    FROM applications a
    INNER JOIN job_seekers js ON a.seeker_id = js.id
    INNER JOIN jobs j ON a.job_id = j.id
    WHERE j.recruiter_id = ?
    ORDER BY a.applied_at DESC
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["error" => "SQL Prepare Failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $recruiterId);
$stmt->execute();
$result = $stmt->get_result();

$applicants = [];
while ($row = $result->fetch_assoc()) {
    // ✅ Ensure resume path is a valid link
    $row['resume_url'] = !empty($row['resume_path']) ? '../../php/' . $row['resume_path'] : null;
    $applicants[] = $row;
}

echo json_encode($applicants);
?>
