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


// Fetch appointment data
$query = "SELECT a.request_id, c.name AS child_name, a.preferred_date, a.status,
                 u.name AS parent_name, u.contact, u.email
          FROM appointment_requests a
          JOIN children c ON a.child_id = c.child_id
          JOIN users u ON c.parent_id = u.user_id
          WHERE a.hospital_id = $hospital_id
          ORDER BY a.preferred_date DESC";

$result = mysqli_query($conn, $query);

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
        <a class="nav-link active" href="appointment.php">
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

    <div class="container-fluid py-4 mt-4">
      <div class="card">
        <div class="card-header pb-2 text-center font-weight-bold text-uppercase bg-gradient-primary">
          <h6>Appointment Requests</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead class="text-center">
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Child</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Parent</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Contact</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Preferred Date</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php if (mysqli_num_rows($result) > 0): ?>
                  <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['child_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['parent_name']); ?></td>
                      <td>
                        <strong>Phone:</strong> <?php echo htmlspecialchars($row['contact']); ?><br>
                        <small><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></small>
                      </td>
                      <td><?php echo date("d M Y", strtotime($row['preferred_date'])); ?></td>
                      <td>
                        <span class="badge bg-gradient-<?php 
                          echo $row['status'] === 'Approved' ? 'success' : 
                               ($row['status'] === 'Rejected' ? 'danger' : 'warning'); ?>">
                          <?php echo $row['status']; ?>
                        </span>
                      </td>
                      <td>
                        <?php if (strtolower($row['status']) === 'pending'): ?>
                          <a href="update-status.php?id=<?php echo $row['request_id']; ?>&status=Approved" 
                             class="btn btn-sm btn-success me-1">Approve</a>
                          <a href="update-status.php?id=<?php echo $row['request_id']; ?>&status=Rejected" 
                             class="btn btn-sm btn-danger">Reject</a>
                       <?php else: ?>
                          <em class="text-muted">No action</em>
                       <?php endif; ?>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                  <tr><td colspan="6">No appointment requests found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
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