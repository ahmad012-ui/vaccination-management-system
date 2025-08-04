<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Vaccino</title>
    <!-- Add this in your <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->
    
    <!-- icon --> <!-- Font & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script> <!-- if used -->
    <link href="style.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .login-wrapper {
            min-height: calc(100vh - 80px); /* adjust if navbar height changes */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background-color: #f8f9fa;
        }

        .login-container {
            display: block;
            justify-content: center;
            align-items: center;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .login-container .input-wrapper {
            position: relative;
        }

        .login-container .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #00cdf5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #00cdf5;
        }

        .login-container .links {
            margin-top: 16px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .login-container .links a {
            color: #00cdf5;
            text-decoration: none;
        }

        .login-container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim($_POST['password']);

    // Admin login
    if ($email === "admin@example.com" && $password === "admin123") {
        $_SESSION['role'] = "admin";
        $_SESSION['email'] = $email;
        header("Location: admin-dashboard/pages/dashboard.php");
        exit;
    }

    // Check in users table
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] === 'parent') {
            header("Location: user-dashboard/user-dashboard.php");
            exit;
        } elseif ($row['role'] === 'hospital') {
            // Hospital ID fetch
            $hQuery = "SELECT hospital_id FROM hospitals WHERE user_id = {$row['user_id']} LIMIT 1";
            $hResult = mysqli_query($conn, $hQuery);
            if ($hResult && mysqli_num_rows($hResult) > 0) {
                $hosp = mysqli_fetch_assoc($hResult);
                $_SESSION['hospital_id'] = $hosp['hospital_id'];
                header("Location: hospital_dashboard/pages/dashboard.php");
                exit;
            } else {
                echo "<script>
                    alert('Hospital account not properly linked.');
                    window.location.href = 'login.php';
                </script>";
                exit;
            }
        }
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href='login.php';</script>";
        exit;
    }
}
?>

<?php include 'topbar.php'; ?>
<?php include 'navbar.php'; ?>

<!-- login content -->
<section id="login" class="login-wrapper">
    <div class="login-container">
        <h2>Welcome Back</h2>
        <form action="login.php" method="POST">
            <input type="text" id="email" placeholder="Email" name="email" required />
            <div class="input-wrapper">
                <input type="password" id="password" placeholder="Password" name="password" required />
                <i class="fa fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="links">
            <a href="#">Forgot password?</a>
            <a href="signup.php">Sign up</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>