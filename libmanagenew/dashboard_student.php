<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
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
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #E6E6FA; 
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('img2.jpeg'); 
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(5px); 
        }

        .container {
            position: relative;
            z-index: 1;
            width: 80%;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
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
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .card a:hover {
            background-color: #555;
        }

        .reports {
            display: flex;
            justify-content: center;
        }

        .reports .card {
            flex: 1;
            max-width: 300px;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="header">
            <h1>LIBRARY MANAGEMENT</h1>
            <p>Manage your library efficiently</p>
        </div>
        <div class="row">
            <div class="card">
                <img src="myaccount.png" alt="My Account">
                <a href="my_account.php">My Account</a>
            </div>
            <div class="card">
                <img src="searchbook.jpg" alt="Search Book">
                <a href="search_book.php">Search Book</a>
            </div>
            <div class="card">
                <img src="changepassword.jpg" alt="Change Password">
                <a href="change_password.php">Change Password</a>
            </div>
            <div class="card">
                <img src="issuebook.jpg" alt="Issue Book Report">
                <a href="issue_book_report.php">Issue Book Report</a>
            </div>
            <div class="card">
                <img src="panality.webp" alt="Penalty Report">
                <a href="penalty_report.php">Penalty Report</a>
            </div>
            <div class="card">
                <img src="logout.jpg" alt="Logout">
                <a href="logout.php">Logout</a>
            </div>
            <div class="info-box">
            <h2>Information</h2>
            <p>Dear Students, please ensure that all borrowed books are returned by the due date to avoid penalties. For any assistance, contact the library staff.</p>
        </div>
        </div>
    </div>
</body>
</html>
