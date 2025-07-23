<?php
include 'db.php'; // Make sure this file exists and connects to DB properly

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $child_id = $_POST['child_id'];
    $hospital_id = $_POST['hospital_id'];
    $vaccine_id = $_POST['vaccine_id'];
    $preferred_date = $_POST['preferred_date'];

    $sql = "INSERT INTO appointment_requests (child_id, hospital_id, vaccine_id, preferred_date, status) 
            VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $child_id, $hospital_id, $vaccine_id, $preferred_date);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment request submitted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid Request'); window.history.back();</script>";
}
?>

