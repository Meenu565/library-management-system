<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Issue and Return Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E6E6FA; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #FFFFFF; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #333333;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #8A2BE2; 
            color: white;
        }

        td {
            background-color: #FFFFFF;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Issue and Return Report</h2>
        <?php
        $issue_result = $conn->query("
            SELECT issues.id, students.name as student_name, books.title as book_title, issues.issue_date, issues.return_date
            FROM issues
            JOIN students ON issues.student_id = students.id
            JOIN books ON issues.book_id = books.id
        ");

        if ($issue_result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Issue ID</th><th>Student Name</th><th>Book Title</th><th>Issue Date</th><th>Return Date</th></tr>";
            while ($row = $issue_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['book_title'] . "</td>";
                echo "<td>" . $row['issue_date'] . "</td>";
                echo "<td>" . ($row['return_date'] ? $row['return_date'] : 'Not Returned') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No issues found.</p>";
        }
        $conn->close();
        ?>
        <a href="dashboard_admin.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
