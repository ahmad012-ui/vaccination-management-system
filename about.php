<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccino - About Us</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link href="css/style.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet"> <!-- Optional: remove if duplicate -->

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script> <!-- if used -->
</head>

<body>

<?php include 'topbar.php'; ?>

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
    <a href="index.php" class="navbar-brand p-0">
      <h1 class="text-primary m-0"><i class="fas fa-syringe me-3"></i>Vaccino</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0">
        <a href="index.php" class="nav-item nav-link">Home</a>
        <a href="about.php" class="nav-item nav-link">How It Works</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="blog.php" class="dropdown-item">Our Blog</a>
            <a href="testimonial.php" class="dropdown-item">Feedback</a>
          </div>
        </div>
        <a href="contact.php" class="nav-item nav-link active">Contact Us</a>
      </div>
      <a href="login.php" class="btn btn-primary rounded-pill text-white py-2 px-4">Book Appointment</a>
      <a href="login.php" class="fa-solid fa-circle-user" style="font-size: 32px; margin-left: 20px;"></a>
    </div>
  </nav>
</div>
<!-- Navbar End -->

<!-- About Start -->
<div class="container-fluid about bg-light py-5">
  <div class="container py-5">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
        <div class="about-img pb-5 ps-5 position-relative">
          <img src="img/vaccine.jpg" class="img-fluid rounded w-100" style="object-fit: cover;" alt="Vaccination Awareness">
          <div class="about-img-inner position-absolute top-0 start-0 translate-middle">
            <img src="img/about-1.jpg" class="img-fluid rounded-circle w-100 h-100" alt="Child Immunization">
          </div>
          <div class="about-experience position-absolute bottom-0 start-0 bg-primary text-white px-3 py-1 rounded">10+ Years of Public Health</div>
        </div>
      </div>
      <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">
        <div class="section-title text-start mb-5">
          <h4 class="sub-title pe-3 mb-0">About Vaccino</h4>
          <h1 class="display-3 mb-4">We Are Working to Ensure Every Child Is Vaccinated</h1>
          <p class="mb-4">Vaccino is an online vaccination scheduling and awareness platform that simplifies immunization for parents and guardians. Our mission is to support timely and complete vaccination for all children in Pakistan through modern technology and healthcare coordination.</p>
          <div class="mb-4">
            <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i>Real-time reminders and booking options</p>
            <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i>Integrated government campaigns</p>
            <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i>Secure and private digital health records</p>
          </div>
          <a href="contact.php" class="btn btn-primary rounded-pill text-white py-3 px-5">Get Started</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End -->

<!-- Key Features Start -->
<div class="container-fluid feature py-5">
  <div class="container py-5">
    <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="sub-style">
        <h4 class="sub-title px-3 mb-0">Key Features</h4>
      </div>
      <h1 class="display-3 mb-4">Why Choose Vaccino?</h1>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="feature-item p-4">
          <div class="feature-icon mb-4">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm">
              <i class="fas fa-bell fa-3x text-primary"></i>
            </div>
          </div>
          <div class="feature-content d-flex flex-column">
            <h5 class="mb-3">Vaccination Reminders</h5>
            <p>Never miss a dose with automated SMS/email alerts and dashboards.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
        <div class="feature-item p-4">
          <div class="feature-icon mb-4">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm">
              <i class="fas fa-chart-line fa-3x text-primary"></i>
            </div>
          </div>
          <div class="feature-content d-flex flex-column">
            <h5 class="mb-3">Parent Dashboard</h5>
            <p>Track your child’s vaccination schedule and progress in one place.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
        <div class="feature-item p-4">
          <div class="feature-icon mb-4">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm">
              <i class="fas fa-calendar-check fa-3x text-primary"></i>
            </div>
          </div>
          <div class="feature-content d-flex flex-column">
            <h5 class="mb-3">Online Appointments</h5>
            <p>Book vaccination slots at nearby centers with just a few clicks.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
        <div class="feature-item p-4">
          <div class="feature-icon mb-4">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm">
              <i class="fas fa-bullhorn fa-3x text-primary"></i>
            </div>
          </div>
          <div class="feature-content d-flex flex-column">
            <h5 class="mb-3">Awareness Campaigns</h5>
            <p>Stay updated with national immunization drives and health education.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Key Features End -->

<?php include 'footer.php'; ?>

<!-- Theme Colors -->
<style>
:root {
  --primary: #00cdf5;
}
.text-primary {
  color: var(--primary) !important;
}
.bg-primary {
  background-color: var(--primary) !important;
}
.btn-primary {
  background-color: var(--primary) !important;
  border-color: var(--primary) !important;
}
.btn-primary:hover {
  background-color: #00b7db !important;
  border-color: #00b7db !important;
}
</style>

</body>
</html>
