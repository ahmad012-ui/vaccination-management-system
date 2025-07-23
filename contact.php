<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- Add this in your <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script> <!-- if used -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="style.css" rel="stylesheet">
</body>
</html>
<?php include 'topbar.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title >Contact Us - Vaccination Booking System </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Font & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap & Libraries -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

   

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="blog.php">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">Contact</li>
                </ol>    
            </div>
        </div>
        <!-- contact.php -->
    <!-- Header End -->

    <!-- Contact Section Start -->
    <div class="container-fluid py-5 bg-info text-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="text-white">Get in Touch</h2>
                <p>If you have any questions about vaccination schedules or hospital booking, feel free to contact us.</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-6">
                    <form method="POST" action="contact.php">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control border-0 p-3" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control border-0 p-3" placeholder="Your Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" name="phone" class="form-control border-0 p-3" placeholder="Your Phone" required>
                            </div>
                            <div class="col-12">
                                <input type="text" name="subject" class="form-control border-0 p-3" placeholder="Subject" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control border-0 p-3" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-dark w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h5 class="mb-4">Addresses</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i>123 Karachi Street, Pakistan</p>
                    <p><i class="fas fa-phone-alt me-2"></i>+92 300 1234567</p>
                    <p><i class="fas fa-envelope me-2"></i>info@vaccino.com</p>

                    <div class="mt-4">
                        <iframe src="https://maps.google.com/maps?q=karachi&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->
<?php include 'footer.php'; ?>