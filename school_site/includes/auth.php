<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config.php';

if (empty($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Please login to continue.';
    header('Location: ../index.php');
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, student_id, fullname, email, role_id FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();

if (!$res || $res->num_rows !== 1) {
    session_unset();
    session_destroy();
    header('Location: ../home.php');
    exit;
}

$user = $res->fetch_assoc();
$_SESSION['user'] = [
    'id' => $user['id'],
    'student_id' => $user['student_id'],
    'fullname' => $user['fullname'],
    'email' => $user['email'],
    'role_id' => $user['role_id']
];