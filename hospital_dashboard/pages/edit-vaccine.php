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

// Fetch current vaccine details
$query = "SELECT hv.*, v.name AS vaccine_name 
          FROM hospital_vaccine hv 
          JOIN vaccines v ON hv.vaccine_id = v.vaccine_id 
          WHERE hv.id = $vaccine_record_id AND hv.hospital_id = $hospital_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Vaccine record not found.";
    exit;
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update_vaccine'])) {
    $vaccine_id = $_POST['vaccine_id'];
    $vaccine_name = $_POST['vaccine_name']; // Not editable, but included for completeness
    $quantity = $_POST['quantity'];
    $availability = $_POST['availability'];
    $description = $_POST['description'];

    $update = "UPDATE hospital_vaccine 
               SET quantity = $quantity, 
                   availability = '$availability', 
                   description = '$description' 
               WHERE id = $vaccine_record_id AND hospital_id = $hospital_id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Vaccine updated successfully'); window.location.href='vaccine.php';</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}

  // for unread notifications
  $notif_query = "SELECT COUNT(*) AS unread_count 
                FROM appointment_requests 
                WHERE hospital_id = $hospital_id AND read_status = 0";

  $notif_result = mysqli_query($conn, $notif_query);
  $notif_data = mysqli_fetch_assoc($notif_result);
  $unread_count = $notif_data['unread_count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Vaccine</title>
  <link href="../assets/css/material-dashboard.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start bg-white shadow" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav"></i>
    <a class="navbar-brand m-0 text-center" href="dashboard.php">
      <span class="ms-1 font-weight-bold text-dark">Hospital Panel</span>
    </a>
  </div>

  <hr class="horizontal dark mt-0">

  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link active" href="dashboard.php">
          <i class="fas fa-hospital-user text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="vaccine.php">
          <i class="fas fa-syringe text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Manage Vaccines</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="appointment.php">
          <i class="fas fa-calendar-check text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Appointments</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="notification.php">
          <div class="d-flex align-items-center">
            <i class="fas fa-envelope-open-text text-dark text-sm opacity-10 me-2"></i>
          </div>
            <span class="nav-link-text text-dark ">Notifications</span>

          <?php if ($unread_count > 0): ?>
            <span class="badge bg-danger ms-2"><?php echo $unread_count; ?></span>
          <?php endif; ?>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="profile.php">
          <i class="fas fa-user text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Profile</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <hr class="horizontal dark">
      </li>

      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Logout</span>
        </a>
      </li>

    </ul>
  </div>
</aside>

<div class="container mt-5">
  <h4 class="mb-3">Edit Vaccine: <?= $row['vaccine_name'] ?></h4>
  <form method="POST">
    <input type="hidden" name="vaccine_id" value="<?= $row['id'] ?>">

    <div class="mb-3">
      <label class="form-label">Vaccine Name</label>
      <input type="text" name="vaccine_name" class="form-control" value="<?= $row['vaccine_name'] ?>" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Quantity</label>
      <input type="number" name="quantity" class="form-control" value="<?= $row['quantity'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Availability</label>
      <select name="availability" class="form-control" required>
        <option value="available" <?= $row['availability'] === 'available' ? 'selected' : '' ?>>Available</option>
        <option value="unavailable" <?= $row['availability'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3"><?= $row['description'] ?></textarea>
    </div>

    <button type="submit" name="update_vaccine" class="btn btn-success">Update</button>
    <a href="vaccine.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

</body>
</html>
