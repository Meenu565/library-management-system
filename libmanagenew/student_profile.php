<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "Sow@2005#18";
$dbname = "library_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT username, reg_no, department FROM students WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$student_data = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Student Profile</h1>
        <p>Name: <?php echo htmlspecialchars($student_data['username']); ?></p>
        <p>Registration Number: <?php echo htmlspecialchars($student_data['reg_no']); ?></p>
        <p>Department: <?php echo htmlspecialchars($student_data['department']); ?></p>
        <a href="dashboard_student.php">Back to Dashboard</a>
    </div>
</body>
</html>
