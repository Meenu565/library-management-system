<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];

    if ($role == 'student') {
        $name = $_POST['name'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $branch = $_POST['branch'];
        $email = $_POST['email'];

        $conn->begin_transaction();

        try {
            $sql_student = "INSERT INTO students (name, course, year, branch, email) VALUES (?, ?, ?, ?, ?)";
            $stmt_student = $conn->prepare($sql_student);
            $stmt_student->bind_param("sssss", $name, $course, $year, $branch, $email);
            $stmt_student->execute();

            $student_id = $stmt_student->insert_id; // Get the inserted student ID
            
            $sql_user = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param("sss", $username, $password, $role);
            $stmt_user->execute();

            $conn->commit();
            
            header("Location: index.html");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

        $stmt_student->close();
        $stmt_user->close();
    } else {
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $role);

        if ($stmt->execute()) {
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
