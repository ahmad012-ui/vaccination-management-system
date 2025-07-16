<?php
session_start();

// Redirect logged in users to their dashboards
if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: admin/dashboard.php');
            exit;
        case 'parent':
            header('Location: parent/dashboard.php');
            exit;
        case 'hospital':
            header('Location: hospital/dashboard.php');
            exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VaxiPal | Welcome</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,600,700&display=swap">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 80px 15px;
      background: linear-gradient(90deg, #ffffff, #f0f4f8);
    }
    .hero-content {
      max-width: 600px;
    }
    .hero-content h1 {
      font-size: 3rem;
      font-weight: 700;
      color: #212529;
    }
    .hero-content p {
      font-size: 1.2rem;
      color: #6c757d;
      margin-top: 15px;
    }
    .hero-content .btn {
      margin-top: 25px;
      padding: 12px 30px;
      font-size: 1rem;
      border-radius: 50px;
    }
    .hero-img {
      max-width: 500px;
    }
    .features {
      padding: 60px 0;
      background: #ffffff;
    }
    .feature-box {
      padding: 30px 20px;
      border-radius: 12px;
      background: #f1f5f9;
      transition: 0.3s ease;
    }
    .feature-box:hover {
      background: #e2e8f0;
    }
    .feature-icon {
      font-size: 2.5rem;
      color: #0d6efd;
      margin-bottom: 15px;
    }
    footer {
      background: #f8f9fa;
      padding: 20px 0;
      font-size: 0.95rem;
      text-align: center;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand font-weight-bold text-primary" href="#">
        <i class="fas fa-syringe mr-2"></i> VaxiPal
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_parent.php">Register (Parent)</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="hero">
    <div class="container d-flex flex-wrap align-items-center">
      <div class="hero-content">
        <h1>Smarter Vaccine Management</h1>
        <p>Book hospital slots, track doses, and generate vaccination records — all with one platform.</p>
        <a href="login.php" class="btn btn-primary">Get Started</a>
      </div>
      <div class="hero-img d-none d-md-block">
        <img src="assets/vaccine-illustration.svg" alt="Vaccination Illustration" class="img-fluid">
      </div>
    </div>
  </section>

  <section class="features">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="feature-box">
            <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
            <h5>Schedule Vaccines</h5>
            <p>Stay informed about upcoming doses and set reminders.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-box">
            <div class="feature-icon"><i class="fas fa-hospital-alt"></i></div>
            <h5>Book Hospitals</h5>
            <p>Choose from a list of approved hospitals for timely vaccinations.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-box">
            <div class="feature-icon"><i class="fas fa-file-medical"></i></div>
            <h5>Download Reports</h5>
            <p>Access digital records of your child’s vaccine history instantly.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    &copy; <?php echo date('Y'); ?> VaxiPal. All rights reserved.
  </footer>

  <!-- Scripts -->
  <script src="adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
