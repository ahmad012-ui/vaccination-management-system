<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default redirect to login
$dashboardLink = "login.php";

if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            $dashboardLink = "admin-dashboard/pages/dashboard.php";
            break;
        case 'hospital':
            $dashboardLink = "hospital_dashboard/pages/dashboard.php";
            break;
        case 'parent':
            $dashboardLink = "user-dashboard/user-dashboard.php";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" 
          integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">      
</head>
<body>

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
            <h1 class="m-0" style="color:rgb(0, 204, 255);">
                <i class="fas fa-syringe me-3"></i>Vaccino
            </h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="blog.php" class="nav-item nav-link">Blog</a>
                <a href="contact.php" class="nav-item nav-link">Contact Us</a>
            </div>
            
            

<a href="<?= $dashboardLink ?>" 
   class="btn rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0" 
   style="background-color:rgb(0, 204, 255);">
    Book Appointment
</a>

<a href="<?= $dashboardLink ?>" 
   class="fa-solid fa-circle-user px-1 flex-wrap" 
   style="color:rgb(0, 204, 255); font-size: 32px; margin-left: 20px;">
</a>
        </div>
    </nav>
</div>
<!-- Navbar End -->    
</body>
</html>