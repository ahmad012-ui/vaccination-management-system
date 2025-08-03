<?php include 'db.php'; ?>
<?php include 'topbar.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us | Vaccino</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="css/style.css"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background-color: #00ccff;
    }
    .contact-form input,
    .contact-form textarea {
      border: 1px solid #fff;
      background-color: transparent;
      color: white;
    }
    .contact-form ::placeholder {
      color: white;
    }
    .icon-circle {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #00ccff;
      font-size: 18px;
    }
    .social-icon {
      background-color: white;
      color: black;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
    }

    #form::placeholder,
    textarea::placeholder {
  color: rgba(255, 255, 255, 1);
  opacity: 1; /* make sure it's not transparent */
}
    
  
  </style>
</head>
<body>

<!-- Header -->
<div class="container-fluid bg-breadcrumb">
  <div class="container text-center py-5">
    <h3 class="text-white display-3 mb-4" style="font-family: serif;">Contact Us</h3>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Home</a></li>
      <li class="breadcrumb-item"><a href="blog.php" style="text-decoration: none;">Blog</a></li>
      <li class="breadcrumb-item" style="color:rgb(0, 204, 255);">Contact</li>
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

<!-- Contact Section Start -->
<div class="container-fluid py-5" style="background-color: #00ccff;">
  <div class="container py-5">
    <div class="row g-4 align-items-stretch">

      <!-- Left: Contact Form -->
      <div class="col-lg-5">
        <h2 class="text-white mb-4">Get in Touch</h2>
        <form method="POST" action="contact.php">
          <div class="mb-3">
            <input type="text"  id="form" name="name" class="form-control border border-white text-white bg-transparent" placeholder="Your Name" required>
          </div>
          <div class="mb-3">
            <input type="email" id="form" name="email" class="form-control border border-white text-white bg-transparent" placeholder="Your Email" required>
          </div>
          <div class="mb-3">
            <input type="text" id="form" name="phone" class="form-control border border-white text-white bg-transparent" placeholder="Your Phone" required>
          </div>
          <div class="mb-3">
            <input type="text" id="form" name="subject" class="form-control border border-white text-white bg-transparent" placeholder="Subject" required>
          </div>
          <div class="mb-3">
            <textarea name="message"  id="form" class="form-control border border-white text-white bg-transparent" rows="4" placeholder="Your Message" required></textarea>
          </div>
          <button type="submit" style="background-color: rgb(0, 204, 255); color: white;" class="btn btn-light px-4 py-2">Send Message</button>
        </form>
      </div>

      <!-- Middle: Contact Info Icons -->
      <div class="col-lg-2 d-flex flex-column align-items-center justify-content-center gap-4 pt-4" style="margin-bottom: 10px;">
        <!-- Address -->
        <div class="text-center ">
          <div class="rounded-circle bg-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:60px; height:60px;">
            <i class="fas fa-map-marker-alt" style="color: #00ccff; font-size: 24px;"></i>
          </div>
          <p class="text-white fw-bold mb-0">123 Main Street</p>
          <p class="text-white fw-bold" >Karachi, Pakistan</p>
        </div>
        <!-- Phone -->
        <div class="text-center">
          <div class="rounded-circle bg-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:60px; height:60px;">
            <i class="fas fa-phone-alt" style="color: #00ccff; font-size: 24px;"></i>
          </div>
          <p class="text-white fw-bold mb-0">+92 300 1234567</p>
        </div>
        <!-- Email -->
        <div class="text-center">
          <div class="rounded-circle bg-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:60px; height:60px;">
            <i class="fas fa-envelope" style="color: #00ccff; font-size: 22px;"></i>
          </div>
          <p class="text-white fw-bold mb-0">info@vaccino.com</p>
        </div>
      </div>

      <!-- Right: Map + Social Icons -->
      <div class="col-lg-5 d-flex flex-column">
        <!-- Social Icons -->
        <!-- <div class="d-flex justify-content-end gap-2 mb-3">
          <a href="#" class="d-flex align-items-center justify-content-center rounded-circle bg-white" style="width:40px; height:40px;">
            <i class="fab fa-facebook-f text-black"></i>
          </a>
          <a href="#" class="d-flex align-items-center justify-content-center rounded-circle bg-white" style="width:40px; height:40px;">
            <i class="fab fa-twitter text-black"></i>
          </a>
          <a href="#" class="d-flex align-items-center justify-content-center rounded-circle bg-white" style="width:40px; height:40px;">
            <i class="fab fa-instagram text-black"></i>
          </a>
          <a href="#" class="d-flex align-items-center justify-content-center rounded-circle bg-white" style="width:40px; height:40px;">
            <i class="fab fa-linkedin-in text-black"></i>
          </a>
        </div> -->

        <!-- Google Map (full height) -->
        <div class="flex-grow-1 shadow-lg rounded overflow-hidden" style="min-height: 460px;">
          <iframe src="https://maps.google.com/maps?q=karachi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                  width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen></iframe>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- Contact Section End -->
 <?php include 'footer.php'; ?>