<?php

 include '../database/db.php';
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

 // For safety if connection fails
  if (!$conn) {
    die("<h3 style='color:red'>Database connection failed: " . mysqli_connect_error() . "</h3>");
  }
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

  <style>
    @media (min-width: 768px) {
    .ms-md-250 {
      margin-left: 250px !important;
    }
    }
  </style>
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
    
 
  <!-- Main Content -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

     <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Dashboard Content -->
    <div class="container-fluid py-4">

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <?php if (isset($_SESSION['hospital_name'])): ?>
          <h2 class="text-center">Welcome to the <?php echo $_SESSION['hospital_name']; ?> Dashboard</h2>
          <p class="text-center">Manage your hospital's operations efficiently.</p>
          <?php else: ?>
          <h2 class="text-center">Welcome to the Hospital Dashboard</h2>
          <p class="text-center">Please log in to access your hospital's operations.</p>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <!-- available vaccines -->
        <?php

// Get current hospital ID from session
$hospital_id = $_SESSION['hospital_id'] ?? 0;

// Query to get total vaccine quantity for this hospital
$vaccine_query = "SELECT SUM(quantity) AS total_vaccines FROM hospital_vaccine WHERE hospital_id = $hospital_id";
$vaccine_result = mysqli_query($conn, $vaccine_query);

$total_vaccines = 0;
if ($vaccine_result && mysqli_num_rows($vaccine_result) > 0) {
    $row = mysqli_fetch_assoc($vaccine_result);
    $total_vaccines = $row['total_vaccines'] ?? 0;
}
?>

        <div class="col-xl-4 col-sm-6">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Available Vaccines</p>
            <h5 class="font-weight-bolder"><?= $total_vaccines ?></h5>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
            <i class="fas fa-syringe text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


        <!-- Add more cards here -->
        <?php
$vaccine_query = "SELECT vaccine_id, quantity FROM hospital_vaccine WHERE hospital_id = $hospital_id";
$vaccine_result = mysqli_query($conn, $vaccine_query);

$total_vaccines = 0;
while ($row = mysqli_fetch_assoc($vaccine_result)) {
    $total_vaccines += $row['quantity'];
}
?>

<div class="col-xl-4 col-sm-6">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Available Vaccines</p>
            <h5 class="font-weight-bolder"><?= $total_vaccines ?? 0 ?></h5>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
            <i class="fas fa-syringe text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

       
      <!-- end of row -->
      </div> 


      <!-- You can continue adding graphs, tables, etc. -->
      
    </div>

  </main>

  <!-- Core JS -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js"></script>

</body>

</html>
