<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php'); 
    exit();
}

$student_id = $_SESSION['user_id'];


$query = "SELECT books.title, books.author, issues.issue_date, issues.return_date 
          FROM issues 
          JOIN books ON issues.book_id = books.id 
          WHERE issues.student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$issued_books = [];
while ($row = $result->fetch_assoc()) {
    $issued_books[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Issued and Returned Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E6E6FA; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
        }

        .container {
            max-width: 800px;
            width: 100%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
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
            background-color: #ffffff;
            color: #333333;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Issued and Returned Books</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($issued_books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['issue_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['return_date'] ? $book['return_date'] : 'Not returned'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard_student.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
