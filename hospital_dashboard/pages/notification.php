<?php
  session_start();
  include '../database/db.php';

  $hospital_id = $_SESSION['hospital_id'] ?? 1;

  $status_filter = $_GET['status'] ?? '';
  $where_clause = "hospital_id = $hospital_id";
  if ($status_filter && in_array($status_filter, ['Pending', 'Approved', 'Rejected'])) {
    $where_clause .= " AND status = '" . mysqli_real_escape_string($conn, $status_filter) . "'";
  }

  $query = "SELECT ar.*, c.name AS child_name 
          FROM appointment_requests ar
          JOIN children c ON ar.child_id = c.child_id
          WHERE $where_clause 
          ORDER BY ar.created_at DESC";
  $result = mysqli_query($conn, $query);

  $unread_query = "SELECT COUNT(*) AS unread_count FROM appointment_requests 
                 WHERE hospital_id = $hospital_id AND read_status = 0";
  $unread_result = mysqli_query($conn, $unread_query);
  $unread_count = mysqli_fetch_assoc($unread_result)['unread_count'];

  // Mark all unread as read
  mysqli_query($conn, "UPDATE appointment_requests SET read_status = 1 WHERE hospital_id = $hospital_id AND read_status = 0");

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
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet">
  
   <style>
    
    .notification-item {
      border-left: 5px solid #17c1e8;
      transition: all 0.2s;
    }
    .notification-item:hover {
      background-color: #f8f9fa;
    }
    .notification-icon i {
      font-size: 1.4rem;
    }
    .notification-icon {
      background: #2196f3;
      color: white;
      font-size: 24px;
      padding: 12px;
      border-radius: 50%;
      margin-right: 15px;
    }
    .notification-content {
      flex-grow: 1;
    }
    .notification-content h6 {
      margin: 0;
      font-size: 15px;
    }
    .notification-content p {
      margin: 2px 0 0;
      font-size: 13px;
      color: gray;
    }
    .badge {
      font-size: 11px;
      padding: 4px 8px;
      border-radius: 8px;
      color: white;
    }
    .badge-pending { background-color: orange; }
    .badge-approved { background-color: green; }
    .badge-rejected { background-color: red; }
    .read-btn {
      font-size: 11px;
      padding: 4px 10px;
      background: #6c757d;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
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

      <li class="nav-item active">
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

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <!-- Navbar --> 
  <?php include 'includes/navbar.php'; ?>
  <!-- End Navbar -->   

  <div class="container mt-4">
    <h4 class="mb-4">Notifications</h4>

    <!-- Notification Filter -->
    <form method="GET" class="mb-3">
      <div class="row g-2 align-items-center">
        <div class="col-auto pe-0">
          <label for="status" class="col-form-label">Filter by Status:</label>
        </div>
        <div class="col-auto pe-0 align-items-center p-2">
          <select name="status" id="status" class="form-select p-2">
            <option value="" <?php if (!$status_filter) echo 'selected'; ?>>All</option>
            <option value="Pending" <?php if ($status_filter == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Approved" <?php if ($status_filter == 'Approved') echo 'selected'; ?>>Approved</option>
            <option value="Rejected" <?php if ($status_filter == 'Rejected') echo 'selected'; ?>>Rejected</option>
          </select>
        </div>
        <div class="col-auto align-self-end">
          <button type="submit" class="btn btn-primary align-items-center">Apply</button>
        </div>
      </div>
    </form>

    <!-- Notifications -->
    <!-- <?php if ($unread_count == 0): ?>
      <div class="alert text-center" role="alert">
        <i class="fas fa-bell-slash me-2"></i>No new notifications
      </div>
    <?php endif; ?> -->

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="notification-item d-flex align-items-start mb-3 p-3 bg-white shadow-sm border rounded">
        <div class="notification-icon me-3">
          <i class="fas fa-calendar-check fa-lg text-primary"></i>
        </div>
        <div class="notification-content flex-grow-1">
          <h6>
            Appointment request for <strong><?php echo htmlspecialchars($row['child_name']); ?></strong>
          </h6>
          <p class="mb-1">Preferred Date: <?php echo date("d M Y", strtotime($row['preferred_date'])); ?></p>
          <span class="badge 
            <?php echo $row['status'] === 'Pending' ? 'bg-warning' : 
                         ($row['status'] === 'Approved' ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo $row['status']; ?>
          </span>
        </div>

        <?php if ($row['read_status'] == 0): ?>
          <form method="POST" class="ms-3">
            <input type="hidden" name="mark_read_id" value="<?php echo $row['request_id']; ?>">
            <button type="submit" class="btn btn-sm btn-outline-primary">Mark as Read</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</main>
    
<!-- Core JS Files -->
<script src="/project/hospital_dashboard/assets/js/core/popper.min.js"></script>
<script src="/project/hospital_dashboard/assets/js/core/bootstrap.min.js"></script>

<!-- Material Dashboard JS -->
<script src="/project/hospital_dashboard/assets/js/material-dashboard.min.js?v=3.2.0"></script>

</body>
</html>