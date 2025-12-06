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
</head>
<style>
    .menu, .menu-item, .sub-menu,
    .sub-menu li {
    list-style: none !important;
    }
    .container{
    }
    .content-container {
        background-image: url("../img/logo.png"); 
        font-size: 17px;
        background: linear-gradient(to right, #830d0dff, #ff9898ff);
        color: white;
        border-radius: 20px;
        max-width: 1000px;
        margin: 20px auto;
        padding: 30px 30px;
        text-align: left;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
    .img-container {
        flex: 0 0 300px;
        text-align: right;
    }
    .right-img {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border-radius: 20px;
    }
    .button-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
       z-index: 1000;
    }
    .button-container a {
        display: inline-block;
        background: #870808ff;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        transition: background 0.3s;
    }
    .button-container a:hover {
        background: #b61127ff;
    }
</style>
<body>
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
    <div id="main-content">
        <div class="page-header-banner">
           <img src="../img/image.png" class="main-content-image">
            <div class="banner-overlay">
                    <h1>APPLICANT REQUIREMENTS</h1>
                <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="../ht/admissions.php">ADMISSIONS</a> • REQUIREMENTS
                </div>
            </div>
        </div>
    </div>
        
<div class ="container content-container">
    <h2>Personal Information</h2>
    <ul>
        <li>Full Name</li>
        <li>Age/Date of Birth</li>
        <li>Gender</li>
        <li>Contact Number</li>
        <li>Email Address</li>
        <li>Home Address</li>
        <li>Emergency Contact Details</li>
    </ul>
    <div class="img-container">
        <img src="../img/person1.jpg" alt="Application Requirements" class="right-img">
    </div>
</div>
<div class ="container content-container">
    <h2>Academic Information</h2>
    <ul>
        <li>Last School Attended</li>
        <li>Grade Level Completed</li>
        <li>General Weighted Average (GWA)</li>
        <li>Report Card</li>
        <li>Form 138/Transcript of Records</li>
        <li>Good Moral Certificate</li>
    </ul>
    <div class="img-container">
    <img src="../img/apply1.jpg" alt="Application Requirements" class="right-img">
    </div>
</div>

<div class="button-container">
    <a href="../register.php">Proceed to Online Application</a>
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

</body>
</html>