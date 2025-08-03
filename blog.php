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
<?php include 'navbar.php'; ?>

<!-- Banner -->
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
                    <p class="card-text">Vaccines protect your child from deadly diseases. Learn what's recommended by age.</p>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>

</body>
</html>
