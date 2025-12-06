<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 3) {
    $_SESSION['error'] = 'Access denied.';
    header('Location: student_dashboard.php');
    exit;
}

$studentId = intval($_GET['id']);
$student = $conn->query("SELECT * FROM users WHERE id = $studentId")->fetch_assoc();
$grades = $conn->query("SELECT * FROM grades WHERE student_id = $studentId");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];

    $stmt = $conn->prepare("INSERT INTO grades (student_id, subject, grade)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE grade = VALUES(grade)");
    $stmt->bind_param("iss", $studentId, $subject, $grade);
    $stmt->execute();
    $stmt->close();

    header("Location: edit_grades.php?id=$studentId");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Grades</title>
<style>
    body { font-family:Poppins; background:#fefefe; padding:20px; }
    table { width:80%; margin:auto; border-collapse:collapse; }
    th, td { padding:12px; border:1px solid #ccc; }
    th { background:#ddd; }
    .btn { padding:6px 10px; color:white; text-decoration:none; border-radius:4px; }
    .btn-warning { background:#ff9800; }
    .btn-danger { background:#c62828; }
</style>
</head>
<body>

<h2 style="text-align:center">Editing Grades for <?= htmlspecialchars($student['fullname']) ?></h2>

<table>
<tr>
    <th>Subject</th>
    <th>Grade</th>
    <th>Action</th>
</tr>

<?php while($row = $grades->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['subject']) ?></td>
    <td><?= htmlspecialchars($row['grade']) ?></td>
    <td>
        <a href="edit_grade.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
        <a href="delete_grades.php?id=<?= $row['id'] ?>"
           class="btn btn-danger"
           onclick="return confirm('Delete this grade?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<form method="POST" style="width:50%; margin:30px auto;">
    <label>Subject</label>
    <input type="text" name="subject" required>

    <label>Grade</label>
    <input type="number" name="grade" min="0" max="100" required>

    <button class="btn" style="background: #781a1aff; margin-top:10px;">Save Grade</button>
</form>

<div style="text-align:center;">
    <a class="btn" style="background: #781a1aff;" href="manage_grades.php">Back</a>
</div>

</body>
</html>
