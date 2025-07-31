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

  <!-- font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Custom CSS -->
  <link href="css/style.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet"> <!-- Optional: remove if duplicate -->

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script> <!-- if used -->
</head>

<body>

  <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0 align-items-center" style="height: 45px;">
            <div class="col-lg-8 text-center text-lg-start">
                <div class="d-flex flex-wrap">
                    <a href="#" class="text-light me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                    <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                    <a href="#" class="text-light"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-light btn-square border rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-light btn-square border rounded-circle me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-light btn-square border rounded-circle me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-light btn-square border rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

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
        <a href="about.php" class="nav-item nav-link">About</a>
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
      <a href="login.php" class="text-primary" style="font-size: 32px; margin-left: 20px;"><i class="fa-solid fa-circle-user"></i></a>
      <!-- <a href="login.php" class="fa-solid fa-circle-user" style="font-size: 32px; margin-left: 20px;"></a> -->
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
          <div class="">
            <img src="img/about-pic.jpg" class="img-fluid rounded-circle" style="height: 400px; width: 400px; object-fit: cover;" alt="Child Immunization">
          </div>
        </div>
      </div>
      <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">
        <div class="section-title text-start mb-5">
          <h4 class="sub-title pe-3 mb-0 mt-5">About Vaccino</h4>
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
        <div class="feature-item p-4"style="height: 255px;">
          <div class="feature-icon mb-4" style="position: relative; right: 15px;">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm" style="height: 90px;">
              <i class="fas fa-bell fa-3x text-primary"></i>
            </div>
          </div>
           <div class="feature-content d-flex flex-column" style="margin-left: 0px;" >
            <h5 class="mb-3">Vaccination Reminders</h5>
            <p>Never miss a dose with automated SMS/email alerts and dashboards.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
        <div class="feature-item p-4"style="height: 255px;">
          <div class="feature-icon mb-4" style="position: relative; right: 15px;">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm" style="height: 90px;">
              <i class="fas fa-chart-line fa-3x text-primary"></i>
            </div>
          </div>
           <div class="feature-content d-flex flex-column" style="margin-left: 0px;" >
            <h5 class="mb-3">Parent Dashboard</h5>
            <p>Track your child’s vaccination schedule and progress in one place.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
        <div class="feature-item p-4" style="height: 255px;">
          <div class="feature-icon mb-4" style="position: relative; right: 15px;">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm" style="height: 90px;">
              <i class="fas fa-calendar-check fa-3x text-primary"></i>
            </div>
          </div>
           <div class="feature-content d-flex flex-column" style="margin-left: 0px;" >
            <h5 class="mb-3">Online Appointments</h5>
            <p>Book vaccination slots at nearby centers with just a few clicks.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
        <div class="feature-item p-4" style="height: 255px;">
          <div class="feature-icon mb-4" style="position: relative; right: 15px;">
            <div class="p-3 d-inline-flex bg-white rounded-circle shadow-sm" style="height: 90px;">
              <i class="fas fa-bullhorn fa-3x text-primary"></i>
            </div>
          </div>
          <div class="feature-content d-flex flex-column" style="margin-left: 0px;" >
            <h5 class="mb-3">Awareness Campaigns</h5>
            <p>Stay updated with national immunization drives and health education.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Key Features End -->


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
  <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Project Info -->
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4"><i class="fas fa-syringe me-3"></i>Vaccino</h4>
                    <p class="text-white" style="text-decoration: none;">Vaccino is an online vaccination booking and management system helping parents schedule timely vaccinations for their children with ease and convenience.</p>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-share fa-2x text-white me-2"></i>
                        <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Quick Links</h4>
                    <a href="about.html" class="text-white" style="text-decoration: none;"><i class="fas fa-angle-right text-white me-2"></i> About Us</a>
                    <a href="contact.html" class="text-white" style="text-decoration: none;"><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                    <a href="#" class="text-white" style="text-decoration: none;"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                    <a href="#" class="text-white" style="text-decoration: none;"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                    <a href="blog.html" class="text-white" style="text-decoration: none;"><i class="fas fa-angle-right me-2"></i> News & Updates</a>
                    <a href="team.html" class="text-white" style="text-decoration: none;"><i class="fas fa-angle-right me-2"></i> Our Team</a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Contact Info</h4>
                    <a href="#"class="text-white" style="text-decoration: none;"><i class="fa fa-map-marker-alt me-2"></i> Karachi, Pakistan</a>
                    <a href="mailto:info@vaccino.com"class="text-white" style="text-decoration: none;"><i class="fas fa-envelope me-2"></i> info@vaccino.com</a>
                    <a href="mailto:support@vaccino.com"class="text-white" style="text-decoration: none;"><i class="fas fa-envelope me-2"></i> support@vaccino.com</a>
                    <a href="tel:+923001234567" class="text-white" style="text-decoration: none;"><i class="fas fa-phone me-2"></i> +92 300 1234567</a>
                    <a href="#"class="text-white" style="text-decoration: none;"><i class="fas fa-print me-2"></i> +92 300 1234567</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
