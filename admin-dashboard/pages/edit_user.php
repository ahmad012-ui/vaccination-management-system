<?php
include '../database/db.php';
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die('Invalid user ID.');
}

$user_id = $_GET['id'];

// Fetch user data
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) !== 1) {
  die('User not found.');
}

$user = mysqli_fetch_assoc($result);

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = $_POST['name'] ?? '';
  $email    = $_POST['email'] ?? '';
  $contact  = $_POST['contact'] ?? '';
  $role     = $_POST['role'] ?? 'user';
  $status   = $_POST['status'] ?? 'active';

  $updateQuery = "
    UPDATE users 
    SET name = ?, email = ?, contact = ?, role = ?, status = ?
    WHERE user_id = ?
  ";
  $stmt = mysqli_prepare($conn, $updateQuery);
  mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $contact, $role, $status, $user_id);
  if (mysqli_stmt_execute($stmt)) {
    header("Location: user.php");
    echo "<script>alert('User updated successfully!');</script>";
    exit;
  } else {
    echo "<script>alert('Update failed.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit User</title>
  <link rel="stylesheet" href="../assets/css/material-dashboard.css?v=3.2.0">
</head>
<body>
  <div class="container mt-4">
    <h3>Edit User</h3>
    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contact</label>
        <input type="text" name="contact" class="form-control" value="<?= htmlspecialchars($user['contact'] ?? '') ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select" required>
          <option value="parent" <?= $user['role'] === 'parent' ? 'selected' : '' ?>>Parent</option>
          <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
          <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Staff</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
          <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
          <option value="blocked" <?= $user['status'] === 'blocked' ? 'selected' : '' ?>>Blocked</option>
        </select>
      </div>
      <button type="submit" class="btn btn-dark">Update</button>
      <a href="patient.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
