<?php
ini_set('session.gc_maxlifetime', 172800);
ini_set('session.cookie_lifetime', 172800);
session_start();

include 'db.php';
include 'topbar.php';
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'parent') {
        echo "<script>alert('You must be logged in as a parent to book.'); window.location.href='login.php';</script>";
        exit;
    }

    $parent_id = (int) $_SESSION['user_id'];

    $child_name = mysqli_real_escape_string($conn, $_POST['child_name']);
    $child_dob = $_POST['child_dob'];
    $child_gender = $_POST['child_gender'];
    $hospital_id = $_POST['hospital_id'];
    $vaccine_id = $_POST['vaccine_id'];
    $preferred_date = $_POST['preferred_date'];
    $status = "Pending";

    $child_insert_sql = "INSERT INTO children (parent_id, name, dob, gender) 
                         VALUES ('$parent_id', '$child_name', '$child_dob', '$child_gender')";
    
    if (mysqli_query($conn, $child_insert_sql)) {
        $child_id = mysqli_insert_id($conn);
        $appointment_sql = "INSERT INTO appointment_requests (child_id, hospital_id, vaccine_id, preferred_date, status) 
                            VALUES ('$child_id', '$hospital_id', '$vaccine_id', '$preferred_date', '$status')";
        
        if (mysqli_query($conn, $appointment_sql)) {
            echo "<script>alert('Vaccination request sent successfully.'); window.location.href='index.php';</script>";
        } else {
            echo "Appointment Error: " . mysqli_error($conn);
        }
    } else {
        echo "Child Insert Error: " . mysqli_error($conn);
    }
}

$hospitals = mysqli_query($conn, "SELECT hospital_id, name FROM hospitals WHERE status='active'");
$vaccines = mysqli_query($conn, "SELECT vaccine_id, name FROM vaccines");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccino - Vaccination Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" 
          integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
          overflow-x: auto;
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
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
            background-color: #00ccff;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            width: 100%;
            font-size: 16px;
            border: none;
        }
        
        .btn-submit:hover {
            background-color: #0099cc;
        }
    </style>
</head>
<body>

<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5">
        <h3 class="text-white display-3 mb-4" style="font-family: serif;">Home</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item" style="color:rgb(0, 204, 255);"><a href="index.php" style="text-decoration: none;">Home</a></li>
        </ol>
    </div>
</div>

<!-- Form Start -->
<div class="container mt-5 w-100">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-lg-8">
            <div class="form-container">
                <h2 class="text-center mb-4 text-custom">Send Vaccination Request</h2>
                
                <form method="POST" <?php if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'parent') echo 'onsubmit="alert(\'Please login first\'); return false;"'; ?>>

                    <!-- Child Name: Only letters, spaces, and hyphens -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" 
                               name="child_name" 
                               class="form-control" 
                               pattern="^[A-Za-z\s\-]{2,50}$" 
                               title="Name should be 2-50 characters long and contain only letters, spaces, and hyphens." 
                               required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="child_dob" class="form-control" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="child_gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Hospital -->
                    <div class="mb-3">
                        <label for="hospital_id" class="form-label">Hospital</label>
                        <select name="hospital_id" class="form-control" required>
                            <option value="">Select Hospital</option>
                            <?php while ($row = mysqli_fetch_assoc($hospitals)) { ?>
                                <option value="<?= $row['hospital_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Vaccine -->
                    <div class="mb-3">
                        <label for="vaccine_id" class="form-label">Vaccine</label>
                        <select name="vaccine_id" class="form-control" required>
                            <option value="">Select Vaccine</option>
                            <?php while ($row = mysqli_fetch_assoc($vaccines)) { ?>
                                <option value="<?= $row['vaccine_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Preferred Date -->
                    <div class="mb-3">
                        <label class="form-label">Preferred Date</label>
                        <input type="date" name="preferred_date" class="form-control" required>
                    </div>

                    <button type="submit" class="btn-submit">Send Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->


<div class="container-fluid team py-5" style="min-height: 900px;">
    <div class="container py-5">
        <div class="section-title mb-5 wow fadeInUp text text-center" data-wow-delay="0.1s">
            <div class="sub-style" style="color: rgb(0, 204, 255);">
                <h4 class="sub-title px-3 mb-0">Meet Our Experts</h4>
            </div>
            <h1 class="display-3 mb-4">Trusted Professionals Behind Your Child's Health</h1>
            <p class="mb-0">Our dedicated medical professionals ensure that your children receive timely and safe vaccinations. Meet the people behind our trusted healthcare service.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- Doctor 1 -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded">
                    <div class="team-img rounded-top">
                        <img src="img/team-2.jpg" class="img-fluid rounded-top" alt="Dr. Saad Ahmed">
                        <div class="team-icon d-flex justify-content-center">
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-content text text-center border border-top-0 rounded-bottom p-4">
                        <h5>Dr. Saad Ahmed</h5>
                        <p class="mb-0 text-dark">Child Health Consultant</p>
                    </div>
                </div>
            </div>
            
            <!-- Doctor 2 -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded w-100">
                    <div class="team-img rounded-top">
                        <img src="img/team-1.jpg" class="img-fluid rounded-top" alt="Dr. Ayesha Khan">
                        <div class="team-icon d-flex justify-content-center">
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-content text text-center border border-top-0 rounded-bottom p-4">
                        <h5>Dr. Ayesha Khan</h5>
                        <p class="mb-0 text-dark">Pediatric Vaccination Specialist</p>
                    </div>
                </div>
            </div>

            <!-- Doctor 3 -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded">
                    <div class="team-img rounded-top">
                        <img src="img/team-3.jpg" class="img-fluid rounded-top" alt="Dr. Mehwish Tariq">
                        <div class="team-icon d-flex justify-content-center">
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-content text text-center border border-top-0 rounded-bottom p-4">
                        <h5>Dr. Mehwish Tariq</h5>
                        <p class="mb-0 text-dark">Immunization Program Officer</p>
                    </div>
                </div>
            </div>
            
            <!-- Doctor 4 -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded">
                    <div class="team-img rounded-top">
                        <img src="img/team-4.jpg" class="img-fluid rounded-top" alt="Dr. Waqas Rafi">
                        <div class="team-icon d-flex justify-content-center">
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-content text text-center border border-top-0 rounded-bottom p-4">
                        <h5>Dr. Waqas Rafi</h5>
                        <p class="mb-0 text-dark">Public Health Health Officer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#child_id').change(function() {
            var child_id = $(this).val();
            if (child_id) {
                $.ajax({
                    url: 'get_child_info.php',
                    type: 'GET',
                    data: { child_id: child_id },
                    success: function(data) {
                        var child = JSON.parse(data);
                        $('#child_dob').val(child.dob);
                        $('#child_gender').val(child.gender);
                    },
                    error: function() {
                        $('#child_dob').val('');
                        $('#child_gender').val('');
                    }
                });
            } else {
                $('#child_dob').val('');
                $('#child_gender').val('');
            }
        });
    });
</script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
</body>
</html>