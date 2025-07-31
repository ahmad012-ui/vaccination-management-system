<?php
session_start();
include '../database/db.php';

if (!isset($_SESSION['hospital_id'])) {
    $_SESSION['hospital_id'] = 1; // TEMP for dev only — use real ID from login
}

$hospital_id = $_SESSION['hospital_id'];

if (!$conn) {
    die("<h3 style='color:red'>Database connection failed: " . mysqli_connect_error() . "</h3>");
}

$query = "SELECT hv.id, v.name, hv.quantity, hv.availability, hv.description 
          FROM hospital_vaccine hv
          JOIN vaccines v ON hv.vaccine_id = v.vaccine_id
          WHERE hv.hospital_id = $hospital_id";

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
        <a class="nav-link active" href="vaccine.php">
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

   <!-- vaccines -->
   <?php
    $hospital_id = $_SESSION['hospital_id'];
    $query = "SELECT hv.id, v.name, hv.quantity, hv.availability, hv.description 
               FROM hospital_vaccine hv
               JOIN vaccines v ON hv.vaccine_id = v.vaccine_id
               WHERE hv.hospital_id = $hospital_id";

    $result = mysqli_query($conn, $query);
   ?>

   <div class="card">
  <div class="card-header pb-0">
    <h6>Vaccine Inventory</h6>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead class="text-center">
          <tr>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Quantity</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Availability</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><p class="text-sm font-weight-bold mb-0"><?php echo $row['name']; ?></p></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo ucfirst($row['availability']); ?></td>
            <td><?php echo $row['description']; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



</main>
</body>
</html>