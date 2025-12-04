<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "Sow@2005#18";
$dbname = "library_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    
    if (empty($user) || empty($pass)) {
        header("Location: login.html?error=Please fill in all fields");
        exit();
    }

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();

    if ($user_data && password_verify($pass, $user_data['password'])) {
        
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['role'] = $user_data['role'];
        $_SESSION['user_id'] = $user_data['id']; 

        
        if ($user_data['role'] == 'admin') {
            header("Location: dashboard_admin.php");
            exit();
        } else if ($user_data['role'] == 'student') {
            header("Location: dashboard_student.php");
            exit();
        }
    } else {
        header("Location: index.html?error=Invalid username or password");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
