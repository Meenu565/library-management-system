<?php
include 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication_year = $_POST['publication_year'];
    $branch = $_POST['branch'];


    $stmt = $conn->prepare("INSERT INTO books (id, title, author, publication_year, branch) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id, $title, $author, $publication_year, $branch);

    
    if ($stmt->execute()) {
        $message = "New book added successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
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
            background-image: url('addbook.jpg');
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
            <h2>Add Book</h2>
            <?php if ($message): ?>
                <div class="<?php echo strpos($message, 'Error') === false ? 'message' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="add_book.php">
                <div class="input-group">
                    <label for="id">Book ID</label>
                    <input type="number" id="id" name="id" required>
                </div>
                <div class="input-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="input-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required>
                </div>
                <div class="input-group">
                    <label for="publication_year">Publication Year:</label>
                    <input type="number" id="publication_year" name="publication_year" required>
                </div>
                <div class="input-group">
                    <label for="branch">Branch:</label>
                    <input type="text" id="branch" name="branch" required>
                </div>
                <button type="submit" class="btn-primary">Add Book</button>
            </form>
            <a href="dashboard_admin.php" class="back-link">Back to Dashboard</a>
        </div>
       
    </div>
</body>
</html>
