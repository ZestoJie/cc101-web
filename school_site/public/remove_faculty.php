<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

if ((int)$user['role_id'] !== 4) {
    $_SESSION['error'] = "Access denied.";
    header("Location: admin_dashboard.php");
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "No faculty selected.";
    header("Location: manage_faculty.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role_id = 3");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$_SESSION['success'] = "Faculty removed successfully.";
header("Location: manage_faculty.php");
exit;
