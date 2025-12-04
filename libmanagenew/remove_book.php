<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];

    
    $delete_query = "DELETE FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $book_id);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Book removed successfully.";
    } else {
        $message = "Error removing book: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Book</title>
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
            background-color: rgba(255, 255, 255, 0.7);
            z-index: -1;
        }

        .container {
            display: flex;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            position: relative;
            z-index: 1;
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
            background-image: url('remove_book.jpg');
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
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .message.success {
            background-color: #4CAF50;
            color: white;
        }

        .message.error {
            background-color: #f44336;
            color: white;
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
            <h2>Remove Book</h2>
            <form action="remove_book.php" method="post">
                <div class="input-group">
                    <label for="book_id">Book ID:</label>
                    <input type="number" id="book_id" name="book_id" required>
                </div>
                <button type="submit" class="btn-primary">Remove Book</button>
            </form>
            <?php if (isset($message)) { 
                $message_class = strpos($message, 'Error') === false ? 'success' : 'error';
                echo "<div class='message $message_class'>$message</div>"; 
            } ?>
            <a href="dashboard_admin.php" class="back-link">Back to Dashboard</a>
        </div>
        
    </div>
</body>
</html>
