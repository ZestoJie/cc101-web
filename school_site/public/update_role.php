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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $role_id = (int)$_POST['role_id'];

    if ($id === $user['id']) {
        $_SESSION['error'] = "You cannot modify your own role.";
        header("Location: manage_roles.php");
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET role_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $role_id, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User role updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update role.";
    }

    header("Location: manage_roles.php");
    exit;
}

header("Location: manage_roles.php");
exit;
