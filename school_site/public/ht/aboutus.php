<?php
session_start();
$user = $_SESSION['user'] ?? null;
$isLoggedIn = isset($_SESSION['user']);
$role = $isLoggedIn ? (int)$_SESSION['user']['role_id'] : null;

$dashboardLink = 'home.php';
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
    <title>Meridian Scholars University - About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-maroon: #561C24;
            --secondary-red: #6D2932;
            --accent-beige: #C7B7A3;
            --bg-cream: #E8D8C4;
            --text-dark: #333333;
            --text-light: #666666;
            --white: #ffffff;
            --off-white: #f9f9f9;
            --font-primary: 'Open Sans', sans-serif;
            --font-secondary: 'Oswald', sans-serif;
            --about-red: #561C24;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            overflow-x: hidden;
            font-family: var(--font-primary);
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--white);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        ul {
            list-style: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;
        }

        .site-header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 9999;
            border-top: 5px solid var(--primary-maroon);
        }

        .thim-nav-wrapper {
            display: flex;
            align-items: center;
            height: 90px;
        }

        .row {
            display: flex;
            width: 100%;
            align-items: center;
        }

        .navigation {
            width: 100%;
        }

        .tm-table {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .width-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
        }

        .width-logo img {
            max-height: 65px;
            width: auto;
        }

        .logo-text h1 {
            font-family: var(--font-secondary);
            font-size: 1.2rem;
            color: var(--primary-maroon);
            text-transform: uppercase;
            margin: 0;
            line-height: 1;
        }

        .logo-text span {
            font-size: 0.75rem;
            color: #666;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .width-navigation {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
        }

        .navbar-nav {
            display: flex;
            gap: 25px;
        }

        .tc-menu-item {
            position: relative;
        }

        .tc-menu-item > a {
            font-family: var(--font-secondary);
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-dark);
            padding: 30px 0;
            display: block;
        }

        .tc-menu-item:hover > a,
        .tc-menu-item.current-menu-item > a {
            color: var(--secondary-red);
        }

        .sub-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: var(--white);
            min-width: 260px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1000;
            border-top: 4px solid var(--primary-maroon);
        }

        .tc-menu-item:hover .sub-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .sub-menu li {
            border-bottom: 1px solid var(--off-white);
        }

        .sub-menu li a {
            display: block;
            padding: 12px 20px;
            font-family: var(--font-primary);
            font-size: 14px;
            color: var(--text-light);
            text-transform: none;
        }

        .sub-menu li a:hover {
            background-color: var(--bg-cream);
            color: var(--primary-maroon);
            padding-left: 25px;
        }

        .page-header-banner {
            background-color: var(--primary-maroon);
            background-size: cover;
            background-position: center;
            height: 250px;
            position: relative;
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .banner-image-placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            display: block;
            background-color: var(--primary-maroon);
        }
        
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(86, 28, 36, 0.9), rgba(86, 28, 36, 0.6));
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 30px 15px;
        }

        .banner-overlay h1 {
            font-family: var(--font-secondary);
            color: var(--white);
            font-size: 3rem;
            text-transform: uppercase;
            margin-bottom: 5px;
            padding-left: 15px;
        }
        
        .breadcrumbs {
            font-size: 0.9rem;
            color: var(--white);
            padding-left: 15px;
        }
        
        .breadcrumbs a {
            color: var(--accent-beige);
            font-weight: 600;
        }

        #main-content {
            flex: 1;
            background-color: var(--white);
        }

        .main-content-wrapper {
            padding-bottom: 60px;
        }

        .content-layout {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .main-content-area {
            flex: 2;
            padding-right: 20px;
        }

        .sidebar-area {
            flex: 1;
            min-width: 300px;
            max-width: 300px;
            background-color: var(--off-white);
            border: 1px solid #eee;
            padding: 20px;
        }
        
        .main-content-image {
            width: 100%;
            height: 350px;
            object-fit: cover;
            margin-bottom: 30px;
            background-color: #ccc;
            border: 1px solid #999;
            display: block;
        }

        .main-content-area p {
            margin-bottom: 25px;
            font-size: 1rem;
        }
        
        .link-blocks-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 40px;
        }
        
        .link-block {
            padding: 10px;
            background-color: var(--white);
            border: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s;
        }

        .link-block:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .link-block-title {
            font-family: var(--font-secondary);
            font-size: 1.2rem;
            color: var(--primary-maroon);
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .link-block-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            margin-bottom: 15px;
            background-color: var(--bg-cream);
            border: 1px solid #999;
            display: block;
        }

        .link-block ul {
            list-style: disc;
            padding-left: 20px;
        }
        
        .link-block li {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .link-block li a:hover {
            color: var(--secondary-red);
        }

        .sidebar-block {
            background-color: var(--white);
            margin-bottom: 25px;
        }
        
        .sidebar-block h3 {
            font-family: var(--font-secondary);
            font-size: 1.4rem;
            text-transform: uppercase;
            color: var(--white);
            padding: 15px 20px;
            margin-bottom: 15px;
            line-height: 1.2;
        }
        
        .news-block h3 {
            background-color: var(--primary-maroon);
        }
        
        .glance-block h3 {
            background-color: var(--secondary-red);
        }
        
        .college-block h3, .campus-block h3 {
             background-color: var(--about-red);
        }

        .sidebar-news-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        
        .sidebar-news-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .news-item-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-maroon);
            line-height: 1.4;
            display: block;
        }
        
        .news-item-meta {
            font-size: 0.8rem;
            color: var(--text-light);
        }
        
        .glance-block ul, .college-block ul, .campus-block ul {
            list-style: disc;
            padding: 0 20px 20px 20px;
        }
        
        .glance-block li, .college-block li, .campus-block li {
            margin-bottom: 10px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .glance-block li strong {
            color: var(--primary-maroon);
        }

        .site-footer {
            background-color: #1a1a1a; 
            color: #ffffff;
            padding-top: 0;
            border-top: 6px solid var(--accent-beige);
        }

        .footer-bottom {
            background-color: #222;
            padding: 60px 0;
            position: relative;
        }

        .footer-bottom .container {
            text-align: center;
        }

        .footer-logo-img {
            max-height: 90px;
            width: auto;
            margin-bottom: 20px;
        }

        .footer-branding h2 {
            font-family: var(--font-secondary);
            color: var(--white);
            text-transform: uppercase;
            font-size: 1.5rem;
            margin: 0 0 5px 0;
        }

        .footer-branding span {
            color: #999;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .footer-social-icons {
            margin: 25px 0;
        }

        .footer-social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background-color: #333;
            color: #fff;
            border-radius: 50%;
            margin: 0 5px;
            text-align: center;
            font-size: 16px;
            transition: background 0.3s;
        }

        .footer-social-icons a:hover {
            background-color: var(--primary-maroon);
            color: var(--bg-cream);
        }

        .footer-links a {
            color: #ccc;
            font-size: 14px;
            margin: 0 12px;
            font-family: var(--font-primary);
        }

        .footer-links a:hover {
            color: var(--bg-cream);
        }

        .copyright-area {
            background-color: #111;
            padding: 20px 0;
            text-align: center;
            font-size: 13px;
            color: #666;
        }

        @media (max-width: 992px) {
            .width-navigation { display: none; }
            .width-logo { flex-grow: 1; justify-content: center; }
            .content-layout { flex-direction: column; }
            .sidebar-area { min-width: 100%; max-width: 100%; }
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

                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="admissions.php" class="tc-menu-inner">Admissions</a>
                    <ul class="sub-menu">
                        <li><a href="../html/applicant_req.php">Application Requirements</a></li>
                        <li><a href="scholarship.php">Tuition and Financial Aid / Scholarships</a></li>
                        <li><a href="../register.php">Online Application</a></li>
                    </ul>
                </li>
                <li class="menu-item tc-menu-item menu-item-has-children current-menu-item">
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
                <h1>ABOUT US</h1>
                <div class="breadcrumbs">
                    <a href="../home.php">HOME</a> • ABOUT US
                </div>
            </div>
        </div>
        
        <div class="main-content-wrapper container">

            <div class="content-layout">
                
                <div class="main-content-area">

                    <img src="../img/sa2nd.png" class="main-content-image">

                    <p>Meridian Scholars University stands at the forefront of cultivating exceptional minds dedicated to shaping tomorrow's landscape. Located at the heart of a thriving and culturally rich city, Meridian Scholars University serves as a diverse academic home to gifted learners from various backgrounds.</p>
                    
                    <p>The university is a premier academic sanctuary for outstanding scholars—individuals driven by excellence and committed to advancing the public good. Our students find a community that values intellectual curiosity and limitless mindfulness—preparing them for distinguished futures where they can lead, innovate, and serve with impact.</p>

                    <div class="link-blocks-container">
                        <div class="link-block">
                            <div class="link-block-title">About MSU</div>
                                <img src="../img/aboutmsu.png" class="link-block-image">
                                <ul>
                                <li><a href="mission.php">Mission, Vision, and Values</a></li>
                                <li><a href="history.php">History and Accreditations</a></li>
                                <li><a href="administration.php">Administration and Governance</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                                <li><a href="faculty.php">Faculty & Staff Directory</a></li>
                                <li><a href="privacy.php">Privacy Policy</a></li>
                                </ul>
                            </div>

                    <div class="link-block">
                        <div class="link-block-title">Admission</div>
                            <img src="../img/shakinghands.png" class="link-block-image">
                            <ul>
                            <li><a href="../html/applicant_req.php">Application Requirements & Process</a></li>
                            <li><a href="../html/scholarship.php">Tuition & Financial Aid</a></li>
                            <li><a href="../html/register.php">Online Application Form</a></li>
                            </ul>
                    </div>

<div class="link-block">
    <div class="link-block-title">College Programs</div>
    <img src="../img/flag.png" class="link-block-image">
    <ul>
        <li><a href="../html/engineering.php">College of Engineering</a></li>
        <li><a href="../html/finance.php">College of Finance</a></li>
        <li><a href="../html/computer.php">College of Computer Studies</a></li>
        <li><a href="../html/educ.php">College of Education</a></li>
    </ul>
</div>


                        <div class="link-block">
                            <div class="link-block-title">Campus Life</div>
                            <img src="../img/campus.jfif" class="link-block-image">
                            <ul>
                                <li><a href="../html/organizations.php">Student Organizations</a></li>
                                <li><a href="../html/sports.php">Sports / Athletics</a></li>
                                <li><a href="../html/news.php">News</a></li>
                            </ul>
                        </div>
                        
                    </div>

                </div>
                
                <div class="sidebar-area">
                    
                    <div class="sidebar-block news-block">
                        <h3>MSU NEWS</h3>
                        <div class="sidebar-news-item">
                            <a href="../html/news1.php" class="news-item-title">MSU becomes 3rd top performing university in the country</a>
                            <p class="news-item-meta">November 4, 2025</p>
                        </div>
                        <div class="sidebar-news-item">
                            <a href="../html/news2.php" class="news-item-title">MSU GOES INTERNATIONAL</a>
                            <p class="news-item-meta">November 18, 2025</p>
                        </div>
                        <div class="sidebar-news-item">
                            <a href="../html/news3.php" class="news-item-title">MSU COMMENCES 49TH FOUNDING ANNIVERSARY</a>
                            <p class="news-item-meta">November 18, 2025</p>
                        </div>
                    </div>
                    
                    <div class="sidebar-block glance-block">
                        <h3>MSU AT A GLANCE</h3>
                        <img src="../img/sidebar.png" class="main-content-image" style="height: 100px; border: none; margin-bottom: 15px;">
                        <ul>
                            <li>MSU is a premier scholars-exclusive university located in Metro Manila, at the center of a vibrant cultural and rich academic district.</li>
                            <li>MSU is recognized for its rigorous academic training, internationally aligned programs, and highly skilled research output, producing top-tier leaders and innovators.</li>
                            <li>As of 2025, MSU maintains a highly favorable student-to-faculty ratio, ensuring personalized mentorship and outstanding academic guidance.</li>
                        </ul>
                    </div>
                    
                    <div class="sidebar-block college-block">
                        <h3>COLLEGES</h3>
                       <ul>
                            <li><a href="../html/engineering.php">College of Engineering</a></li>
                            <li><a href="../html/finance.php">College of Finance</a></li>
                            <li><a href="../html/computer.php">College of Computer Studies</a></li>
                            <li><a href="../html/educ.php">College of Education</a></li>
                        </ul>
                    </div>

                    <div class="sidebar-block campus-block">
                        <h3>CAMPUS LIFE</h3>
                        <ul>
                            <li><a href="#">Student Organizations</a></li>
                            <li><a href="#">Sports / Athletics</a></li>
                            <li><a href="#">News</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
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
                        <a href="contact.php">Contact us</a> | 
                        <a href="privacy.php">Privacy</a> | 
                        <a href="privacy.php">Terms</a>
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