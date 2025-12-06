<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 2) {
    $_SESSION['error'] = 'Access denied.';
    header('Location: student_dashboard.php');
    exit;
}

$studentId = $user['id'];
$result = $conn->query("SELECT * FROM grades WHERE student_id = $studentId");
?>
<!DOCTYPE html>
<html>
<head>
<title>My Grades</title>
<style>
    body { font-family:Poppins; background:#f4f4f4; padding:20px; }
    table { width:70%; margin:auto; border-collapse:collapse; }
    th, td { padding:12px; border:1px solid #ccc; }
    th { background: #ef8c8cff; }
</style>
</head>
<body>

<h2 style="text-align:center">My Grades</h2>

<table>
<tr><th>Subject</th><th>Grade</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['subject']) ?></td>
    <td><?= $row['grade'] !== null ? $row['grade'] : "Not Yet Graded" ?></td>
</tr>
<?php endwhile; ?>
</table>

<div style="text-align:center; margin-top:20px;">
    <a class="btn" style="background:#760909ff;; color:white; padding:10px 14px; border-radius:6px;"
       href="student_dashboard.php">Back</a>
</div>

</body>
</html>
