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
$sys = $conn->query("SELECT results_released FROM system_settings WHERE id = 1")->fetch_assoc();
$released = (int)$sys['results_released'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href = "styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
    .menu, .menu-item, .sub-menu,
    .sub-menu li {
    list-style: none !important;
    }

        .page-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,.1);
        }
        .welcome-box {
            padding: 20px;
            background: #ef8c8cff;
            border-left: 5px solid #e6092aff;
            margin-bottom: 30px;
        }
        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        a.button {
            display: inline-block;
            margin: 10px 15px 0 0;
            padding: 12px;
            background: #970808ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }
        a.button:hover {
            background: #b30018ff;
        }
        .card.shadow {
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
            padding: 20px;
            margin-bottom: 30px;
            align-items: center;
            text-align: center;
        }
        .button-grid{
            margin-bottom: 40px;
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


<main class="container">
    
    <div class="welcome-box">
        <h2>Welcome, <?= htmlspecialchars($user['fullname']) ?></h2>
        <p>Use the tools below to manage the system.</p>
    </div>

    <div class="card shadow">
        <h3>Entrance Exam Results</h3>
        <p>Status: 
            <strong><?= $released ? "VISIBLE to applicants" : "HIDDEN from applicants" ?></strong>
        </p>
        <?php if ($released): ?>
            <a href="toggle_results.php?set=0" class="button danger">Hide Results</a>
        <?php else: ?>
            <a href="toggle_results.php?set=1" class="button success">Release Results</a>
        <?php endif; ?>
    </div>

    <div class="button-grid">
        <a href="manage_applicants.php" class="button">Manage Applicants</a>
        <a href="manage_faculty.php" class="button">Manage Faculty</a>
        <a href="manage_students.php" class="button">Manage Students</a>
        <a href="manage_roles.php" class="button">Manage Roles</a>
        <a href="logout.php" class="button warning">Logout</a>
    </div>

</main>

</body>
</html>