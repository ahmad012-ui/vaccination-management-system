<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Vaccino - E-Vaccination Booking System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<!-- Stylish Appointment Form using Terapia Theme Design -->
<div class="container-fluid appointment py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 mb-4">Book Vaccination Appointment</h1>
                <p class="mb-4">Fill the form below to request an appointment for your child's vaccination. Admin will review and approve the request.</p>
            </div>
            <div class="col-lg-6">
                <div class="appointment-form rounded p-5">
                    <form action="submit_request.php" method="POST">
                        <div class="row gy-3 gx-4">
                            <div class="col-12">
                                <label class="text-white mb-2">Select Your Child</label>
                                <select name="child_id" class="form-select py-3 border-primary bg-transparent text-white">
                                    <?php
                                    include 'db.php';
                                    $child_query = mysqli_query($conn, "SELECT * FROM children");
                                    while ($row = mysqli_fetch_assoc($child_query)) {
                                        echo '<option value="' . $row['child_id'] . '">' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="text-white mb-2">Select Hospital</label>
                                <select name="hospital_id" class="form-select py-3 border-primary bg-transparent text-white">
                                    <?php
                                    $hospital_query = mysqli_query($conn, "SELECT * FROM hospitals WHERE status = 'active'");
                                    while ($row = mysqli_fetch_assoc($hospital_query)) {
                                        echo '<option value="' . $row['hospital_id'] . '">' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="text-white mb-2">Select Vaccine</label>
                                <select name="vaccine_id" class="form-select py-3 border-primary bg-transparent text-white">
                                    <?php
                                    $vaccine_query = mysqli_query($conn, "SELECT * FROM vaccine WHERE is_available = 1");
                                    while ($row = mysqli_fetch_assoc($vaccine_query)) {
                                        echo '<option value="' . $row['vaccine_id'] . '">' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="text-white mb-2">Preferred Date</label>
                                <input type="date" name="preferred_date" class="form-control py-3 border-primary bg-transparent text-white" required>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary text-white w-100 py-3">Submit Appointment Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- submit_request.php -->
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $child_id = $_POST['child_id'];
    $hospital_id = $_POST['hospital_id'];
    $vaccine_id = $_POST['vaccine_id'];
    $preferred_date = $_POST['preferred_date'];

    $sql = "INSERT INTO appointment_requests (child_id, hospital_id, vaccine_id, preferred_date, status) VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $child_id, $hospital_id, $vaccine_id, $preferred_date);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment request submitted successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid Request'); window.history.back();</script>";
}
?>
</body>
</html>