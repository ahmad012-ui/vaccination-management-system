<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vaccination Blog - VMS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- Custom Styles -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        :root {
    --primary: #00ccff;
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
    background-color: #00ccff !important;
    border-color: #00ccff !important;
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
    color: #00ccff !important;
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
     
     <!-- banner -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" style="font-family: serif;" data-wow-delay="0.1s">Blog</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Home</a></li>
            <li class="breadcrumb-item"><a href="about.php" style="text-decoration: none;">About</a></li>
            <li class="breadcrumb-item active text-primary">Our Blog</li>
        </ol>    
    </div>
</div>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mt-5 px-4 px-lg-5 py-3 py-lg-0">
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
                    <a href="blog.php" class="nav-link">Blog</a>
                </div>
                <a href="contact.php" class="nav-item nav-link active">Contact Us</a>
            </div>
            <a href="login.php" class="btn btn-primary rounded-pill text-white py-2 px-4 ms-3">Book Appointment</a>
            <a href="login.php" class="text-primary" style="font-size: 32px; margin-left: 20px;"><i class="fa-solid fa-circle-user"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

   <!-- Blog Start -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h4 class="text-primary">Latest Health Updates</h4>
        <h1 class="mb-4">Vaccination Awareness & Updates</h1>
        <p>Stay informed about the importance of vaccines, health campaigns, and real-life success stories.</p>
    </div> 
    <div class="row g-4">
        <!-- Blog Card 1 -->
       <div class="col-lg-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.1s">
            <div class="card blog-card border-0 shadow-sm h-100">
                <img src="img/blog-child.jpg" class="card-img-top" alt="Awareness">
                <div class="card-body">
                    <h5 class="card-title">Why Childhood Vaccines Matter</h5>
                    <p class="card-text">Vaccines protect your child from deadly diseases. Learn what’s recommended by age.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>

        <!-- Blog Card 2 -->
        <div class="col-lg-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
            <div class="card blog-card border-0 shadow-sm h-100">
                <img src="img/child-blog.jpg" class="card-img-top" alt="Campaign">
                <div class="card-body">
                    <h5 class="card-title">National Immunization Drive 2025</h5>
                    <p class="card-text">Check schedules and how our system helps parents track and register easily.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>

        <!-- Blog Card 3 -->
      <div class="col-lg-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
            <div class="card blog-card border-0 shadow-sm h-100">
                <img src="img/parents.jpg" class="card-img-top" alt="Story">
                <div class="card-body">
                    <h5 class="card-title">Success Story: Preventing Outbreak</h5>
                    <p class="card-text">How a local hospital used our system to prevent a measles outbreak in 2025.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->

  <?php include 'footer.php'; ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>

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
