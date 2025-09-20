<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in and is a seeker
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seeker') {
    echo json_encode([]);
    exit;
}

$seeker_id = $_SESSION['user_id'];

require_once 'config.php'; // Include PDO connection

try {
    // Fetch applied jobs for the seeker along with status
    $sql = "
        SELECT 
            a.id AS application_id,
            j.title AS job_title,
            j.company_name,
            j.description,
            j.location,
            a.status,
            a.applied_at
        FROM applications a
        INNER JOIN jobs j ON a.job_id = j.id
        WHERE a.seeker_id = :seeker_id
        ORDER BY a.applied_at DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':seeker_id', $seeker_id, PDO::PARAM_INT);
    $stmt->execute();

    $appliedJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($appliedJobs);

} catch (PDOException $e) {
    error_log("Error fetching applied jobs: " . $e->getMessage());
    echo json_encode([]);
}
?>
