<?php
session_start();
include 'db.php';

$user_id = 1; // Static for now; replace with $_SESSION['user_id'] later

// Profile update logic (excluding password update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : null;

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', created_at='$dob' WHERE user_id=$user_id");

    if ($gender !== null) {
        $child_q = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = $user_id LIMIT 1");
        if (mysqli_num_rows($child_q) > 0) {
            $child = mysqli_fetch_assoc($child_q);
            mysqli_query($conn, "UPDATE children SET gender='$gender' WHERE child_id = {$child['child_id']}");
        }
    }
}

// Fetch user info
$user_q = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($user_q);

$user['vaccine'] = 'N/A';
$user['next_appointment'] = 'N/A';
$user['center'] = 'N/A';

$child_q = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = $user_id");
$user['children'] = [];
$user['doses'] = [];
$user['appointments'] = [];

while ($child = mysqli_fetch_assoc($child_q)) {
    $user['children'][] = $child;
    $child_id = $child['child_id'];

    $report_q = mysqli_query($conn, "
        SELECT 
            COALESCE(v.name, CONCAT('Vaccine ID: ', r.vaccine_id)) AS vaccine_name,
            r.date_given, r.status
        FROM vaccination_reports r
        LEFT JOIN vaccines v ON v.vaccine_id = r.vaccine_id
        WHERE r.child_id = $child_id
    ");
    while ($row = mysqli_fetch_assoc($report_q)) {
        $user['doses'][] = $row;
    }

    $appointment_q = mysqli_query($conn, "
        SELECT ar.*, h.name AS hospital_name, v.name AS vaccine_name
        FROM appointment_requests ar
        JOIN hospitals h ON ar.hospital_id = h.hospital_id
        JOIN vaccines v ON ar.vaccine_id = v.vaccine_id
        WHERE ar.child_id = $child_id
        ORDER BY ar.created_at DESC
    ");
    while ($a = mysqli_fetch_assoc($appointment_q)) {
        $user['appointments'][] = $a;

        if ($a['status'] === 'approved' && $user['next_appointment'] === 'N/A') {
            $user['vaccine'] = $a['vaccine_name'];
            $user['next_appointment'] = $a['preferred_date'];
            $user['center'] = $a['hospital_name'];
        }
    }
}

$child_gender = $user['children'][0]['gender'] ?? 'N/A';
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <meta charset="utf-8">
        <title>Terapia - Physical Therapy Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- font awesome cdn -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">
    <script>
        function toggleForm() {
            const form = document.getElementById('editForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-light">
     <div class="container-fluid bg-dark px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-light me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                        <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                        <a href="#" class="text-light me-0"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
                    </div>
                </div>
                 <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-0"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.html" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fas fa-star-of-life me-3"></i>Terapia</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link active">About</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="blog.html" class="dropdown-item">Our Blog</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact Us</a>
                    </div>
                    <a href="contact.html" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Book Appointment</a>
                    <a href="login.html"><i class="fa-solid fa-circle-user rounded-pill  px-1 flex-wrap primary" style="font-size: 32px; margin-left: 20px;"></i></a>
                </div>
            </nav>
        </div>
         <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">User Dashboard</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">About</li>
                </ol>    
            </div>
        </div>

<div class="container py-4">

    <h2>👤 User Dashboard</h2>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Your Profile</span>
            <a href="user-edit-profile.php" class="btn btn-sm btn-primary">✏️ Edit Profile</a>
            <!-- <button class="btn btn-sm btn-primary" onclick="toggleForm()">✏️ Edit Profile</button> -->
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Vaccination Info</div>
        <div class="card-body">
            <p><strong>Vaccine:</strong> <?= htmlspecialchars($user['vaccine']) ?></p>
            <p><strong>Next Appointment:</strong> <?= $user['next_appointment'] ?> at <strong><?= $user['center'] ?></strong></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Vaccination History</div>
        <div class="card-body">
            <?php if (count($user['doses'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Vaccine</th><th>Date</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user['doses'] as $dose): ?>
                            <tr>
                                <td><?= htmlspecialchars($dose['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($dose['date_given']) ?></td>
                                <td><?= htmlspecialchars($dose['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No vaccination records found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">📅 Appointment Requests</div>
        <div class="card-body">
            <?php if (count($user['appointments'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vaccine</th>
                            <th>Hospital</th>
                            <th>Preferred Date</th>
                            <th>Status</th>
                            <th>Requested At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user['appointments'] as $a): ?>
                            <tr>
                                <td><?= htmlspecialchars($a['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($a['hospital_name']) ?></td>
                                <td><?= htmlspecialchars($a['preferred_date']) ?></td>
                                <td>
                                    <?php if ($a['status'] === 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php elseif ($a['status'] === 'approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif ($a['status'] === 'rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($a['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No appointment requests found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mb-4" id="editForm" style="display: none;">
        <div class="card-header">✏️ Edit Your Profile</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>
                <div class="mb-2">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="<?= date('Y-m-d', strtotime($user['created_at'])) ?>" required>
                </div>
                <div class="mb-2">
                    <label>Child Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="male" <?= strtolower($child_gender) === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= strtolower($child_gender) === 'female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="logout.php" class="btn btn-danger btn-sm">🚪 Logout</a>
    </div>
</div>

 <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-white mb-4"><i class="fas fa-star-of-life me-3"></i>Terapia</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus dolorem impedit eos autem dolores laudantium quia, qui similique
                            </p>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Quick Links</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> About Us</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Our Blog & News</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Our Team</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Contact Info</h4>
                            <a href=""><i class="fa fa-map-marker-alt me-2"></i> 123 Street, New York, USA</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
