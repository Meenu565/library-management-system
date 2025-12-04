<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header('Location: login.html');
    exit();
}

$student_id = $_SESSION['user_id'];

$query = "SELECT name, course, year, branch, email FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img2.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .details {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .details li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
            color: #666;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .details li strong {
            color: #333;
            width: 30%;
            text-align: right;
            padding-right: 10px;
        }

        .details li span {
            width: 70%;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Account</h2>
        <?php if ($student): ?>
            <ul class="details">
                <li><strong>Name:</strong> <span><?php echo htmlspecialchars($student['name']); ?></span></li>
                <li><strong>Course:</strong> <span><?php echo htmlspecialchars($student['course']); ?></span></li>
                <li><strong>Year:</strong> <span><?php echo htmlspecialchars($student['year']); ?></span></li>
                <li><strong>Branch:</strong> <span><?php echo htmlspecialchars($student['branch']); ?></span></li>
                <li><strong>Email:</strong> <span><?php echo htmlspecialchars($student['email']); ?></span></li>
            </ul>
        <?php else: ?>
            <p>No student details found.</p>
        <?php endif; ?>
        <a href="dashboard_student.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
