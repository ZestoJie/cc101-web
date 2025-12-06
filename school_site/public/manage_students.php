<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 4) {
    $_SESSION['error'] = "Access denied.";
    header("Location: ../index.php");
    exit;
}

$stmt = $conn->query("SELECT id, student_id, fullname, email FROM users WHERE role_id = 2 ORDER BY fullname ASC");
$students = $stmt->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Student Management</title>
    <style>
        /* Root variables */
        :root {
            --primary-maroon: #800000;
            --secondary-gray: #f5f5f5;
            --btn-primary: #800000;
            --btn-primary-hover: #a00000;
            --btn-secondary: #555;
            --btn-secondary-hover: #333;
            --text-color: #333;
            --header-bg: #f8f8f8;
            --card-bg: #fff;
            --card-shadow: rgba(0,0,0,0.1);
        }

        /* Reset some default styles */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background-color: var(--secondary-gray);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Header styling */
        .site-header {
            background-color: var(--header-bg);
            padding: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .header-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--primary-maroon);
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-primary {
            background-color: var(--btn-primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--btn-primary-hover);
        }

        .btn-secondary {
            background-color: var(--btn-secondary);
            color: white;
        }

        .btn-secondary:hover {
            background-color: var(--btn-secondary-hover);
        }

        /* Main container */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Card for table */
        .card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px var(--card-shadow);
            overflow-x: auto;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        th {
            text-align: left;
        }

        thead th {
            background-color: var(--primary-maroon);
            color: white;
            padding: 12px 10px;
        }

        tbody td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="container header-container">
        <div class="logo-text">
            <h1>Student Accounts</h1>
        </div>
        <div>
            <a href="admin_dashboard.php" class="btn btn-primary">Back</a>
        </div>
    </div>
</header>

<main class="container fade-in">

    <div class="card">
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="background: var(--primary-maroon); color: white;">
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">Student ID</th>
                    <th style="padding:12px;">Name</th>
                    <th style="padding:12px;">Email</th>
                    <th style="padding:12px;">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($students as $s): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding:10px;"><?= $s['id'] ?></td>
                    <td style="padding:10px;"><?= $s['student_id'] ?? 'N/A' ?></td>
                    <td style="padding:10px;"><?= htmlspecialchars($s['fullname']) ?></td>
                    <td style="padding:10px;"><?= htmlspecialchars($s['email']) ?></td>
                    <td style="padding:10px;">
                        <form action="delete_student.php" method="POST" onsubmit="return confirm('Delete this student?');">
                            <input type="hidden" name="id" value="<?= $s['id'] ?>">
                            <button class="btn btn-secondary" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</main>

</body>
</html>
