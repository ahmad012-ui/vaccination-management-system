<?php
$conn = mysqli_connect("localhost", "root", "", "e_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parent_id = $_POST['parent_id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO children (parent_id, name, dob, gender, created_at)
            VALUES ('$parent_id', '$name', '$dob', '$gender', '$created_at')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Child added successfully!'); window.location.href='add_child.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Child</title>
</head>
<body>
    <h2>Add Child</h2>
    <form method="POST">
        <label>Parent ID:</label>
        <input type="number" name="parent_id" required><br><br>

        <label>Child Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Date of Birth:</label>
        <input type="date" name="dob" required><br><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <button type="submit">Add Child</button>
    </form>
</body>
</html>