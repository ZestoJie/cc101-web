<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 4) {
    $_SESSION['error'] = "Unauthorized access.";
    header("Location: manage_students.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role_id = 2");
    $stmt->execute([$id]);

    $_SESSION['success'] = "Student deleted successfully.";
}

header("Location: manage_students.php");
exit;
