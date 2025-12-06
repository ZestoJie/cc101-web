<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'user_db';
$mysqli_options = [
    MYSQLI_OPT_INT_AND_FLOAT_NATIVE => 1
];

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_errno) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
