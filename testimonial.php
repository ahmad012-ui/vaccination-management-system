<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <!-- font awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
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

         <!-- banner start -->
<!-- Banner Carousel Start (Desktop Optimized) -->
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 500px; overflow: hidden;">
  <div class="carousel-inner">
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="banner.jpg" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Doctor Banner">
    </div>

    <!-- Slide 2 (You can replace this with another image) -->
    <div class="carousel-item">
      <img src="img/banner2.jpg" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Health Awareness">
    </div>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"
      style="filter: brightness(0) invert(1); width: 45px; height: 45px;">
    </span>
    <span class="visually-hidden">Previous</span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"
      style="filter: brightness(0) invert(1); width: 45px; height: 45px;">
    </span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- Banner Carousel End -->

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
                        <img src="img/parent1.jpg" class="img-fluid rounded-circle" alt="">
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
                        <img src="img/parent2.jpg" class="img-fluid rounded-circle" alt="">
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
                        <img src="img/parent3.jpg" class="img-fluid rounded-circle" alt="">
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
                        <img src="img/parent4.jpg" class="img-fluid rounded-circle" alt="">
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