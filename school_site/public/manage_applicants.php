<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 4) {
    $_SESSION['error'] = 'Access denied.';
    header('Location: admin_dashboard.php');
    exit;
}

$applicants = $conn->query("SELECT * FROM users WHERE role_id = 1");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Applicants</title>
<style>
    body {
        font-family: Poppins, sans-serif;
        background: #f4f6fb;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1100px;
        margin: auto;
        padding: 30px;
    }

    h2 {
        margin-bottom: 20px;
        font-weight: 700;
        color: #781a22ff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    th {
        background: #781a22ff;
        color: white;
        padding: 14px;
        text-align: left;
        font-size: 15px;
    }

    td {
        padding: 14px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    tr:hover {
        background: #f3f6ff;
        transition: 0.2s;
    }

    .btn {
        padding: 7px 14px;
        border-radius: 6px;
        color: white;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: 0.2s;
    }

    .pass {
        background: #2eaf45;
    }

    .pass:hover {
        background: #249838;
    }

    .fail {
        background: #d43b3b;
    }

    .fail:hover {
        background: #b62f2f;
    }

    .back-link {
        margin-top: 20px;
        display: inline-block;
        background: #781a22ff;
        padding: 10px 16px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        font-weight: 600;
    }

    .back-link:hover {
        background: #781a22ff
    }

    @media(max-width: 700px) {
        table, tr, td, th { font-size: 12px; }
        .btn { padding: 5px 10px; }
    }
</style>
</head>
<body>

<div class="container">
    <h2>Applicant Management</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th style="width:180px;">Action</th>
        </tr>

        <?php while($row = $applicants->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['fullname']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <?= $row['passed'] ? "<span style='color:#2eaf45;font-weight:bold;'>Passed</span>" : "<span style='color:#b62f2f;font-weight:bold;'>Not Passed</span>" ?>
            </td>
            <td>
                <a class="btn pass" href="set_result.php?id=<?= $row['id'] ?>&pass=1">Pass</a>
                <a class="btn fail" href="set_result.php?id=<?= $row['id'] ?>&pass=0">Fail</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="admin_dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>
