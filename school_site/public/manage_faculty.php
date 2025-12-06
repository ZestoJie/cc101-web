<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 4) {
    $_SESSION['error'] = "Access denied.";
    header("Location: student_dashboard.php");
    exit;
}
    
$result = $conn->query("SELECT id, fullname, email FROM users WHERE role_id = 3 ORDER BY fullname ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Faculty</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #eef;
            padding: 30px;
        }
        .container {
            width: 80%;
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
            background: #781a1a;
        }
        a.button {
            padding: 10px 15px;
            background: #781a22ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        .remove-btn {
            background: #c62828;
        }
        .remove-btn:hover {
            background: #e53935;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Faculty</h2>
    <p>View or remove faculty accounts.</p>

    <table>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <a class="button remove-btn" 
                       href="remove_faculty.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Are you sure you want to remove this faculty?');">
                        Remove
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="admin_dashboard.php" class="button">Back to Dashboard</a>
</div>

</body>
</html>
