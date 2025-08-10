<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // Get and sanitize input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // === BACKEND VALIDATION ===

    // 1. Validate name (only letters and spaces, at least 3 characters)
    if (!preg_match("/^[A-Za-z\s]{3,}$/", $name)) {
        echo "<script>alert('Full Name must be at least 3 characters and contain only letters and spaces.'); window.location.href='signup.php';</script>";
        exit;
    }

    // 2. Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.'); window.location.href='signup.php';</script>";
        exit;
    }

    // 3. Validate password (minimum 6 chars, one letter and one number)
    if (strlen($password) < 6 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/\d/", $password)) {
        echo "<script>alert('Password must be at least 6 characters and include at least one letter and one number.'); window.location.href='signup.php';</script>";
        exit;
    }

    // 4. Validate role
    if ($role !== 'parent' && $role !== 'hospital') {
        echo "<script>alert('Invalid role selected.'); window.location.href='signup.php';</script>";
        exit;
    }

    // 5. Check if email already exists
    $email_safe = mysqli_real_escape_string($conn, $email);
    $check_query = "SELECT * FROM users WHERE email = '$email_safe'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='signup.php';</script>";
        exit;
    }

    // 6. Hash the password
    $hashed_password = $password;

    // 7. Insert into users table
    $name_safe = mysqli_real_escape_string($conn, $name);
    $role_safe = mysqli_real_escape_string($conn, $role);
    $insert_query = "INSERT INTO users (name, email, password, role) VALUES ('$name_safe', '$email_safe', '$hashed_password', '$role_safe')";

    if (mysqli_query($conn, $insert_query)) {
        $user_id = mysqli_insert_id($conn);

        // === Hospital role-specific logic ===
        if ($role === 'hospital') {
            $hospital_name = trim($_POST['hospital_name']);
            $hospital_address = trim($_POST['hospital_address']);

            // Hospital fields validation
            if (empty($hospital_name) || empty($hospital_address)) {
                echo "<script>alert('Hospital name and address are required.'); window.location.href='signup.php';</script>";
                exit;
            }

            $hospital_name_safe = mysqli_real_escape_string($conn, $hospital_name);
            $hospital_address_safe = mysqli_real_escape_string($conn, $hospital_address);

            $hospital_query = "INSERT INTO hospitals (user_id, name, address, status) 
                               VALUES ('$user_id', '$hospital_name_safe', '$hospital_address_safe', 'active')";
            mysqli_query($conn, $hospital_query);
        }

        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
        exit;

    } else {
        echo "<script>alert('Registration failed!'); window.location.href='signup.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup-Vaccino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Add this in your <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->
    
    <!-- icon --> <!-- Font & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script> <!-- if used -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .signup-wrapper {
            min-height: calc(100vh - 80px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background-color: #f8f9fa;
        }

        .signup-container {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .signup-container input,
        .signup-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .signup-container button {
            width: 100%;
            padding: 12px;
            background-color: #00cdf5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .signup-container button:hover {
            background-color: #00cdf5;
        }

        .signup-container .links {
            margin-top: 16px;
            text-align: center;
            font-size: 14px;
        }

        .signup-container .links a {
            color: #00cdf5;
            text-decoration: none;
        }

        .signup-container .links a:hover {
            text-decoration: underline;
        }

        .hospital-fields {
            display: none;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<section id="signup" class="signup-wrapper">
    <div class="signup-container">
        <h2>Create Account</h2>
        <form action="signup.php" method="POST">
            <input type="text" placeholder="Full Name" name="name" required  pattern="[A-Za-z\s]{3,}"/>
            <input type="email" placeholder="Email" name="email" required />
            <input type="password" placeholder="Password" name="password" required  pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}" 
             title="Password must be at least 6 characters long and include a number." />
             <small>Password must be at least 6 characters long and include a letter and a number.</small>
            
            <select name="role" id="role" required onchange="toggleHospitalFields()">
                <option value="">Select Role</option>
                <option value="parent">Parent</option>
                <option value="hospital">Hospital</option>
            </select>
            
            <div class="hospital-fields" id="hospitalFields">
                <input type="text" placeholder="Hospital Name" name="hospital_name" />
                <input type="text" placeholder="Hospital Address" name="hospital_address" />
                <input type="text" placeholder="Hospital Phone" name="hospital_phone" pattern="^\d{11}$" title="Enter a valid 11-digit phone number." />
            </div>
            
            <button type="submit" name="signup">Sign Up</button>
        </form>
        <div class="links">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
</section>

<script>
function toggleHospitalFields() {
    const role = document.getElementById('role').value;
    const hospitalFields = document.getElementById('hospitalFields');
    
    if (role === 'hospital') {
        hospitalFields.style.display = 'block';
        // Make hospital fields required
        hospitalFields.querySelectorAll('input').forEach(input => {
            input.required = true;
        });
    } else {
        hospitalFields.style.display = 'none';
        // Remove required from hospital fields
        hospitalFields.querySelectorAll('input').forEach(input => {
            input.required = false;
        });
    }
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>