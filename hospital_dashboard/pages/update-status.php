<?php
include '../database/db.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = strtolower($_GET['status']); // Convert to lowercase to match ENUM

    if (in_array($status, ['approved', 'rejected'])) {
        $query = "UPDATE appointment_requests SET status = '$status' WHERE request_id = $id";
        if (mysqli_query($conn, $query)) {
            header("Location: appointment.php");
            exit;
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid status provided.";
    }
} else {
    echo "Missing parameters.";
}
?>
