<?php include 'db.php'; ?>
<?php include 'topbar.php'; ?>
<?php include 'navbar.php'; ?>
<!-- Header Start -->
<!-- <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Medical Team</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="testimonial.php">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Team</li>
        </ol>    
    </div>
</div> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccino - Our Team</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
<!-- Breadcrumb Start -->
<div class="container-fluid bg-breadcrumb">
  <div class="container text-center py-5" style="max-width: 900px;">
    <h3 class="text-white display-3 mb-4 wow fadeInDown" style="font-family: serif;" data-wow-delay="0.1s">Home</h3>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
      <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Home</a></li>
      <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Pages</a></li>
      <li class="breadcrumb-item"><a href="contact.php" style="text-decoration: none;color: rgb(0, 204, 255);">Contact</a></li>
    </ol>
  </div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vaccination Request</title>
    <style>
      .form-container {
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px;
            box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            background-color: #007bff;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            width: 100%;
            font-size: 16px;
            border: 2px solid white;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<!-- Breadcrumb End -->
<!-- Team Start -->


<?php
$conn = mysqli_connect("localhost", "root", "", "e_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $child_name = $_POST['child_name']; // Modified to use child_name instead of child_id
    $hospital_id = $_POST['hospital_id'];
    $vaccine_id = $_POST['vaccine_id'];
    $preferred_date = $_POST['preferred_date'];
    $status = "Pending";
    $sql = "INSERT INTO appointment_requests (child_name, hospital_id, vaccine_id, preferred_date, status) 
            VALUES ('$child_name', '$hospital_id', '$vaccine_id', '$preferred_date', '$status')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Request submitted successfully!'); window.location.href='request_form.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
$hospitals = mysqli_query($conn, "SELECT hospital_id, name FROM hospitals");
$vaccines = mysqli_query($conn, "SELECT vaccine_id, name FROM vaccines");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccino - Send Vaccination Request</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="text-center mb-4" style="color:rgb(0, 204, 255);">Send Vaccination Request</h2>
                    <form action="submit_request.php" method="POST">
                        <!-- Updated field for child name input -->
                        <div class="mb-3">
                            <label for="child_name" class="form-label">Child's Name</label>
                            <input type="text" name="child_name" class="form-control" id="child_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="hospital_id" class="form-label">Hospital</label>
                            <select name="hospital_id" class="form-control" id="hospital_id" required>
                                <option value="">Select Hospital</option>
                                <?php while($row = mysqli_fetch_assoc($hospitals)) { ?>
                                    <option value="<?= $row['hospital_id'] ?>"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vaccine_id" class="form-label">Vaccine</label>
                            <select name="vaccine_id" class="form-control" id="vaccine_id" required>
                                <option value="">Select Vaccine</option>
                                <?php while($row = mysqli_fetch_assoc($vaccines)) { ?>
                                    <option value="<?= $row['vaccine_id'] ?>"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="preferred_date" class="form-label">Preferred Date</label>
                            <input type="date" name="preferred_date" class="form-control" id="preferred_date" required>
                        </div>

                        <button type="submit" style="background-color:rgb(0, 204, 255);" class="btn-submit">Send Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid team py-5" style="min-height: 900px;">
  <div class="container py-5">
    <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="sub-style">
        <h4 class="sub-title px-3 mb-0">Meet Our Experts</h4>
      </div>
      <h1 class="display-3 mb-4">Trusted Professionals Behind Your Child’s Health</h1>
      <p class="mb-0">Our dedicated medical professionals ensure that your children receive timely and safe vaccinations. Meet the people behind our trusted healthcare service.</p>
    </div>
    <div class="row g-4 justify-content-center">


      <!-- Doctor 1 -->
      <div class="col-md-6 col-lg-4 col-xl-3 d-flex">
  <div class="team-item rounded w-100">
    <div class="team-img rounded-top">
      <img src="img/team-1.jpg" class="img-fluid rounded-top" alt="Dr. Ayesha Khan">
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
      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
        <div class="team-item rounded">
          <div class="team-img rounded-top ">
            <img src="img/team-2.jpg" class="img-fluid rounded-top" alt="Dr. Saad Ahmed">
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
      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
        <div class="team-item rounded">
          <div class="team-img rounded-top">
            <img src="img/team-3.jpg" class="img-fluid rounded-top" alt="Dr. Mehwish Tariq">
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
      <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
        <div class="team-item rounded">
          <div class="team-img rounded-top">
            <img src="img/team-4.jpg" class="img-fluid rounded-top" alt="Dr. Waqas Rafi">
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
<!-- Team End -->
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
<?php include 'footer.php'; ?>
</body>
</html>
