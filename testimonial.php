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
<?php include 'navbar.php'; ?>
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Testimonial</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Testimonial</li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<!-- Testimonial Start -->
<div class="container-fluid testimonial py-5 wow zoomInDown" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title mb-5">
            <div class="sub-style">
                <h4 class="sub-title text-white px-3 mb-0">Testimonial</h4>
            </div>
            <h1 class="display-3 mb-4">What Clients Are Saying</h1>
        </div>
        <div class="testimonial-carousel owl-carousel">

            <!-- Testimonial 1 -->
            <div class="testimonial-item">
                <div class="testimonial-inner p-5">
                    <div class="testimonial-inner-img mb-4">
                        <img src="parent1.jpg" class="img-fluid rounded-circle" alt="">
                    </div>
                    <p class="text-white fs-7">
                        Booking my child's vaccination online saved so much time. The reminders were super helpful!
                    </p>
                    <div class="text-center">
                        <h5 class="mb-2">Ayesha Khan</h5>
                        <p class="mb-2 text-white-50">Karachi, Pakistan</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star-half-alt text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-item">
                <div class="testimonial-inner p-5">
                    <div class="testimonial-inner-img mb-4">
                        <img src="parent2.jpg" class="img-fluid rounded-circle" alt="">
                    </div>
                    <p class="text-white fs-7">
                        I loved how easy it was to find a nearby hospital and book an appointment.
                    </p>
                    <div class="text-center">
                        <h5 class="mb-2">Imran Sheikh</h5>
                        <p class="mb-2 text-white-50">Lahore, Pakistan</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-item">
                <div class="testimonial-inner p-5">
                    <div class="testimonial-inner-img mb-4">
                        <img src="parent3.jpg" class="img-fluid rounded-circle" alt="">
                    </div>
                    <p class="text-white fs-7">
                        The dashboard for parents is amazing. I could see vaccination history anytime!
                    </p>
                    <div class="text-center">
                        <h5 class="mb-2">Muneeb Zulfiqar</h5>
                        <p class="mb-2 text-white-50">Rawalpindi, Pakistan</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star-half-alt text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="testimonial-item">
                <div class="testimonial-inner p-5">
                    <div class="testimonial-inner-img mb-4">
                        <img src="parent4.jpg" class="img-fluid rounded-circle" alt="">
                    </div>
                    <p class="text-white fs-7">
                        Great service! I was able to get confirmation and vaccine updates on time.
                    </p>
                    <div class="text-center">
                        <h5 class="mb-2">Talha Mansoor</h5>
                        <p class="mb-2 text-white-50">Hyderabad, Pakistan</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Testimonial End -->

<?php include 'footer.php'; ?>
