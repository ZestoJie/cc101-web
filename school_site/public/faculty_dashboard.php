<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'] ?? null;
$isLoggedIn = (bool)$user;

$dashboardLink = 'home.php';
if ($isLoggedIn) {
    switch ((int)$user['role_id']) {
        case 1: $dashboardLink = 'applicant_dashboard.php'; break;
        case 2: $dashboardLink = 'student_dashboard.php'; break;
        case 3: $dashboardLink = 'faculty_dashboard.php'; break;
        case 4: $dashboardLink = 'admin_dashboard.php'; break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href = "styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .page-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,.1);
        }
        .info-box {
            padding: 20px;
            background: rgba(195, 76, 92, 1);
            border-left: 5px solid #e6092aff;
            margin-bottom: 30px;
        }
        a.button {
            display: inline-block;
            margin: 10px 15px 0 0;
            padding: 12px 20px;
            background: #970808ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        a.button:hover {
            background: #b30018ff;
        }
    </style>
</head>
<body>
<header class="site-header">
    <div class="container thim-nav-wrapper">
        <div class="row">
            <div class="navigation col-sm-12">
                <div class="tm-table">

                    <div class="width-logo table-cell sm-logo">
                        <a href="index.php">
                            <img src="img/logo.png" alt="Meridian Scholars University" style="max-height:65px;">
                        </a>
                        <div class="logo-text">
                            <h1>Meridian Scholars University</h1>
                            <span>Honing The Future Scholars</span>
                        </div>
                    </div>

                    <nav class="width-navigation table-cell table-right">
                        <ul class="nav navbar-nav menu-main-menu" style="display: flex; gap: 25px;">
                <?php if ($user): ?>
                    <li class="tc-menu-item">
                        <a href="<?= $dashboardLink ?>">Dashboard</a>
                    </li>
                    <li class="tc-menu-item">
                        <a href="logout.php" style="color:#ffdddd;">Logout</a>
                    </li>
                <?php endif; ?>
                            <li class="tc-menu-item">
                                <a href="index.php">Index Page</a>
                            </li>

                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</header>

<div class="page-container">

    <div class="info-box">
        <h2>Welcome, Prof. <?= htmlspecialchars($user['fullname']) ?></h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p>This is your faculty panel. Use the tools below to manage classes and records.</p>
    </div>

    <a href="manage_grades.php" class="button">Manage Grades</a>
    <a href="faculty_list.php" class="button">View Other Faculty</a>
    <a href="logout.php" class="button" style="background: #d21414ff;;;">Logout</a>

</div>

</body>
</html>
