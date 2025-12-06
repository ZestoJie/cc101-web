<?php
session_start();
include "../includes/db.php";
include "../includes/auth.php";

$user = $_SESSION['user'];
$id = $user['id'];

function generateStudentID($conn) {
    $count = 1;
    do {
        $student_id = rand(10, 99) . '-' . rand(1000, 9999);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

    } while ($count > 0);

    return $student_id;
}

$student_id = generateStudentID($conn);

$stmt = $conn->prepare("UPDATE users SET student_id = ?, role_id = 2 WHERE id = ?");
$stmt->bind_param("si", $student_id, $id);
$stmt->execute();
$stmt->close();

$_SESSION['user']['student_id'] = $student_id;
$_SESSION['user']['role_id'] = 2;

header("Location: student_dashboard.php");
exit;
