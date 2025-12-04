<?php
session_start();
include 'config.php';


if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit();
}


$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $conn->real_escape_string($_POST['current_password']);
    $new_password = $conn->real_escape_string($_POST['new_password']);
    $username = $_SESSION['username'];

    
    $result = $conn->query("SELECT password FROM users WHERE username = '$username'");
    $user = $result->fetch_assoc();

    
    if (password_verify($current_password, $user['password'])) {
    
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        if ($conn->query("UPDATE users SET password = '$new_password_hashed' WHERE username = '$username'") === TRUE) {
            $message = "Password changed successfully.";
        } else {
            $message = "Error changing password: " . $conn->error;
        }
    } else {
        $message = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
            background-image: url("img2.jpeg"); 
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
        }

        .container {
            display: flex;
            background-color: transparent; 
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
            position: relative;
            text-align: center;
            z-index: 2; 
        }

        .left h2 {
            font-family: monospace;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .left .logo {
            width: 100px;
            height: 100px;
            background-image: url('changepassword.jpg');
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
            z-index: 2; 
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
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Library Management</h2>
            <div class="logo"></div>
        </div>
        <div class="right">
            <h2>Change Password</h2>
            <form method="post" action="change_password.php">
                <div class="input-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="input-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <button type="submit" class="btn-primary">Change Password</button>
            </form>
            <p><?php echo htmlspecialchars($message); ?></p>
            <a href="dashboard_student.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>





