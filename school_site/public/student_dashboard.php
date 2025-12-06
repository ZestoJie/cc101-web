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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Meridian Scholars University</title>
    <link rel="stylesheet" href = "styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<style>
    .menu, .menu-item, .sub-menu,
    .sub-menu li {
    list-style: none !important;
    }
.dashboard-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}
.dashboard-layout {
    display: flex;
    gap: 20px;
}
.dashboard-sidebar {
    width: 250px;
    background: #f9f9f9;
    border-radius: 10px;
    padding: 20px;
}
.dashboard-sidebar ul {
    list-style: none;
    padding: 0;
}
.dashboard-sidebar ul li {
    margin-bottom: 15px;
}
.dashboard-sidebar ul li a {
    text-decoration: none;
    color: #333;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}
.dashboard-sidebar ul li a.logout-sidebar {
    color: #a41024ff;
    font-weight: bold;
}
.dashboard-main {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}
.dashboard-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
}
.info-box {
    padding: 15px;
    background: #e79898ff;
    border-left: 5px solid #a41024ff;
    margin-bottom: 20px;
}
</style>
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

<div class="dashboard-container">

    <div class="info-box">
        <h2>Welcome, <?= htmlspecialchars($user['fullname'] ?? 'Student') ?> 👋</h2>
        <p><strong>Student ID:</strong> <?= htmlspecialchars($user['student_id'] ?? 'N/A') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? 'N/A') ?></p>
    </div>

    <div class="dashboard-layout">

        <aside class="dashboard-sidebar">
            <ul>
                <li><a href="view_grades.php"><i class="fa fa-chart-line"></i> View Grades</a></li>
                <li><a href="#"><i class="fa fa-book"></i> Learning Modules</a></li>
                <li><a href="#"><i class="fa fa-bullhorn"></i> Announcements</a></li>
                <li><a href="logout.php" class="logout-sidebar"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <section class="dashboard-main">
            <div class="dashboard-card">
                <h3>Student Overview</h3>
                <p>Your academic records and tools are available on the left.</p>
            </div>

            <div class="dashboard-card">
                <h3>Announcements</h3>
                <p>No new announcements.</p>
            </div>
        </section>

    </div>
</div>

<script>
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mainNav = document.querySelector('.main-navigation');
    mobileToggle.addEventListener('click', () => {
        mainNav.classList.toggle('active');
    });

    document
        .querySelectorAll('.menu-item.has-children > a')
        .forEach(item => {
            item.addEventListener('click', e => {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    const submenu = item.nextElementSibling;
                    submenu.classList.toggle('open');
                }
            });
        });
</script>

</body>
</html>
