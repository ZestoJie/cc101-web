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
$conn->query("DELETE FROM grades WHERE id = $id");

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
