<?php
session_start();
include '../database/db.php';

// Check if hospital is logged in
if (!isset($_SESSION['hospital_id'])) {
    // Redirect to login if not authenticated
    header("Location: ../auth/login.php"); // adjust path as needed
    exit();
}

$hospital_id = $_SESSION['hospital_id'];

// Check DB connection
if (!$conn) {
    die("<h3 style='color:red'>Database connection failed: " . mysqli_connect_error() . "</h3>");
}
if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$vaccine_record_id = $_GET['id'];

// Make sure record exists and belongs to this hospital
$check = mysqli_query($conn, "SELECT * FROM hospital_vaccine WHERE id = $vaccine_record_id AND hospital_id = $hospital_id");
if (mysqli_num_rows($check) == 0) {
    echo "No such record found.";
    exit;
}

// Delete the record
$delete = mysqli_query($conn, "DELETE FROM hospital_vaccine WHERE id = $vaccine_record_id");

if ($delete) {
    echo "<script>alert('Vaccine deleted successfully'); window.location.href='vaccine.php';</script>";
} else {
    echo "<script>alert('Delete failed'); window.location.href='vaccine.php';</script>";
}
