<?php
$servername = "localhost";
$username = "root";
$password = "Sow@2005#18";
$dbname = "library_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
