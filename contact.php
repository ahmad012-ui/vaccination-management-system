<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- Add this in your <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"> <!-- your main template stylesheet -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script> <!-- if used -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="style.css" rel="stylesheet">
</body>
</html>

  <?php include 'topbar.php'; ?>
  <?php include 'navbar.php'; ?>

  <!-- Header -->
  <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5">
      <h3 class="text-white display-3 mb-4">Contact Us</h3>
      <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="blog.php">Pages</a></li>
        <li class="breadcrumb-item active text-primary">Contact</li>
      </ol>
    </div>
  </div>

  <!-- PHP Form Submission -->
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'] ?? '';
      $email = $_POST['email'] ?? '';
      $subject = $_POST['subject'] ?? '';
      $message = $_POST['message'] ?? '';
      $phone = $_POST['phone'] ?? '';
      $created_at = date('Y-m-d H:i:s');

      if (!empty($name) && !empty($email) && !empty($message)) {
          $sql = "INSERT INTO contact_messages (name, email, subject, message, phone, created_at)
                  VALUES ('$name', '$email', '$subject', '$message', '$phone', '$created_at')";
          if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";

          } else {
              echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
          }
      } else {
        echo "<script>alert('Message failed!'); window.location.href='contact.php';</script>";
      }
  }
  ?>

  <!-- Contact Form -->
  <div class="container my-5">
    <form method="POST" action="contact.php">
      <div class="row g-3">
        <div class="col-md-6">
          <input type="text" name="name" class="form-control border-0 p-3" placeholder="Your Name" required>
        </div>
        <div class="col-md-6">
          <input type="email" name="email" class="form-control border-0 p-3" placeholder="Your Email" required>
        </div>
        <div class="col-12">
          <input type="text" name="phone" class="form-control border-0 p-3" placeholder="Your Phone" required>
        </div>
        <div class="col-12">
          <input type="text" name="subject" class="form-control border-0 p-3" placeholder="Subject" required>
        </div>
        <div class="col-12">
          <textarea name="message" class="form-control border-0 p-3" rows="5" placeholder="Your Message" required></textarea>
        </div>
        <div class="col-12">
          <button class="btn btn-dark w-100 py-3" type="submit">Send Message</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Address Info -->
  <div class="container mb-5">
    <div class="col-lg-6">
      <h5 class="mb-4">Addresses</h5>
      <p><i class="fas fa-map-marker-alt me-2"></i>123 Karachi Street, Pakistan</p>
      <p><i class="fas fa-phone-alt me-2"></i>+92 300 1234567</p>
      <p><i class="fas fa-envelope me-2"></i>info@vaccino.com</p>
      <div class="mt-4">
        <iframe src="https://maps.google.com/maps?q=karachi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

