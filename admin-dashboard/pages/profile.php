<?php
session_start();
include '../database/db.php';

$admin_id = intval($_SESSION['user_id'] ?? 0);
$query = "SELECT name, email FROM users WHERE user_id = $admin_id LIMIT 1";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result) ?: ['name' => 'Admin', 'email' => 'admin@example.com'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/user.php">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/patient.php">
            <i class="material-symbols-rounded opacity-5">child_care</i>
            <span class="nav-link-text ms-1">Patient</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/hospital.php">
            <i class="material-symbols-rounded opacity-5">local_hospital</i>
            <span class="nav-link-text ms-1">Hospitals</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/vaccine.php">
            <i class="material-symbols-rounded opacity-5">vaccines</i>
            <span class="nav-link-text ms-1">Vaccine</span>
          </a>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/appointment.php">
            <i class="material-symbols-rounded opacity-5">event_available</i>
            <span class="nav-link-text ms-1">Appointments</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.php">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/profile.php">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/logout.php">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <!-- main -->
   <main class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
            <li class="nav-item dropdown pe-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="material-symbols-rounded">notifications</i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <?php
                $notificationQuery = "SELECT c.name AS child_name, ar.preferred_date 
                                        FROM appointment_requests ar
                                        JOIN children c ON ar.child_id = c.child_id
                                        WHERE ar.status = 'Pending'
                                        ORDER BY ar.created_at DESC
                                        LIMIT 5";
                $notifyResult = mysqli_query($conn, $notificationQuery);
                if (mysqli_num_rows($notifyResult) > 0) {
                    while ($row = mysqli_fetch_assoc($notifyResult)) {
                        echo '<li class="mb-2">
                              <a class="dropdown-item border-radius-md" href="appointment.php">
                                <div class="d-flex py-1">
                                  <div class="avatar avatar-sm bg-gradient-info me-3 my-auto">
                                    <span class="material-symbols-rounded text-white">event</span>
                                  </div>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-normal mb-1">
                                      New appointment for <b>' .
                            htmlspecialchars($row["child_name"]) .
                            '</b>
                                    </h6>
                                    <p class="text-xs text-secondary mb-0">
                                      <i class="fa fa-clock me-1"></i> ' .
                            date("d M Y", strtotime($row["preferred_date"])) .
                            '
                                    </p>
                                  </div>
                                </div>
                              </a>
                            </li>';
                    }
                } else {
                    echo '<li class="text-center text-sm text-muted px-2">No new notifications</li>';
                }
                ?>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- profile -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
      </div>
      <div class="card card-body mx-2 mx-md-2 mt-n6">
        <!-- Admin Profile Section -->
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/admin-avatar.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
             </div>
            </div>
            <div class="col-auto my-auto">
            <div class="h-100">
             <h5 class="mb-1">
             <?php echo htmlspecialchars($admin["name"]); ?>
             </h5>
             <p class="mb-0 font-weight-normal text-sm">Administrator</p>
             <p class="text-sm text-muted mb-0">
             <?php echo htmlspecialchars($admin["email"]); ?>
             </p>
            </div>
        </div>
     </div>
    </div>

    <!-- Admin Quick Overview, Profile Information, and Messages -->
        <div class="row pb-4 mt-5 g-4 align-items-stretch h-100">
            <!-- Admin Quick Overview -->
            <div class="col-12 col-xl-4">
             <div class="card h-100 shadow-sm">
              <div class="card-header pb-0 p-3">
               <h6 class="mb-0">Admin Quick Overview</h6>
              </div>
              <?php
              $total_hospitals = mysqli_fetch_assoc(
                  mysqli_query($conn, "SELECT COUNT(*) AS count FROM hospitals")
              )["count"];
              $total_patients = mysqli_fetch_assoc(
                  mysqli_query($conn, "SELECT COUNT(*) AS count FROM children")
              )["count"];
              $total_appointments = mysqli_fetch_assoc(
                  mysqli_query(
                      $conn,
                      "SELECT COUNT(*) AS count FROM appointment_requests"
                  )
              )["count"];
              $total_messages = mysqli_fetch_assoc(
                  mysqli_query(
                      $conn,
                      "SELECT COUNT(*) AS count FROM contact_messages"
                  )
              )["count"];
              $total_users = mysqli_fetch_assoc(
                  mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE role != 'admin'")
              )['count'];
              $pending_appointments = mysqli_fetch_assoc(
                  mysqli_query($conn, "SELECT COUNT(*) AS count FROM appointment_requests WHERE status = 'pending'")
              )['count'];
              ?>
              <div class="card-body p-3">
               <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between">
                 <span class="text-sm">Total Hospitals</span>
                 <strong class="text-dark"><?php echo $total_hospitals; ?></strong>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between">
                 <span class="text-sm">Total Patients</span>
                 <strong class="text-dark"><?php echo $total_patients; ?></strong>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between">
                 <span class="text-sm">Appointments</span>
                 <strong class="text-dark"><?php echo $total_appointments; ?></strong>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between">
                 <span class="text-sm">Messages</span>
                <strong class="text-dark"><?php echo $total_messages; ?></strong>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between">
                 <span class="text-sm">Total Users</span>
                 <strong class="text-dark"><?php echo $total_users; ?></strong>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between">
                 <span class="text-sm">Pending Appointments</span>
                 <strong class="text-dark"><?php echo $pending_appointments; ?></strong>
                </li>
               </ul>
             </div>
           </div>
          </div>

          <!-- Profile Information -->
          <div class="col-12 col-xl-4">
            <div class="card h-100 shadow-sm">
             <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                 <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                 <a href="edit_admin_profile.php">
                 <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                 </a>
                </div>
              </div>
             </div>
            <div class="card-body p-3">
              <p class="text-sm">
               Welcome, <?php echo htmlspecialchars($admin["name"]); ?>. You're managing the Vaccination Management System as the system administrator. You can review reports, manage data, and oversee system-wide operations from this panel.
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                  <strong class="text-dark">Full Name:</strong> &nbsp;
                  <?php echo htmlspecialchars($admin["name"]); ?>
                </li>
                <li class="list-group-item border-0 ps-0 text-sm">
                  <strong class="text-dark">Email:</strong> &nbsp;
                  <?php echo htmlspecialchars($admin["email"]); ?>
                </li>
                <li class="list-group-item border-0 ps-0 text-sm">
                  <strong class="text-dark">Role:</strong> &nbsp; Administrator
                </li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="#">
                    <i class="fa-brands fa-facebook"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="#">
                    <i class="fa-brands fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="#">
                    <i class="fa-brands fa-instagram fa-lg"></i>
                  </a>
                </li>
              </ul>
           </div>
          </div>
          </div>

          <!-- Latest Contact Messages -->
          <?php
           $messages_result = mysqli_query($conn, "SELECT name, email, message, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5");
          ?>

<div class="col-12 col-xl-4">
  <div class="card h-100 shadow-sm">
    <div class="card-header pb-0 p-3">
      <h6 class="mb-0">Latest Contact Messages</h6>
    </div>
    <div class="card-body p-3">
      <?php if (!$messages_result || mysqli_num_rows($messages_result) === 0): ?>
        <div class="text-center text-muted">No messages found.</div>
      <?php else: ?>
        <ul class="list-group">
          <?php while ($msg = mysqli_fetch_assoc($messages_result)) { ?>
            <li class="list-group-item border-0 px-0 mb-3">
              <div class="d-flex align-items-start">
                <div class="avatar me-3">
                  <img
                    src="../assets/img/default-avatar.png"
                    class="border-radius-lg shadow"
                    alt="user-avatar"
                    style="width: 40px; height: 40px;"
                  >
                </div>
                <div>
                  <h6 class="mb-1 text-sm">
                    <?= htmlspecialchars($msg['name']) ?>
                  </h6>
                  <p class="mb-1 text-xs text-dark">
                    <?= nl2br(htmlspecialchars(mb_strimwidth($msg['message'], 0, 100, '...'))) ?>
                  </p>
                  <span class="text-xs text-muted">
                    <?= date('d M Y, h:i A', strtotime($msg['created_at'])) ?>
                  </span>
                </div>
              </div>
            </li>
          <?php } ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<!-- End of row -->
      </div>
  </main>

  <!-- fixed-plugin -->
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>