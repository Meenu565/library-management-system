<?php
include 'config.php';


$search_result = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_term = $conn->real_escape_string($_POST['search_term']);
    $search_result = $conn->query("SELECT * FROM books WHERE title LIKE '%$search_term%' OR author LIKE '%$search_term%'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Book</title>
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
            position: relative;
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
            background-image: url('searchbook.jpg'); /* Ensure the path is correct */
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #333333;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .back-link {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #333333;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-link:hover {
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
            <h2>Search Book</h2>
            <form method="post" action="search_book.php">
                <div class="input-group">
                    <label for="search_term">Enter book title or author:</label>
                    <input type="text" id="search_term" name="search_term" required>
                </div>
                <button type="submit" class="btn-primary">Search</button>
            </form>
            <h2>Search Results</h2>
            <?php
            if ($search_result && $search_result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Publication Year</th><th>Branch</th></tr>";
                while ($row = $search_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['publication_year'] . "</td>";
                    echo "<td>" . $row['branch'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No books found.";
            }
            ?>
            <a href="dashboard_student.php" class="back-link">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
