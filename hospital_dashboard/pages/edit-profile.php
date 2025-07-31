<?php
session_start();
include '../database/db.php';

if (!isset($_SESSION['hospital_id'])) {
    $_SESSION['hospital_id'] = 1; // TEMP for dev only
}

$hospital_id = $_SESSION['hospital_id'];

// Fetch existing hospital and user info
$query = "SELECT h.name AS hospital_name, h.address, h.contact, h.status, u.name AS user_name, u.email, u.user_id
          FROM hospitals h
          JOIN users u ON h.user_id = u.user_id
          WHERE h.hospital_id = $hospital_id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hospital_name = mysqli_real_escape_string($conn, $_POST['hospital_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = $data['user_id'];

    // Update hospitals table
    $updateHospital = "UPDATE hospitals SET name = '$hospital_name', address = '$address', contact = '$contact', status = '$status' 
                       WHERE hospital_id = $hospital_id";
    mysqli_query($conn, $updateHospital);

    // Update users table
    $updateUser = "UPDATE users SET name = '$user_name', email = '$email' WHERE user_id = $user_id";
    mysqli_query($conn, $updateUser);

    echo "<script>alert('Profile updated successfully'); window.location.href='profile.php';</script>";
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile</title>
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="g-sidenav-show bg-gray-100">

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

<!-- Main Content -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <?php include 'includes/navbar.php'; ?>

  <div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h6>Edit Hospital Profile</h6>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label>Hospital Name</label>
                  <input type="text" name="hospital_name" class="form-control" value="<?= $data['hospital_name']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Manager Name</label>
                  <input type="text" name="user_name" class="form-control" value="<?= $data['user_name']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="<?= $data['email']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Contact</label>
                  <input type="text" name="contact" class="form-control" value="<?= $data['contact']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control" value="<?= $data['address']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="active" <?= ($data['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?= ($data['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                  </select>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
                <a href="profile.php" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Scripts -->
<script src="/project/hospital_dashboard/assets/js/core/popper.min.js"></script>
<script src="/project/hospital_dashboard/assets/js/core/bootstrap.min.js"></script>
<script src="/project/hospital_dashboard/assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>
