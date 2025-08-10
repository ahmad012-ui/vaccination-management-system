<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id']; // ✅ use actual logged-in user

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', contact='$contact', created_at='$dob' WHERE user_id=$user_id");

    $child_q = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = $user_id LIMIT 1");
    if (mysqli_num_rows($child_q) > 0) {
        $child = mysqli_fetch_assoc($child_q);
        mysqli_query($conn, "UPDATE children SET gender='$gender' WHERE child_id = {$child['child_id']}");
    }

    header("Location: user-dashboard.php?updated=1");
    exit();
}

$user_q = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($user_q);
$child_q = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = $user_id LIMIT 1");
$child = mysqli_fetch_assoc($child_q);
$child_gender = $child['gender'] ?? 'N/A';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h3>✏️ Edit Your Profile</h3>
    <form method="POST">
        <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" pattern="^[a-zA-Z\s]+$" title="Name should contain only letters and spaces." required>
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Invalid email format." required>
        </div>
        <div class="mb-2">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="<?= date('Y-m-d', strtotime($user['created_at'])) ?>" required>
        </div>
        <div class="mb-2">
            <label>Contact Number</label>
            <input type="text" name="contact" class="form-control" value="<?= $user['contact'] ?? '' ?>" pattern="^\d{11}$" title="Contact number should be 10 digits." required>
        </div>
        <div class="mb-2">
            <label>Child Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male" <?= strtolower($child_gender) === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= strtolower($child_gender) === 'female' ? 'selected' : '' ?>>Female</option>
            </select>
        </div>
        <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
        <a href="user-dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
