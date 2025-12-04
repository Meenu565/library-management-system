<?php
$servername = "localhost";
$username = "root"; 
$password = "Sow@2005#18"; 
$dbname = "library_management";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$update_due_date_sql = "UPDATE issues
                        SET due_date = DATE_ADD(issue_date, INTERVAL 15 DAY)
                        WHERE due_date IS NULL";

if ($conn->query($update_due_date_sql) === TRUE) {
    
} else {
    echo "Error updating due dates: " . $conn->error;
}


$update_penalties_sql = "UPDATE issues
                         SET penalty_amount = CASE
                             WHEN return_date > due_date THEN DATEDIFF(return_date, due_date) * 5
                             ELSE 0
                         END";

if ($conn->query($update_penalties_sql) === TRUE) {
    
} else {
    echo "Error updating penalties: " . $conn->error;
}


$fetch_report_sql = "SELECT i.id AS transaction_id, b.title, s.name AS student_name, i.issue_date, i.due_date, i.return_date, 
                            CASE
                                WHEN i.return_date <= i.due_date THEN 'No Penalty'
                                ELSE CONCAT('Rs ', i.penalty_amount)
                            END AS penalty_amount
                     FROM issues i
                     JOIN books b ON i.book_id = b.id
                     JOIN students s ON i.student_id = s.id
                     WHERE i.return_date IS NOT NULL";

$result = $conn->query($fetch_report_sql);

$penalty_report = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $penalty_report[] = $row;
    }
} else {
    echo "No data found";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Penalty Report</title>
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
            color: #333333; 
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            padding: 20px;
            margin-top: 20px;
        }

        h1 {
            font-family: monospace;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333333; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #333333; 
        }

        th {
            background-color: #8A2BE2; 
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            background-color: #ffffff; /* White background for table cells */
            color: #333333; /* Text color for table cells */
            padding: 10px;
            text-align: left;
        }

        p {
            text-align: center;
            color: #333333; /* Paragraph text color */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #333333; /* Link text color */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Penalty Report</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Transaction ID</th>
                    <th>Book Title</th>
                    <th>Student Name</th>
                    <th>Issue Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Penalty Amount</th>
                </tr>
                <?php foreach($penalty_report as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['penalty_amount']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No penalty data found.</p>
        <?php endif; ?>
        <a href="dashboard_admin.php">Back to Dashboard</a>
    </div>
</body>
</html>
