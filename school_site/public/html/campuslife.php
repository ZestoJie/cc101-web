<?php
session_start();
$user = $_SESSION['user'] ?? null;
$isLoggedIn = isset($_SESSION['user']);
$role = $isLoggedIn ? (int)$_SESSION['user']['role_id'] : null;

$dashboardLink = '../home.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Reuirements</title>
    <link rel="stylesheet" href="../styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <body>
    <style> 
    .campus-life {
        background: linear-gradient(rgba(255,255,255,0.75), rgba(255,255,255,0.75)),
        url('../img/campus-bg.jpg') no-repeat center/cover;
        text-align: center;
    }

    .campus-title {
        font-family: 'Oswald', sans-serif;
        font-size: 36px;
        color: #6a001f;
        letter-spacing: 2px;
        margin-bottom: 50px;
    }
.campus-cards {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
}

.campus-card {
    width: 260px;
    background-color: #e8d7c3;
    padding: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.campus-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 18px 35px rgba(0,0,0,0.25);
}

.campus-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.4s ease;
}

.campus-card:hover img {
    transform: scale(1.08);
}

.campus-card h3 {
    margin-top: 15px;
    font-family: 'Oswald', sans-serif;
    font-size: 20px;
    color: #6a001f;
    text-align: center;
    transition: color 0.3s ease;
}

.campus-card:hover h3 {
    color: #a3002b;
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
                    <a href="academics.php">Academic Programs</a>
                    <ul class="sub-menu">
                        <li><a href="computer.php">College of Computer Studies</a></li>
                        <li><a href="educ.php">College of Education</a></li>
                        <li><a href="engineering.php">College of Engineering</a></li>
                        <li><a href="finance.php">College of Finance</a></li>
                    </ul>
                </li>

                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="../ht/admissions.php" class="tc-menu-inner">Admissions</a>
                    <ul class="sub-menu">
                        <li><a href="applicant_req.php">Application Requirements</a></li>
                        <li><a href="../ht/scholarship.php">Tuition and Financial Aid / Scholarships</a></li>
                        <li><a href="../register.php">Online Application</a></li>
                    </ul>
                </li>
                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="../ht/aboutus.php" class="tc-menu-inner">About Us</a>
                    <ul class="sub-menu">
                        <li><a href="../ht/mission.php">Mission & Vision</a></li>
                        <li><a href="../ht/history.php">History</a></li>
                        <li><a href="../ht/administration.php">Governance</a></li>
                        <li><a href="../ht/contact.php">Contact Us</a></li>
                        <li><a href="../ht/faculty.php">Faculty Directory</a></li>
                        <li><a href="../ht/privacy.php">Privacy Policy</a></li>
                    </ul>
                </li>   
                <li class="menu-item tc-menu-item menu-item-has-children current-menu-item">
                    <a href="campuslife.php" class="tc-menu-inner">Campus Life</a>
                    <ul class="sub-menu">
                        <li><a href="organizations.php">Organizations</a></li>
                        <li><a href="sports.php">Sports & Athletics</a></li>
                        <li><a href="news.php">News</a></li>
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
<section class="campus-life">
    <div id="main-content">
        <div class="page-header-banner">
           <img src="../img/image.png" class="main-content-image">
            <div class="banner-overlay">
                    <h1>CAMPUS LIFE</h1>
                    <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • CAMPUS LIFE
                    </div>
                </div>
            </div>
                </div>
    <div class="campus-cards">

        <a class="campus-card" href = "sports.php">
            <img src="../img/sports.jpg" alt="Sports">
            <h3>SPORTS<br>& ATHLETICS</h3>
        </a>

        <a class="campus-card" href = "organizations.php">
            <img src="../img/organizations.jpg" alt="Organizations">
            <h3>CAMPUS<br>ORGANIZATIONS</h3>
        </a>

        <a class="campus-card" href = "news.php">
            <img src="../img/news.jpg" alt="News">
            <h3>NEWS<br>& EVENTS</h3>
        </a>

    </div>
    
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
                        <a href="../ht/contact.php">Contact us</a> | 
                        <a href="../ht/privacy.php">Privacy</a> | 
                        <a href="../ht/privacy.php">Terms</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="copyright-content">
                            <p class="text-copyright">Copyright © 2025. All Rights Reserved Meridian Scholars University.</p>
                        </div>
                    </div>
                </div>
    </footer>

</section>

    </body>
</html>