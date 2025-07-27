<?php
include '../database/db.php';
session_start();

if (!isset($_GET['id'])) {
  die("<h4 style='color:red'>Hospital ID is missing.</h4>");
}

$hospital_id = intval($_GET['id']);

// Fetch current hospital data
$query = "SELECT * FROM hospitals WHERE hospital_id = $hospital_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
  die("<h4 style='color:red'>Hospital not found.</h4>");
}

$hospital = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);

  $update_query = "
    UPDATE hospitals 
    SET name = '$name', address = '$address', contact = '$contact', status = '$status'
    WHERE hospital_id = $hospital_id
  ";

  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Hospital updated successfully!'); window.location.href='hospital.php';</script>";
  } else {
    echo "<p style='color:red'>Update failed: " . mysqli_error($conn) . "</p>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Hospital</title>
  <link rel="stylesheet" href="../assets/css/material-dashboard.css">
</head>
<body class="bg-gray-200">
  <div class="container mt-5">
    <h4>Edit Hospital</h4>
    <form method="POST">
      <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($hospital['name']); ?>" required>
      </div>
      <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" required><?php echo htmlspecialchars($hospital['address']); ?></textarea>
      </div>
      <div class="mb-3">
        <label>Contact</label>
        <input type="text" name="contact" class="form-control" value="<?php echo htmlspecialchars($hospital['contact']); ?>" required>
      </div>
      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
          <option value="active" <?php if ($hospital['status'] === 'active') echo 'selected'; ?>>Active</option>
          <option value="inactive" <?php if ($hospital['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update Hospital</button>
      <a href="hospital.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
