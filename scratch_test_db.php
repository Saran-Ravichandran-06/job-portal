<?php
include 'php/config.php';
echo "--- APPLICATIONS SCHEMA ---\n";
$r = $conn->query("DESCRIBE applications");
while ($row = $r->fetch_assoc()) {
    print_r($row);
}
echo "--- JOBS SCHEMA ---\n";
$r = $conn->query("DESCRIBE jobs");
while ($row = $r->fetch_assoc()) {
    print_r($row);
}
?>
