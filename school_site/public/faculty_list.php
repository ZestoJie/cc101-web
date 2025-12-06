<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 3) {
    $_SESSION['error'] = "Access denied.";
    header("Location: student_dashboard.php");
    exit;
}

$result = $conn->query("SELECT fullname, email FROM users WHERE role_id = 3 ORDER BY fullname ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Faculty List</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        .container {
            width: 70%;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background: #e88c91ff;
        }
        a.button {
            display: inline-block;
            padding: 10px 15px;
            background: #760909ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        a.button:hover {
            background: #c85e5eff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Faculty Members</h2>
    <p>Below is the list of all faculty users.</p>

    <table>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="faculty_dashboard.php" class="button">Back to Dashboard</a>
</div>

</body>
</html>