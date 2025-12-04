<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $issue_date = date('Y-m-d');

    
    $stmt = $conn->prepare("INSERT INTO issues (book_id, student_id, issue_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $book_id, $student_id, $issue_date);

    $update_sql = "UPDATE books SET is_issued = TRUE WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $book_id);

    
    if ($stmt->execute() && $update_stmt->execute()) {
        $message = "Book issued successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $update_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Issue Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img2.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .container {
            display: flex;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            z-index: 1;
            position: relative;
        }

        .left {
            background: linear-gradient(to right, rgba(106, 17, 203, 0.7), rgba(37, 117, 252, 0.7));
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 50%;
            color: white;
            text-align: center;
        }

        .left h2 {
            font-family: monospace;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .left .logo {
            width: 100px;
            height: 100px;
            background-image: url('issuebook.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .right {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 50%;
            color: #333333;
        }

        .right h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            font-size: 18px;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Library Management</h2>
            <div class="logo"></div>
        </div>
        <div class="right">
            <h2>Issue Book</h2>
            <form method="post" action="">
                <div class="input-group">
                    <label for="book_id">Book ID:</label>
                    <input type="number" id="book_id" name="book_id" required>
                </div>
                <div class="input-group">
                    <label for="student_id">Student ID:</label>
                    <input type="number" id="student_id" name="student_id" required>
                </div>
                <button type="submit" class="btn-primary">Issue Book</button>
            </form>
            <?php
            if (isset($message)) {
                echo "<div class='message'>$message</div>";
            }
            ?>
             <a href="dashboard_admin.php" class="back-link">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
