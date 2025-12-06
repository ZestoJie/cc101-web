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

$id = intval($_GET['id']);
$grade = $conn->query("SELECT * FROM grades WHERE id = $id")->fetch_assoc();

if (!$grade) {
    $_SESSION['error'] = "Grade not found.";
    header("Location: manage_grades.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $value = $_POST['grade'];

    $stmt = $conn->prepare("UPDATE grades SET subject=?, grade=? WHERE id=?");
    $stmt->bind_param("ssi", $subject, $value, $id);
    $stmt->execute();

    header("Location: edit_grades.php?id=" . $grade['student_id']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Grade</title>
<style>
    body { font-family:Poppins; background:#f5f5f5; padding:20px; }
    .box { width:50%; margin:auto; background:white; padding:20px; border-radius:10px; }
    input { width:100%; padding:10px; margin-top:10px; }
    .btn { padding:10px 16px; background: #781a1aff; color:white; text-decoration:none; border-radius:8px; }
</style>
</head>
<body>

<div class="box">
<h2>Edit Grade</h2>

<form method="POST">
    <label>Subject</label>
    <input type="text" name="subject" value="<?= htmlspecialchars($grade['subject']) ?>" required>

    <label>Grade</label>
    <input type="number" name="grade" min="0" max="100" value="<?= $grade['grade'] ?>" required>

    <button class="btn" style="margin-top:15px;">Update</button>
</form>

<a class="btn" style="margin-top:10px; display:inline-block;"
   href="edit_grades.php?id=<?= $grade['student_id'] ?>">Back</a>

</div>

</body>
</html>
