<?php
session_start();
include 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seeker') {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

$job_id = intval($_POST['job_id']);
$seeker_id = intval($_SESSION['user_id']);

// ✅ Check if already applied
$check = $conn->prepare("SELECT * FROM applications WHERE job_id=? AND seeker_id=?");
$check->bind_param("ii", $job_id, $seeker_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "You have already applied for this job."]);
    exit;
}

// ✅ Validate and handle resume upload
if (!isset($_FILES['resume']) || $_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(["status" => "error", "message" => "Please upload a resume (PDF)."]);
    exit;
}

$allowed_ext = ['pdf'];
$file_ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));

if (!in_array($file_ext, $allowed_ext)) {
    echo json_encode(["status" => "error", "message" => "Only PDF files are allowed."]);
    exit;
}

if ($_FILES['resume']['size'] > 5 * 1024 * 1024) { // 5MB limit
    echo json_encode(["status" => "error", "message" => "File size exceeds 5MB limit."]);
    exit;
}

$upload_dir = "../uploads/resumes/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$filename = uniqid('resume_') . '.' . $file_ext;
$filepath = $upload_dir . $filename;

if (!move_uploaded_file($_FILES['resume']['tmp_name'], $filepath)) {
    echo json_encode(["status" => "error", "message" => "File upload failed."]);
    exit;
}

$resume_path = 'uploads/resumes/' . $filename;

// ✅ Insert application with resume path
$stmt = $conn->prepare("INSERT INTO applications (job_id, seeker_id, resume_path) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $job_id, $seeker_id, $resume_path);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Application submitted successfully with resume!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database error while applying."]);
}
?>
