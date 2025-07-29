<?php

 include 'database/db.php';
//  session_start();
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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon and icons -->
  <link rel="apple-touch-icon" sizes="76x76" href="/project/hospital_dashboard/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/project/hospital_dashboard/assets/img/favicon.png">
<title>Hospital Panel</title>
<!-- Fonts and icons -->
<link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" rel="stylesheet">
<link href="/project/hospital_dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="/project/hospital_dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Material Dashboard CSS -->
<link id="pagestyle" href="/project/hospital_dashboard/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body>

 <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <!-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
        </nav> -->
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
                                        ORDER BY ar.created_at DESC LIMIT 5";
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

</body>
</html>