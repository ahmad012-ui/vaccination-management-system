<?php include 'db.php'; ?>
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
                        <a href="about.php" class="nav-item nav-link">About Us</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="blog.php" class="dropdown-item">Our Blog</a>
                                <a href="testimonial.php" class="dropdown-item">Feedback</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link active">Contact Us</a>
                    </div>
                    <a href="login.php" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0" >Book Appointment</a>
                    <a href="login.php"class="fa-solid fa-circle-user rounded-pill  px-1 flex-wrap primary" style="font-size: 32px; margin-left: 20px;"></i></a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                     <li class="breadcrumb-item"><a href="contact.php">contact</a></li>
                </ol>    
            </div>
        </div>
        <?php
$conn = mysqli_connect("localhost", "root", "", "e_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$child_id = $_POST['child_id'];
$hospital_id = $_POST['hospital_id'];
$vaccine_id = $_POST['vaccine_id'];
$preferred_date = $_POST['preferred_date'];
$status = "Pending"; // default status

$sql = "INSERT INTO appointment_requests (child_id, hospital_id, vaccine_id, preferred_date, status)
        VALUES ('$child_id', '$hospital_id', '$vaccine_id', '$preferred_date', '$status')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Request submitted successfully!'); window.location.href='request_form.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
}
mysqli_close($conn);
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "e_project");

$children = mysqli_query($conn, "SELECT child_id, name FROM children");
$hospitals = mysqli_query($conn, "SELECT hospital_id, name FROM hospitals");
$vaccines = mysqli_query($conn, "SELECT vaccine_id, name FROM vaccines");

?>
<?php
$result = mysqli_query($conn, "SELECT child_id, name FROM children");

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vaccination Request</title>
</head>
<body>
    <h2>Send Vaccination Request</h2>
    <form action="submit_request.php" method="POST">
        <label>Child:</label>
        <select name="child_id" required>
            <option value="">Select Child</option>
            <?php while($row = mysqli_fetch_assoc($children)) { ?>
                <option value="<?= $row['child_id'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select><br><br>

        <label>Hospital:</label>
        <select name="hospital_id" required>
            <option value="">Select Hospital</option>
            <?php while($row = mysqli_fetch_assoc($hospitals)) { ?>
                <option value="<?= $row['hospital_id'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select><br><br>

        <label>Vaccine:</label>
        <select name="vaccine_id" required>
            <option value="">Select Vaccine</option>
            <?php while($row = mysqli_fetch_assoc($vaccines)) { ?>
                <option value="<?= $row['vaccine_id'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select><br><br>

        <label>Preferred Date:</label>
        <input type="date" name="preferred_date" required><br><br>

        <button type="submit">Send Request</button>
    </form>
</body>
</html>


<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Medical Team</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="testimonial.php">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Team</li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<!-- Team Start -->
<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="sub-style">
                <h4 class="sub-title px-3 mb-0">Meet Our Experts</h4>
            </div>
            <h1 class="display-3 mb-4">Trusted Professionals Behind Your Child’s Health</h1>
            <p class="mb-0">Our dedicated medical professionals ensure that your children receive timely and safe vaccinations. Meet the people behind our trusted healthcare service.</p>
        </div>
        <div class="row g-4 justify-content-center">

           <div class="row g-4 justify-content-center">

    <!-- Doctor 1 -->
    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="team-item rounded">
            <div class="team-img rounded-top h-100">
                <div class="team-icon d-flex justify-content-center">
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                <h5>Dr. Ayesha Khan</h5>
                <p class="mb-0">Pediatric Vaccination Specialist</p>
            </div>
        </div>
    </div>

    <!-- Doctor 2 -->
    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
        <div class="team-item rounded">
            <div class="team-img rounded-top h-100">
                <div class="team-icon d-flex justify-content-center">
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                <h5>Dr. Saad Ahmed</h5>
                <p class="mb-0">Child Health Consultant</p>
            </div>
        </div>
    </div>

    <!-- Doctor 3 -->
    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
        <div class="team-item rounded">
            <div class="team-img rounded-top h-100">
                <div class="team-icon d-flex justify-content-center">
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                <h5>Dr. Mehwish Tariq</h5>
                <p class="mb-0">Immunization Program Officer</p>
            </div>
        </div>
    </div>

    <!-- Doctor 4 -->
    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
        <div class="team-item rounded">
            <div class="team-img rounded-top h-100">

                <div class="team-icon d-flex justify-content-center">
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                <h5>Dr. Waqas Rafi</h5>
                <p class="mb-0">Public Health Officer</p>
            </div>
        </div>
    </div>

</div>


        </div>
    </div>
</div>
<!-- Team End -->

        <!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Project Info -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4"><i class="fas fa-syringe me-3"></i>Vaccino</h4>
                    <p>Vaccino is an online vaccination booking and management system helping parents schedule timely vaccinations for their children with ease and convenience.</p>
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
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Quick Links</h4>
                    <a href="about.html"><i class="fas fa-angle-right me-2"></i> About Us</a>
                    <a href="contact.html"><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                    <a href="blog.html"><i class="fas fa-angle-right me-2"></i> News & Updates</a>
                    <a href="team.html"><i class="fas fa-angle-right me-2"></i> Our Team</a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Contact Info</h4>
                    <a href="#"><i class="fa fa-map-marker-alt me-2"></i> Karachi, Pakistan</a>
                    <a href="mailto:info@vaccino.com"><i class="fas fa-envelope me-2"></i> info@vaccino.com</a>
                    <a href="mailto:support@vaccino.com"><i class="fas fa-envelope me-2"></i> support@vaccino.com</a>
                    <a href="tel:+923001234567"><i class="fas fa-phone me-2"></i> +92 300 1234567</a>
                    <a href="#"><i class="fas fa-print me-2"></i> +92 300 1234567</a>
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