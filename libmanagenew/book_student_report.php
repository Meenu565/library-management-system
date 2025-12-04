<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book and Student Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #4b0082, #8a2be2); 
            margin: 0;
            padding: 20px;
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: black;
            font-family: monospace;
            background-color: #fff;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: white;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 8px 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #7b68ee; 
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Report</h2>
        <?php
        $book_result = $conn->query("SELECT * FROM books");
        if ($book_result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Publication Year</th><th>Branch</th></tr>";
            while ($row = $book_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                echo "<td>" . htmlspecialchars($row['publication_year']) . "</td>";
                echo "<td>" . htmlspecialchars($row['branch']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No books found.";
        }
        ?>

        <h2>Student Report</h2>
        <?php
        $student_result = $conn->query("SELECT * FROM students");
        if ($student_result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Branch</th></tr>";
            while ($row = $student_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['branch']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No students found.";
        }
        $conn->close();
        ?>
        <a href="dashboard_admin.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
