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

if (!isset($_GET['id']) || !isset($_GET['pass'])) {
    $_SESSION['error'] = "Invalid parameters.";
    header("Location: manage_applicants.php");
    exit;
}

$id   = intval($_GET['id']);
$pass = intval($_GET['pass']);

if ($pass !== 0 && $pass !== 1) {
    $_SESSION['error'] = "Invalid pass value.";
    header("Location: manage_applicants.php");
    exit;
}

$stmt = $conn->prepare("UPDATE users SET passed = ? WHERE id = ?");
$stmt->bind_param("ii", $pass, $id);
$stmt->execute();
$stmt->close();

$statusText = $pass === 1 ? "PASSED" : "FAILED";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Applicant Status Updated</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f4f4ff;
            margin: 0;
            padding: 0;
        }
        .card {
            width: 50%;
            margin: 100px auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .status {
            font-size: 20px;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            display: inline-block;
            margin: 20px 0;
        }
        .passed {
            background: #c5ffba;
            color: #2e7d32;
        }
        .failed {
            background: #ffbaba;
            color: #9c1c1c;
        }
        a.button {
            display: inline-block;
            margin: 10px 10px 0 10px;
            padding: 12px 20px;
            background: #760909ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: .3s;
        }
        a.button:hover {
            background: #c84646ff;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Applicant Status Updated</h2>

    <div class="status <?= $pass === 1 ? 'passed' : 'failed' ?>">
        Applicant marked as: <?= $statusText ?>
    </div>  
    <br>

    <a href="manage_applicants.php" class="button">Manage Applicants</a>
    <a href="admin_dashboard.php" class="button">Back to Dashboard</a>
</div>

</body>
</html>