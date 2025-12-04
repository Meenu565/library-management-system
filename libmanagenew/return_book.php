<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $issue_id = $_POST['issue_id'];
    $return_date = $_POST['return_date'];

    $stmt = $conn->prepare("UPDATE issues SET return_date = ? WHERE id = ?");
    $stmt->bind_param("si", $return_date, $issue_id);

    if ($stmt->execute()) {
        $message= "Book returned successfully";
    } else {
        $message= "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book</title>
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
            background-image: url('returnbook.jpg');
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

        .message {
            font-size: 18px;
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            font-size: 18px;
            color: red;
            text-align: center;
            margin-bottom: 20px;
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
            <h2>Return Book</h2>
            <?php if (isset($message)): ?>
                <div class="<?php echo strpos($message, 'Error') === false ? 'message' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="input-group">
                    <label for="issue_id">Issue ID:</label>
                    <input type="number" id="issue_id" name="issue_id" required>
                </div>
                <div class="input-group">
                    <label for="return_date">Return Date:</label>
                    <input type="date" id="return_date" name="return_date" required>
                </div>
                <button type="submit" class="btn-primary">Return Book</button>
            </form>
            <a href="dashboard_admin.php" class="back-link">Back to Dashboard</a>
        </div>

    </div>
</body>
</html>
