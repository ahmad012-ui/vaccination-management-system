<?php

 include '../database/db.php';
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

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

  // Fetch appointments count by preferred date (latest 7)
  $appointmentsData = [];
  $appointmentsLabels = [];

  $query = "SELECT preferred_date, COUNT(*) AS total 
          FROM appointment_requests 
          WHERE hospital_id = $hospital_id 
          GROUP BY preferred_date 
          ORDER BY preferred_date DESC 
          LIMIT 7";

  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $appointmentsLabels[] = date('d M', strtotime($row['preferred_date']));
    $appointmentsData[] = $row['total'];
  }

  // Fetch vaccine data
  $vaccineNameQuery = "
    SELECT v.name AS vaccine_name, hv.quantity 
    FROM hospital_vaccine hv
    JOIN vaccines v ON hv.vaccine_id = v.vaccine_id
    WHERE hv.hospital_id = $hospital_id";
  $vaccineNameResult = mysqli_query($conn, $vaccineNameQuery);

  $vaccineNames = [];
  $vaccineQuantities = [];

  while ($row = mysqli_fetch_assoc($vaccineNameResult)) {
    $vaccineNames[] = $row['vaccine_name'];
    $vaccineQuantities[] = (int)$row['quantity'];
  }

  // Count total unique children with approved appointments for this hospital
  $child_vaccinated_query = "SELECT COUNT(DISTINCT child_id) AS vaccinated_children 
                           FROM appointment_requests 
                           WHERE hospital_id = $hospital_id AND status = 'Approved'";

  $child_vaccinated_result = mysqli_query($conn, $child_vaccinated_query);
  $vaccinated_children = 0;

  if ($child_vaccinated_result && mysqli_num_rows($child_vaccinated_result) > 0) {
    $row = mysqli_fetch_assoc($child_vaccinated_result);
    $vaccinated_children = $row['vaccinated_children'] ?? 0;
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
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />

  <style>
    canvas {
    max-height: 250px;
    }
    @media (max-width: 767px) {
  .main-content {
    margin-left: 0 !important;
    width: 100% !important;
  }

  .g-sidenav-show .sidenav {
    display: none !important;
  }

  .container-fluid {
    padding-left: 1rem !important;
    padding-right: 1rem !important;
  }

  body {
    overflow-x: hidden;
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

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Dashboard Content -->
  <div class="container-fluid py-4 mt-4">

    <div class="row mb-4">
      <div class="col-lg-12">
        <?php if (isset($_SESSION['hospital_name'])): ?>
          <h2 class="text-center">Welcome to the <?php echo $_SESSION['hospital_name']; ?> Dashboard</h2>
          <p class="text-center text-muted">Manage your hospital's operations efficiently.</p>
        <?php else: ?>
          <h2 class="text-center">Welcome to the Hospital Dashboard</h2>
          <p class="text-center text-muted">Please log in to access your hospital's operations.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row">
      <!-- Available Vaccines Card -->
      <?php
        $hospital_id = $_SESSION['hospital_id'] ?? 0;
        $vaccine_query = "SELECT SUM(quantity) AS total_vaccines FROM hospital_vaccine WHERE hospital_id = $hospital_id";
        $vaccine_result = mysqli_query($conn, $vaccine_query);
        // Count total vaccines
        $total_vaccines = 0;
        if ($vaccine_result && mysqli_num_rows($vaccine_result) > 0) {
          $row = mysqli_fetch_assoc($vaccine_result);
          $total_vaccines = $row['total_vaccines'] ?? 0;
        }
        // Count total appointments
        $total_appointments = 0;
        $appointment_query = "SELECT COUNT(*) AS total_appointments FROM appointment_requests WHERE hospital_id = $hospital_id";
        $appointment_result = mysqli_query($conn, $appointment_query);
        if ($appointment_result && mysqli_num_rows($appointment_result) > 0) {
          $row = mysqli_fetch_assoc($appointment_result);
          $total_appointments = $row['total_appointments'] ?? 0;
        }
      ?>

      <div class="col-xl-4 col-sm-6 mb-4">
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

      <!-- Placeholder for more cards (add others here) -->
      
      <div class="col-xl-4 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Appointments</p>
                  <h5 class="font-weight-bolder"><?php echo $total_appointments; ?></h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                  <i class="fas fa-calendar-check text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Children Vaccinated Card -->
      <div class="col-xl-4 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Patients Vaccinated</p>
                  <h5 class="font-weight-bolder"><?= $vaccinated_children ?></h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                  <i class="fas fa-baby text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     </div> <!-- End of row -->
 
    <!-- Charts Row -->
    <div class="row mt-4">
      <!-- Appointments Chart -->
      <div class="col-lg-6 mb-4">
        <div class="card">
           <div class="card-header pb-0">
             <h6>Appointments in Last 7 Days</h6>
           </div>
           <div class="card-body">
             <canvas id="appointmentsChart" height="200"></canvas>
           </div>
        </div>
      </div>

      <!-- Vaccines Chart -->
      <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header pb-0">
              <h6 class="text-center">Vaccines by Type</h6>
            </div>
            <div class="card-body">
              <canvas id="vaccineChart" height="200"></canvas>
            </div>
        </div>
     </div>
   </div>  
   <!-- // End of charts row -->


  </div> <!-- End of container -->

</main>


  <!-- Core JS Files -->
  <script src="/project/hospital_dashboard/assets/js/core/popper.min.js"></script>
  <script src="/project/hospital_dashboard/assets/js/core/bootstrap.min.js"></script>

  <!-- Material Dashboard JS -->
  <script src="/project/hospital_dashboard/assets/js/material-dashboard.min.js?v=3.2.0"></script>

 
  <!-- Script for charts (appointments) -->
<script>
  const appointmentsChartLabels = <?= json_encode(array_reverse($appointmentsLabels)); ?>;
  const appointmentsChartData = <?= json_encode(array_reverse($appointmentsData)); ?>;
</script>

<!-- Script for charts (vaccines) -->
<script>
  const vaccineLabels = <?= json_encode($vaccineNames); ?>;
  const vaccineData = <?= json_encode($vaccineQuantities); ?>;
</script>
<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Your Custom Chart Script -->
<script src="../assets/js/chart.js"></script>
  <!-- for mobile view  -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const iconSidenav = document.getElementById("iconSidenav");
    const body = document.body;

    if (iconSidenav) {
      iconSidenav.addEventListener("click", function () {
        body.classList.toggle("g-sidenav-pinned");
      });
    }
  });
</script>

</body>

</html>
