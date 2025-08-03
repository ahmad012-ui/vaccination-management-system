<?php
session_start();
include '../database/db.php';

// // Check if hospital is logged in
// if (!isset($_SESSION['hospital_id'])) {
//   die("<h3 style='color:red'>Unauthorized access. Please log in first.</h3>");
// }

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

// Fetch hospital info
$query = "SELECT h.name AS hospital_name, h.address, h.contact, h.status, h.created_at, u.name AS user_name, u.email
          FROM hospitals h
          JOIN users u ON h.user_id = u.user_id
          WHERE h.hospital_id = $hospital_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$hospital = mysqli_fetch_assoc($result);

if (!$hospital) {
    die("No hospital found with ID: $hospital_id");
}

if (!$result || mysqli_num_rows($result) === 4) {
  die("<h3 style='color:red'>Hospital not found in the database.</h3>");
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
  <title>Hospital Dashboard</title>
  <!-- Include your Material Dashboard CSS -->
  <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
  <!-- Icons & Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>
<body class="g-sidenav-show bg-gray-100">
  
<!-- Sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start bg-white shadow" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav"></i>
    <a class="navbar-brand m-0 text-center" href="dashboard.php">
      <!-- <img src="../../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100 ps-3" alt="main_logo"> -->
      <span class="ms-1 font-weight-bold text-dark">Hospital Panel</span>
    </a>
  </div>

  <hr class="horizontal dark mt-0">

  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
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
        <a class="nav-link active" href="profile.php">
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

 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header pb-0">
            <h6>Hospital Profile</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p><strong>Hospital Name:</strong> <?php echo $hospital['hospital_name']; ?></p>
                <p><strong>Managed By:</strong> <?php echo $hospital['user_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $hospital['email']; ?></p>
              </div>
              <div class="col-md-6">
                <p><strong>Contact:</strong> <?php echo $hospital['contact']; ?></p>
                <p><strong>Address:</strong> <?php echo $hospital['address']; ?></p>
                <p><strong>Status:</strong> <span class="badge bg-<?php echo ($hospital['status'] == 'active') ? 'success' : 'danger'; ?>">
                  <?php echo ucfirst($hospital['status']); ?>
                </span></p>
              </div>
            </div>
            <div class="text-center mt-3">
              <a href="edit-profile.php" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<!-- Core JS Files -->
<script src="/project/hospital_dashboard/assets/js/core/popper.min.js"></script>
<script src="/project/hospital_dashboard/assets/js/core/bootstrap.min.js"></script>

<!-- Material Dashboard JS -->
<script src="/project/hospital_dashboard/assets/js/material-dashboard.min.js?v=3.2.0"></script>

</body>
</html>