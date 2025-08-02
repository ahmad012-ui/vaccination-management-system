<!DOCTYPE php>
<php lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
     <!-- font awesome cdn -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Add this in your <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script> <!-- if used -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>


<link href="style.css" rel="stylesheet">
</body>
</php>
<?php include 'topbar.php'?>
   <!-- Navbar & Hero Start -->
   <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                   <h1 class="text-primary m-0"><i class="fas fa-syringe me-3"></i>Vaccino</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">Blog</a>
                        </div>
                        <a href="contact.php" class="nav-item nav-link active">Contact Us</a>
                    </div>
                    <a href="login.php" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0" >Book Appointment</a>
                    <a href="login.php"class="fa-solid fa-circle-user rounded-pill  px-1 flex-wrap primary" style="font-size: 32px; margin-left: 20px;"></i></a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

     <!-- banner -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">About Us</li>
        </ol>    
    </div>
</div>

<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="utf-8">
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

   
 

<!-- About Start -->
<div class="container-fluid about bg-light py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-img pb-5 ps-5" style="margin-right: 50px;">
                    <img src="img/about-pic.jpg" style="height: 400px; width: 400px; border-radius: 50%;" class="img-fluid" style="object-fit: cover;" alt="Vaccination Awareness">
                    <!-- <div class="about-img-inner">
                        <img src="" class="img-fluid rounded-circle w-100 h-100" alt="Child Immunization">
                    </div> -->
               
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
                 <a href="contact.php" class="btn btn-primary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.1s">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Key Features Start -->
<div class="container-fluid feature py-5 bg-light">
  <div class="container py-5">
    <div class="section-title mb-5 wow animate__animated animate__fadeInUp" data-wow-delay="0.1s">
      <div class="sub-style">
        <h4 class="sub-title px-3 mb-0 text-primary">Key Features</h4>
      </div>
      <h1 class="display-5 mb-4">Why Choose Vaccino?</h1>
    </div>
    <div class="row g-4 justify-content-center">

      <!-- Feature Card 1 -->
      <div class="col-md-6 col-lg-4 col-xl-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
          <div class="mb-3">
            <i class="fas fa-bell fa-3x text-primary"></i>
          </div>
          <h5 class="mb-2">Vaccination Reminders</h5>
          <p>Never miss a dose with automated SMS/email alerts and dashboards.</p>
        </div>
      </div>

      <!-- Feature Card 2 -->
      <div class="col-md-6 col-lg-4 col-xl-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
          <div class="mb-3">
            <i class="fas fa-chart-line fa-3x text-primary"></i>
          </div>
          <h5 class="mb-2">Parent Dashboard</h5>
          <p>Track your child’s vaccination schedule and progress in one place.</p>
        </div>
      </div>

      <!-- Feature Card 3 -->
      <div class="col-md-6 col-lg-4 col-xl-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.6s">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
          <div class="mb-3">
            <i class="fas fa-calendar-check fa-3x text-primary"></i>
          </div>
          <h5 class="mb-2">Online Appointments</h5>
          <p>Book vaccination slots at nearby centers with just a few clicks.</p>
        </div>
      </div>

      <!-- Feature Card 4 -->
      <div class="col-md-6 col-lg-4 col-xl-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
          <div class="mb-3">
            <i class="fas fa-bullhorn fa-3x text-primary"></i>
          </div>
          <h5 class="mb-2">Awareness Campaigns</h5>
          <p>Stay updated with national immunization drives and health education.</p>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- Key Features End -->

<!-- WOW.js Scroll Animation Init -->
<script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>
<script>
  new WOW().init();
</script>


<?php include 'footer.php'; ?>