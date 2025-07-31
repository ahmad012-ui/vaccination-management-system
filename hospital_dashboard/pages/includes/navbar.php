<?php

  include 'database/db.php';
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $hospital_id = $_SESSION['hospital_id'] ?? 1;
 // For safety if connection fails
  if (!$conn) {
    die("<h3 style='color:red'>Database connection failed: " . mysqli_connect_error() . "</h3>");
  }

  $notif_query = "SELECT COUNT(*) AS unread_count FROM appointment_requests WHERE hospital_id = $hospital_id AND read_status = 0";
  $notif_result = mysqli_query($conn, $notif_query);
  $notif_data = mysqli_fetch_assoc($notif_result);
  $unread_count = $notif_data['unread_count'] ?? 0;

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Material Dashboard CSS -->
<link id="pagestyle" href="/project/hospital_dashboard/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

<style>
.navbar .fa-notes-medical{
  font-size: 18px;
  position: relative;
}

@media (max-width: 991px) {
  .g-sidenav-hidden #sidenav-main {
    transform: translateX(-250px); /* Hide */
  }

  .g-sidenav-pinned #sidenav-main {
    transform: translateX(0); /* Show */
  }

  #sidenav-main {
    transition: transform 0.3s ease;
  }
}

</style>

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
            <li class="nav-item d-xl-none px-3 ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <!-- Appointments link with unread count -->
            <li class="nav-item d-flex align-items-center">
              <a href="appointment.php" class="nav-link text-body px-2 position-relative" title="Appointments">
                <i class="fas fa-notes-medical"></i>
                <?php if ($unread_count > 0): ?>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $unread_count; ?>
                  </span>
                <?php endif; ?>
              </a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/profile.php" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

<!-- Core JS Files -->
<script src="/project/hospital_dashboard/assets/js/core/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Material Dashboard JS -->
<script src="/project/hospital_dashboard/assets/js/material-dashboard.min.js?v=3.2.0"></script>

<!-- Script for toggling sidenav -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('iconNavbarSidenav');
    const body = document.body;

    if (toggle) {
      toggle.addEventListener('click', () => {
        const isPinned = body.classList.contains('g-sidenav-pinned');
        
        if (isPinned) {
          body.classList.remove('g-sidenav-pinned');
          body.classList.add('g-sidenav-hidden');
        } else {
          body.classList.add('g-sidenav-pinned');
          body.classList.remove('g-sidenav-hidden');
        }
      });
    }
  });
</script>

</body>
</html>