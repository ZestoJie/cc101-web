<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

if ((int)$_SESSION['user']['role_id'] !== 4) {
    $_SESSION['error'] = "Access denied.";
    header("Location: admin_dashboard.php");
    exit;
}

if (!isset($_GET['set'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: admin_dashboard.php");
    exit;
}

$value = intval($_GET['set']);
if ($value !== 0 && $value !== 1) {
    $_SESSION['error'] = "Invalid value.";
    header("Location: admin_dashboard.php");
    exit;
}

$conn->query("UPDATE system_settings SET results_released = $value WHERE id = 1");

$_SESSION['success'] = $value ? "Results are now PUBLIC." : "Results are now HIDDEN.";
header("Location: admin_dashboard.php");
exit;
