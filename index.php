<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM Students");

    if ($stmt->execute()) {
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($students) > 0) {
            echo "<table>";
            // Table header
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Last Name</th>";
            echo "<th>First Name</th>";
            echo "<th>Program ID</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Email</th>";
            echo "<th>Payment Status</th>";
            echo "</tr>";
            
            // Table data
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($student['student_id']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_lastname']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_firstname']) . "</td>";
                echo "<td>" . htmlspecialchars($student['program_id']) . "</td>";
                echo "<td>" . htmlspecialchars($student['date_of_birth']) . "</td>";
                echo "<td>" . htmlspecialchars($student['email']) . "</td>";
                echo "<td>" . ($student['is_fully_paid'] ? 'Paid' : 'Unpaid') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No students found in the database.</p>";
        }
    } else {
        echo "<p>Error executing the query.</p>";
    }
    ?>
</body>
</html>