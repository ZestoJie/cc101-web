<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 3) {
    $_SESSION['error'] = "Access denied.";
    header("Location: home.php");
    exit;
}

$students = $conn->query("SELECT * FROM users WHERE role_id = 2");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Grades</title>
<style>
    body { font-family:Poppins; background: #ffffffff; padding:20px; }
    table { width:80%; margin:auto; border-collapse:collapse; }
    th, td { border:1px solid #800e24ff; padding:12px; }
    th { background: #ddd; }
    .btn {
        padding:8px 12px; border-radius:5px; text-decoration:none; color:white;
        background: #781a1aff;
    }
    h2 {
        text-align:center;
        margin-bottom:20px;
        background-color: #781a1aff;
        border-radius: 8px;
        color: white;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
</head>
<body>

<h2>Manage Student Grades</h2>

<table>
<tr>
    <th>Student Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php while($s = $students->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($s['fullname']) ?></td>
    <td><?= htmlspecialchars($s['email']) ?></td>
    <td>
        <a class="btn" href="edit_grades.php?id=<?= $s['id'] ?>">View / Edit Grades</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<div style="text-align:center; margin-top:20px;">
    <a class="btn" href="faculty_dashboard.php">Back</a>
</div>

</body>
</html>
