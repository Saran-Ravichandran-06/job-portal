<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seeker') {
    die(json_encode([]));
}

$seeker_id = $_SESSION['user_id'];
$jobRole = isset($_GET['jobRole']) ? "%" . $_GET['jobRole'] . "%" : "%";

$sql = "SELECT j.id, j.title, j.company_name, j.location, j.description, j.created_at,
        (SELECT COUNT(*) FROM applications a WHERE a.job_id = j.id AND a.seeker_id = ?) AS applied
        FROM jobs j
        WHERE j.title LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $seeker_id, $jobRole);
$stmt->execute();
$result = $stmt->get_result();

$jobs = [];
while ($row = $result->fetch_assoc()) {
    $jobs[] = $row;
}

echo json_encode($jobs);
?>
