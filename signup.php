<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $created_at = date("Y-m-d H:i:s");

    // Server-side validation
    if (empty($name) || !preg_match("/^[A-Za-z\s]+$/", $name)) {
        echo "<script>alert('Invalid name. Only letters and spaces allowed.');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.');</script>";
    } else {
        // All good, insert into database
        $Password = $password ;

        $sql = "INSERT INTO users (name, email, password, created_at)
                VALUES ('$name', '$email', '$Password', '$created_at')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>

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


?>

<?php include 'topbar.php'; ?>
<?php include 'navbar.php'; ?>

  <div class="signup-wrapper">
    <main>
      <header><h2>Create Your Account</h2></header>
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
        Already have an account? <a href="login.php">Login</a>
      </footer>
    </main>
  </div>
  <script>
function validateSignup() {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  let isValid = true;

  // Reset errors
  document.getElementById("nameError").textContent = "";
  document.getElementById("emailError").textContent = "";
  document.getElementById("passwordError").textContent = "";

  // Name validation (only letters and spaces)
  const nameRegex = /^[A-Za-z\s]+$/;
  if (!nameRegex.test(name)) {
    document.getElementById("nameError").textContent = "Name must contain only letters and spaces.";
    isValid = false;
  }

  // Email validation
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
if (!emailRegex.test(email)) {
  document.getElementById("emailError").textContent = "Please enter a valid email address (e.g. name@example.com).";
  isValid = false;
}


  // Password validation
  if (password.length < 6) {
    document.getElementById("passwordError").textContent = "Password must be at least 6 characters long.";
    isValid = false;
  }

  return isValid;
}
</script>

  <?php include 'footer.php'; ?>
</body>
</html>

