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
if (isset($_POST['add_vaccine'])) {
    $vaccine_name = trim($_POST['vaccine_name']);
    $quantity = $_POST['quantity'];
    $availability = $_POST['availability'];
    $description = $_POST['description'];

    // 1. Check if vaccine exists
    $checkVaccine = mysqli_query($conn, "SELECT vaccine_id FROM vaccines WHERE name = '$vaccine_name'");
    if (mysqli_num_rows($checkVaccine) > 0) {
        $vaccineData = mysqli_fetch_assoc($checkVaccine);
        $vaccine_id = $vaccineData['vaccine_id'];
    } else {
        // 2. Insert new vaccine type
        mysqli_query($conn, "INSERT INTO vaccines (name) VALUES ('$vaccine_name')");
        $vaccine_id = mysqli_insert_id($conn);
    }

    // 3. Check if hospital already has this vaccine
    $check = mysqli_query($conn, "SELECT * FROM hospital_vaccine WHERE hospital_id = $hospital_id AND vaccine_id = $vaccine_id");
    if (mysqli_num_rows($check) > 0) {
        // Update existing record
        $update = "UPDATE hospital_vaccine 
                   SET quantity = quantity + $quantity, 
                       availability = '$availability', 
                       description = '$description' 
                   WHERE hospital_id = $hospital_id AND vaccine_id = $vaccine_id";
        mysqli_query($conn, $update);
    } else {
        // Insert new record
        $insert = "INSERT INTO hospital_vaccine (hospital_id, vaccine_id, quantity, availability, description) 
                   VALUES ($hospital_id, $vaccine_id, $quantity, '$availability', '$description')";
        mysqli_query($conn, $insert);
    }

    echo "<script>alert('Vaccine info updated successfully'); window.location.href='vaccine.php';</script>";
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
  <title>Add Vaccine</title>
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
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

<!-- Main content -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-gradient-primary text-white">
      <h5 class="mb-0">Add or Update Vaccine</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="">
        <div class="mb-3">
          <label class="form-label">Vaccine Name</label>
          <input type="text" name="vaccine_name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Quantity</label>
          <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Availability</label>
          <select name="availability" class="form-control" required>
           <option value="available">Available</option>
           <option value="unavailable">Unavailable</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" name="add_vaccine" class="btn btn-primary">Save Vaccine</button>
      </form>
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
