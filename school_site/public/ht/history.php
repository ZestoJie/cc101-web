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
    <title>Meridian Scholars University - History and Accreditation</title>
    <link rel="stylesheet" href="../styles/nav.css">
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
            --history-bg: #8B0000;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
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
            background-color: #8B0000; 
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

        .main-section {
            padding: 0 0 60px 0;
        }

        .history-content-layout {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .text-column {
            flex: 1;
        }
        
        .history-image-placeholder {
            flex-shrink: 0;
            width: 450px;
            height: 380px;
            background-color: #ccc;
            border: 1px solid #999;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            font-size: 1.2rem;
            font-family: var(--font-secondary);
            text-align: center;
            margin-left: 30px; 
            margin-top: 10px; 
        }
        .history-image-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            display: block; 
}
        .text-column p {
            margin-bottom: 25px;
            font-size: 1rem;
        }
        
        .university-facts {
            margin-top: 30px;
        }

        .university-facts h2 {
            font-family: var(--font-secondary);
            color: var(--primary-maroon);
            font-size: 1.6rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            border-bottom: 2px solid var(--bg-cream);
            padding-bottom: 5px;
        }
        
        .accreditation-block {
            background-image: none; 
            background-color: transparent; 
            padding: 0; 
            margin-top: 60px;
        }

        .accreditation-block .container {
    
            background-image: url('Acreditation.png'); 
            background-size: cover;
            background-position: center;
            background-color: rgba(0, 0, 0, 0.7);
            background-blend-mode: multiply; 
            padding: 30px 40px; 
            color: var(--white);
        }
        
        .accreditation-block h2 {
            font-family: var(--font-secondary);
            color: var(--white);
            font-size: 2.2rem;
            margin-bottom: 25px;
            text-transform: uppercase;
            text-align: center;
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .accreditation-block p {
            color: var(--white);
            font-size: 1.05rem;
            margin-bottom: 20px;
        }
        @media (max-width: 992px) {
            .width-navigation { display: none; }
            .width-logo { flex-grow: 1; justify-content: center; }
            .history-content-layout { flex-direction: column; }
            .history-image-placeholder { width: 100%; margin: 20px 0; }
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
                    <h1>HISTORY AND ACCREDITATION</h1>
                <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="admissions.php">ABOUT US</a> • HISTORY
                </div>
            </div>
        </div>
    </div>
        
        <div class="container">

            <div class="main-section">
                <div class="history-content-layout">
                    
                    <div class="text-column">
                        <p>The Meridian Scholars University (MSU) is the main campus of the Meridian Scholars University System (MSU), the national university by virtue of Republic Act 9500.</p>
                        
                        <p>MSU occupies 493 hectares of prime land in Quezon City, featuring an array of both old and new buildings, which house the various disciplines that offer comprehensive education covering all facets of human behavior and development at the baccalaureate and postbaccalaureate levels.</p>
                        
                        <p>MSU has 275 academic programs, 70 of which are in the undergraduate level, 105 in the master's, professional master's, Juris Doctor, BA-MA Honors, and 48 in the doctoral levels. Seven Associate in Arts and 24 graduate diploma programs are also offered, with extension programs in Pampanga and Olongapo City and currently under development, specialized programs at the MSU Professional Schools at the Bonifacio Global City.</p>
                        
                        <p>MSU is the biggest constituent university of the MSU System in terms of degree-granting academic units, student population, faculty and library resources. In the first semester of Academic Year 2023-2024, MSU Main had 27,286 students, in which 17,934 were undergraduates, 8,159 were pursuing master's and doctoral degrees, and 1,281 were pursuing the Juris Doctor degree. As of August 24, 2023, the MSU Main had a faculty complement of 2, 966, comprising 322 Full Professors, 287 Associate Professors, 715 Assistant Professors and 265 Instructors, alongside 1, 118 Lecturers, 63 Professor Emeriti, 20 Adjunct Professors, 9 Affiliate Faculty, 11 Professorial Fellow, and 14 Visiting Professors.</p>
                    </div>

                    <div class="history-image-placeholder">
                       <img src="../img/history.jpg">
                    </div>

                </div>
            </div>
        </div>
        
        <div class="accreditation-block">
            <div class="container">
                
                <h2>University Accreditation</h2>
                
                <p>The Meridian Scholars University (MSU) needs compulsory recognition by the Commission on Higher Education (CHED) for its programs and university status, which includes meeting specific operational requirements like Level III accreditation for at least four undergraduate and two graduate programs. In addition, MSU campuses and specific programs undergo voluntary, private accreditation from organizations like the Federation of Accrediting Agencies of the Philippines (FAAPI) (e.g., PAASCU) and international bodies such as the Asian Association of Open Universities (AAOU) for specific fields like distance education.</p>
                
                <p>The Unified Financial Assistance System for Tertiary Education (UniFAST), is a Philippine government program that consolidates all government-funded student financial assistance for college under one agency, the Commission on Higher Education (CHED). It provides various forms of support, including scholarships, grants-in-aid, student loans, and other programs to make tertiary education accessible and affordable for students in both public and private institutions.</p>
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