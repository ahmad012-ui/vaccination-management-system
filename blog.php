<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vaccino Blog | Vaccine Awareness, Health Campaigns & Immunization Updates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="css/style.css" rel="stylesheet">
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

.btn-outline-primary {
    color: var(--primary);
    border-color: var(--primary);
}

.btn-outline-primary:hover {
    background-color: var(--primary);
    color: #fff;
}

a.text-primary:hover {
    color: #00b7db !important;
}

    </style>
</head>

<body>
    <?php include 'topbar.php'; ?>
    <!-- Topbar Start -->
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
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0 mt-5">
        <a href="index.html" class="navbar-brand p-0">
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
                        <a href="team.php" class="dropdown-item">Our Team</a>
                        <a href="testimonial.php" class="dropdown-item">Feedback</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link active">Contact Us</a>
            </div>
            <a href="login.php" class="btn btn-primary rounded-pill text-white py-2 px-4 ms-3">Book Appointment</a>
            <a href="login.php" class="text-primary" style="font-size: 32px; margin-left: 20px;"><i class="fa-solid fa-circle-user"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Blog Start -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h4 class="text-primary mt-5">Latest Health Updates</h4>
            <h1 class="mb-4">Vaccination Awareness & Updates</h1>
            <p>Stay informed about the importance of vaccines, health campaigns, and real-life success stories.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <img src="img/blog-child.jpg" style="height: 300px;" class="card-img-top" alt="Awareness">
                    <div class="card-body">
                        <h5 class="card-title">Why Childhood Vaccines Matter</h5>
                        <p class="card-text">Vaccines protect your child from deadly diseases. Learn what’s recommended by age.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <img src="img/child-blog.jpg" style="height: 300px;" class="card-img-top" alt="Campaign">
                    <div class="card-body">
                        <h5 class="card-title">National Immunization Drive 2025</h5>
                        <p class="card-text">Check schedules and how our system helps parents track and register easily.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <img src="img/parents.jpg" style="height: 300px;" class="card-img-top" alt="Story">
                    <div class="card-body">
                        <h5 class="card-title">Success Story: Preventing Outbreak</h5>
                        <p class="card-text">How a local hospital used our system to prevent a measles outbreak in 2024.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

  <!-- Footer Start -->
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
<!-- Footer End -->

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
<!-- Book Vaccination End -->
 <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <!-- Bootstrap Bundle JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery if needed -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Custom JS -->
<script src="js/main.js"></script>