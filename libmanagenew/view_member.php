<?php
session_start();
include 'config.php';


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}


$query = "SELECT id, name, course, year, email, branch FROM students";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #E6E6FA; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            padding: 20px;
        }

        h2 {
            font-family: monospace;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
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
            background-color: #8A2BE2; 
            color: white;
        }

        td {
            background-color: #ffffff;
            color: #333333;
        }

        p {
            text-align: center;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Members</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Email</th>
                    <th>Branch</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['branch']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No members found.</p>
        <?php endif; ?>
        <a href="dashboard_admin.php">Back to Dashboard</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
