<?php
session_start();
$user = $_SESSION['user'] ?? null;
$isLoggedIn = isset($_SESSION['user']);
$role = $isLoggedIn ? (int)$_SESSION['user']['role_id'] : null;

$dashboardLink = '../home.php';
if ($isLoggedIn) {
    switch ($role) {
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
    <title>Admissions</title>
    <link rel="stylesheet" href="../styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
<style>
    .admission-btn {
        transition: all 0.3s ease;
        border-radius: 5px;
    }
    .admission-btn:hover {
        transform: translateY(-8px);
        background: #C7B7A3 !important;
        box-shadow: 0 15px 25px rgba(0,0,0,0.20);
        cursor: pointer;
    }
</style>

<header class="site-header">
    <div class="container thim-nav-wrapper">
        <div class="row">
                <div class="navigation col-sm-12">
                    <div class="tm-table">
                        <div class="width-logo table-cell sm-logo">
                                <a href="../home.php">
                                <img src="../img/logo.png" alt="Meridian Scholars University">
                                </a>
                                    <div class="logo-text">
                                        <h1>Meridian Scholars University</h1>
                                        <span>Honing The Future Scholars</span>
                                    </div>
                        </div>
        <nav class="width-navigation table-cell table-right">
                <ul class="nav navbar-nav menu-main-menu">
                    <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="../html/academics.php">Academic Programs</a>
                    <ul class="sub-menu">
                        <li><a href="../html/computer.php">College of Computer Studies</a></li>
                        <li><a href="../html/educ.php">College of Education</a></li>
                        <li><a href="../html/engineering.php">College of Engineering</a></li>
                        <li><a href="../html/finance.php">College of Finance</a></li>
                    </ul>
                </li>

                <li class="menu-item tc-menu-item menu-item-has-children current-menu-item">
                    <a href="admissions.php" class="tc-menu-inner">Admissions</a>
                    <ul class="sub-menu">
                        <li><a href="../html/applicant_req.php">Application Requirements</a></li>
                        <li><a href="scholarship.php">Tuition and Financial Aid / Scholarships</a></li>
                        <li><a href="../register.php">Online Application</a></li>
                    </ul>
                </li>
                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="aboutus.php" class="tc-menu-inner">About Us</a>
                    <ul class="sub-menu">
                        <li><a href="mission.php">Mission & Vision</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="administration.php">Governance</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="faculty.php">Faculty Directory</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                    </ul>
                </li>   
                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="../html/campuslife.php" class="tc-menu-inner">Campus Life</a>
                    <ul class="sub-menu">
                        <li><a href="../html/organizations.php">Organizations</a></li>
                        <li><a href="../html/sports.php">Sports & Athletics</a></li>
                        <li><a href="../html/news.php">News</a></li>
                    </ul>
                </li>

                <?php if ($user): ?>
                    <li class="tc-menu-item">
                        <a href="<?= $dashboardLink ?>">Dashboard</a>
                    </li>
                    <li class="tc-menu-item">
                        <a href="../logout.php" style="color:#ffdddd;">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<div id="main-content">
        <div class="page-header-banner">
           <img src="../img/image.png" class="main-content-image">
            <div class="banner-overlay">
        <h1>ADMISSIONS</h1>
        <div class="breadcrumbs">
            <a href="../home.php">HOME</a> • ADMISSIONS
        </div>
    </div>
    </div>
</div>
</section>

<section class="container" style="padding: 40px 0;">
    <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">

        <a href="../html/applicant_req.php" class="admission-btn" style="text-align:center; width:260px; background:#E8D8C4; padding:20px; box-shadow:0 10px 20px rgba(0,0,0,0.15); display:block;">
            <h3 style="font-family:'Oswald'; color:#561C24; font-size:22px;">Application<br>Requirements</h3>
        </a>

        <a href="scholarship.php" class="admission-btn" style="text-align:center; width:260px; background:#E8D8C4; padding:20px; box-shadow:0 10px 20px rgba(0,0,0,0.15); display:block;">
            <h3 style="font-family:'Oswald'; color:#561C24; font-size:22px;">Tuition & Financial Aid<br>/ Scholarships</h3>
        </a>

        <a href="../register.php" class="admission-btn" style="text-align:center; width:260px; background:#E8D8C4; padding:20px; box-shadow:0 10px 20px rgba(0,0,0,0.15); display:block;">
            <h3 style="font-family:'Oswald'; color:#561C24; font-size:22px;">Online<br>Application</h3>
        </a>

    </div>
</section>

<footer id="colophon" class="site-footer has-footer-bottom">
    <div class="footer-bottom">
        <div class="container">
            <div class="textwidget">
                <div class="footer-branding">
                    <img class="footer-logo-img" src="../img/logo.png" alt="Meridian Logo"><br>
                    <h2>Meridian Scholars University</h2>
                    <span>Honing The Future Scholars</span>
                </div>

                <p style="color: #ccc; margin-top: 20px;">__________________<br><b>Connect with us</b></p>

                <div class="footer-social-icons">
                    <a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://youtube.com"><i class="fab fa-youtube"></i></a>
                </div>

                <p class="footer-links">
                    <a href="contact.php">Contact us</a> | 
                    <a href="privacy.php">Privacy</a> | 
                    <a href="terms.php">Terms</a>
                </p>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="copyright-content">
                <p class="text-copyright">Copyright © 2025. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
