<?php
session_start();
include '../database/db.php';

// Temporary dev override (remove after login system works)
if (!isset($_SESSION['hospital_id'])) {
    $_SESSION['hospital_id'] = 1; // Replace with actual ID from your DB
}

$hospital_id = $_SESSION['hospital_id'];

if (!$conn) {
    die("<h3 style='color:red'>Database connection failed: " . mysqli_connect_error() . "</h3>");
}

$query = "SELECT a.request_id, c.name AS child_name, a.preferred_date, a.status 
          FROM appointment_requests a
          JOIN children c ON a.child_id = c.child_id
          WHERE a.hospital_id = $hospital_id
          ORDER BY a.preferred_date DESC";

$result = mysqli_query($conn, $query);
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
        <a class="nav-link active" href="appointment.php">
          <i class="fas fa-calendar-check text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Appointments</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="notification.php">
          <i class="fas fa-bell text-dark text-sm opacity-10"></i>
          <span class="nav-link-text text-dark ms-1">Notifications</span>
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

<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

   <!-- Navbar --> 
   <?php include 'includes/navbar.php'; ?>
   <!-- End Navbar -->

   <!-- appointment table -->
   <div class="card mt-4">
  <div class="card-header pb-0">
    <h6>Appointments</h6>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0 text-center">
        <thead>
          <tr>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Child Name</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Preferred Date</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['child_name']); ?></td>
                <td><?php echo date('d M Y', strtotime($row['preferred_date'])); ?></td>
                <td><?php echo ucfirst($row['status']); ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="text-muted">No appointments found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</main>
   
</body>
</html>