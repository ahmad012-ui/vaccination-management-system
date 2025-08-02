<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Add this in your <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script> <!-- if used -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="style.css" rel="stylesheet">
    <style>

      .signup-wrapper {
        display: flex;
        justify-content: center;
        padding: 80px 20px;
        margin-top: 40px;
        margin-bottom: 60px;
      }

      main {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 450px;
      }

      h2 {
        text-align: center;
        margin-bottom: 24px;
        font-weight: 600;
      }

      .input {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
      }

      .button {
        width: 100%;
        padding: 12px;
        background-color: #00cdf5;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
      }

      .button:hover {
        background-color: #217dc4;
      }

      .links {
        margin-top: 16px;
        text-align: center;
        font-size: 14px;
      }

      .links a {
        color: #00cdf5;
        text-decoration: none;
      }

      .links a:hover {
        text-decoration: underline;
      }

      .error {
        color: red;
        font-size: 13px;
        margin-top: -12px;
        margin-bottom: 10px;
      }
    </style>
</head>
<body>
<?php
include 'db.php'; // database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $created_at = date("Y-m-d H:i:s");

    if (!empty($name) && !empty($email) && !empty($password)) {
        // Password hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, created_at)
                VALUES ('$name', '$email', '$hashedPassword', '$created_at')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php include 'navbar.php'; ?>

  <div class="signup-wrapper">
    <main>
      <header><h2>Create Your Account </h2></header>
      <section>
        <form id="signupForm" action="signup.php" method="POST" onsubmit="return validateSignup()">
          <label for="name" class="sr-only">Name</label>
          <input type="text" class="input" id="name" name="name" placeholder="Full Name" required />
          <div class="error" id="nameError"></div>

          <label for="email" class="sr-only">Email</label>
          <input type="email" class="input" id="email" name="email" placeholder="Email" required />
          <div class="error" id="emailError"></div>

          <label for="password" class="sr-only">Password</label>
          <input type="password" class="input" id="password" name="password" placeholder="Password" required />
          <div class="error" id="passwordError"></div>

          <button type="submit" name="signup" class="button">Sign Up</button>
        </form>
      </section>
      <footer class="links">
        Already have an account? <a href="login.html">Login</a>
      </footer>
    </main>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>


