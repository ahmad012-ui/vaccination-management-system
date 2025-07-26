<?php
include '../database/db.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Optional: Check if user exists
    $checkQuery = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
    if (mysqli_num_rows($checkQuery) === 0) {
        echo "User not found.";
        exit;
    }

    // Delete user
    $deleteQuery = mysqli_query($conn, "DELETE FROM users WHERE user_id = $user_id");

    if ($deleteQuery) {
        echo "<script>
                alert('User deleted successfully');
                window.location.href='user.php';
              </script>";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
