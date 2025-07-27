<?php
include '../database/db.php';
session_start();

if (!isset($_GET['id'])) {
  die("<h4 style='color:red'>Hospital ID is missing.</h4>");
}

$hospital_id = intval($_GET['id']);

// Check if hospital exists
$check_query = "SELECT * FROM hospitals WHERE hospital_id = $hospital_id";
$check_result = mysqli_query($conn, $check_query);

if (!$check_result || mysqli_num_rows($check_result) === 0) {
  die("<h4 style='color:red'>Hospital not found.</h4>");
}

// Delete hospital
$delete_query = "DELETE FROM hospitals WHERE hospital_id = $hospital_id";
if (mysqli_query($conn, $delete_query)) {
  echo "<script>alert('Hospital deleted successfully!'); window.location.href='hospital.php';</script>";
} else {
  echo "<p style='color:red'>Deletion failed: " . mysqli_error($conn) . "</p>";
}
?>
