<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Scriptory</title>
   <!-- Add this in your <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script> <!-- if used -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="style.css" rel="stylesheet">
<?php
if (isset($_POST['login'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href='login.php';</script>";
        exit();
    }

    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters.'); window.location.href='login.php';</script>";
        exit();
    }

    // Continue with login logic...
}
?>
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
include "db.php";

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($email === "admin" && $password === "admin123") {
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'admin';

    echo "<script>
      alert('Login successful');
      window.location.href = 'admin_panel.php';
    </script>";
    exit;
  } else {
    echo "<script>
      alert('Invalid email or password');
      window.location.href = 'login.php';
    </script>";
  }
};

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate directly from users table
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_name'] = $row['full_name'];

        header("Location: user-dashboard.php");
       echo "<script>alert('Login successful! Welcome, $name!');</script>";
       exit();

    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
    echo "Email: $email<br>";
echo "Password: $password<br>";
exit();
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
        <input type="password" id="password" placeholder="Password"  name="password" required />
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
<script>
function validateForm() {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  const nameRegex = /^[A-Za-z\s]+$/;


  if (email === "" || !email.includes("@") || !email.includes(".")) {
    alert("Please enter a valid email.");
    return false;
  }

  if (password.length < 6) {
    alert("Password must be at least 6 characters.");
    return false;
  }

  return true;
}
</script>

</body>
</html>

<?php include 'footer.php'; ?>