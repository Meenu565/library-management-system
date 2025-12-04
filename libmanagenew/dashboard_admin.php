<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img2.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        .header p {
            font-size: 1.2em;
            color: #777;
            margin-top: 10px;
        }
        .row {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            flex: 1;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }
        .card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .card a:hover {
            color: white;
        }
        .reports {
            display: flex;
            justify-content: center;
        }
        .reports .card {
            flex: 1;
            max-width: 300px;
        }
        .info-box {
            margin-top: 20px;
            padding: 20px;
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Manage your library efficiently</p>
        </div>
        <div class="row">
            <div class="card">
                <img src="addbook.jpg" alt="Add Book">
                <a href="add_book.php">Add Book</a>
            </div>
            <div class="card">
                <img src="addstudent.jpg" alt="Add Student">
                <a href="add_student.php">Add Student</a>
            </div>
            <div class="card">
                <img src="issuebook.jpg" alt="Issue Book">
                <a href="issue_book.php">Issue Book</a>
            </div>
            <div class="card">
                <img src="return.jpg" alt="Return Book">
                <a href="return_book.php">Return Book</a>
            </div>
            <div class="card">
                <img src="panality.webp" alt="Penalty">
                <a href="penalty.php">Penalty</a>
            </div>
            <div class="card">
                <img src="remove_book.jpg" alt="Remove Book">
                <a href="remove_book.php">Remove Book</a>
            </div>
            <div class="card">
                <img src="remove.png" alt="Remove Member">
                <a href="remove_member.php">Remove Member</a>
            </div>
            <div class="card">
                <img src="viewmember.jpg" alt="View Member">
                <a href="view_member.php">View Member</a>
            </div>
            <div class="reports">
            <div class="card">
                <img src="bookstudent.jpg" alt="Book and Student Report">
                <a href="book_student_report.php">Book and Student Report</a>
            </div>
            <div class="card">
                <img src="issuereturn.jpg" alt="Issue and Return Report">
                <a href="issue_return_report.php">Issue and Return Report</a>
            </div>
            <div class="card">
                <img src="logout.jpg" alt="Logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        
    </div>
</body>
</html>
