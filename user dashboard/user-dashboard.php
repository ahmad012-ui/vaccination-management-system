<?php
session_start();
include 'db.php';

$user_id = 1; // Static for now; replace with $_SESSION['user_id'] later

// Profile update logic (excluding password update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : null;

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', created_at='$dob' WHERE user_id=$user_id");

    if ($gender !== null) {
        $child_q = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = $user_id LIMIT 1");
        if (mysqli_num_rows($child_q) > 0) {
            $child = mysqli_fetch_assoc($child_q);
            mysqli_query($conn, "UPDATE children SET gender='$gender' WHERE child_id = {$child['child_id']}");
        }
    }
}

// Fetch user info
$user_q = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($user_q);

$user['vaccine'] = 'N/A';
$user['next_appointment'] = 'N/A';
$user['center'] = 'N/A';

$child_q = mysqli_query($conn, "SELECT * FROM children WHERE parent_id = $user_id");
$user['children'] = [];
$user['doses'] = [];
$user['appointments'] = [];

while ($child = mysqli_fetch_assoc($child_q)) {
    $user['children'][] = $child;
    $child_id = $child['child_id'];

    $report_q = mysqli_query($conn, "
        SELECT 
            COALESCE(v.name, CONCAT('Vaccine ID: ', r.vaccine_id)) AS vaccine_name,
            r.date_given, r.status
        FROM vaccination_reports r
        LEFT JOIN vaccines v ON v.vaccine_id = r.vaccine_id
        WHERE r.child_id = $child_id
    ");
    while ($row = mysqli_fetch_assoc($report_q)) {
        $user['doses'][] = $row;
    }

    $appointment_q = mysqli_query($conn, "
        SELECT ar.*, h.name AS hospital_name, v.name AS vaccine_name
        FROM appointment_requests ar
        JOIN hospitals h ON ar.hospital_id = h.hospital_id
        JOIN vaccines v ON ar.vaccine_id = v.vaccine_id
        WHERE ar.child_id = $child_id
        ORDER BY ar.created_at DESC
    ");
    while ($a = mysqli_fetch_assoc($appointment_q)) {
        $user['appointments'][] = $a;

        if ($a['status'] === 'approved' && $user['next_appointment'] === 'N/A') {
            $user['vaccine'] = $a['vaccine_name'];
            $user['next_appointment'] = $a['preferred_date'];
            $user['center'] = $a['hospital_name'];
        }
    }
}

$child_gender = $user['children'][0]['gender'] ?? 'N/A';
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleForm() {
            const form = document.getElementById('editForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-light">
<div class="container py-4">

    <h2>👤 User Dashboard</h2>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Your Profile</span>
            <a href="user-edit-profile.php" class="btn btn-sm btn-primary">✏️ Edit Profile</a>
            <!-- <button class="btn btn-sm btn-primary" onclick="toggleForm()">✏️ Edit Profile</button> -->
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Vaccination Info</div>
        <div class="card-body">
            <p><strong>Vaccine:</strong> <?= htmlspecialchars($user['vaccine']) ?></p>
            <p><strong>Next Appointment:</strong> <?= $user['next_appointment'] ?> at <strong><?= $user['center'] ?></strong></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Vaccination History</div>
        <div class="card-body">
            <?php if (count($user['doses'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Vaccine</th><th>Date</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user['doses'] as $dose): ?>
                            <tr>
                                <td><?= htmlspecialchars($dose['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($dose['date_given']) ?></td>
                                <td><?= htmlspecialchars($dose['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No vaccination records found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">📅 Appointment Requests</div>
        <div class="card-body">
            <?php if (count($user['appointments'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vaccine</th>
                            <th>Hospital</th>
                            <th>Preferred Date</th>
                            <th>Status</th>
                            <th>Requested At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user['appointments'] as $a): ?>
                            <tr>
                                <td><?= htmlspecialchars($a['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($a['hospital_name']) ?></td>
                                <td><?= htmlspecialchars($a['preferred_date']) ?></td>
                                <td>
                                    <?php if ($a['status'] === 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php elseif ($a['status'] === 'approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif ($a['status'] === 'rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($a['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No appointment requests found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mb-4" id="editForm" style="display: none;">
        <div class="card-header">✏️ Edit Your Profile</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>
                <div class="mb-2">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="<?= date('Y-m-d', strtotime($user['created_at'])) ?>" required>
                </div>
                <div class="mb-2">
                    <label>Child Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="male" <?= strtolower($child_gender) === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= strtolower($child_gender) === 'female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="logout.php" class="btn btn-danger btn-sm">🚪 Logout</a>
    </div>
</div>
</body>
</html>
