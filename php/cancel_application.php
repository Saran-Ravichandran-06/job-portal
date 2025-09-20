<?php
session_start();
require_once "config.php"; // ✅ same PDO connection as applied_jobs.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_id'])) {
    $application_id = intval($_POST['application_id']);

    // ✅ Ensure only the logged-in seeker can cancel their own application
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seeker') {
        http_response_code(403);
        echo "Unauthorized action.";
        exit();
    }

    $seeker_id = $_SESSION['user_id'];

    try {
        // ✅ Delete using the application primary key (a.id)
        $sql = "DELETE FROM applications WHERE id = :application_id AND seeker_id = :seeker_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':application_id' => $application_id,
            ':seeker_id' => $seeker_id
        ]);

        if ($stmt->rowCount() > 0) {
            echo "✅ Application cancelled successfully.";
        } else {
            echo "⚠️ No matching application found or not authorized.";
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo "❌ Error cancelling application: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>
