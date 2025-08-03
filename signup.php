<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='signup.php';</script>";
        exit;
    }

    // Insert new user
    $insert_query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if (mysqli_query($conn, $insert_query)) {
        $user_id = mysqli_insert_id($conn);
        
        // If role is hospital, create hospital record
        if ($role === 'hospital') {
            $hospital_name = mysqli_real_escape_string($conn, $_POST['hospital_name']);
            $hospital_address = mysqli_real_escape_string($conn, $_POST['hospital_address']);
            $hospital_phone = mysqli_real_escape_string($conn, $_POST['hospital_phone']);
            
            $hospital_query = "INSERT INTO hospitals (user_id, name, address, phone, status) 
                              VALUES ('$user_id', '$hospital_name', '$hospital_address', '$hospital_phone', 'active')";
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
            <input type="text" placeholder="Full Name" name="name" required />
            <input type="email" placeholder="Email" name="email" required />
            <input type="password" placeholder="Password" name="password" required />
            
            <select name="role" id="role" required onchange="toggleHospitalFields()">
                <option value="">Select Role</option>
                <option value="parent">Parent</option>
                <option value="hospital">Hospital</option>
            </select>
            
            <div class="hospital-fields" id="hospitalFields">
                <input type="text" placeholder="Hospital Name" name="hospital_name" />
                <input type="text" placeholder="Hospital Address" name="hospital_address" />
                <input type="text" placeholder="Hospital Phone" name="hospital_phone" />
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


