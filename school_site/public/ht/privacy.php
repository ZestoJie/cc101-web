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
    <title>Meridian Scholars University - Privacy Policy</title>
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
            --privacy-red: #8B0000;
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
            padding-bottom: 60px;
        }

        .privacy-content-wrapper {
            padding: 0 15px;
        }

        .dpc-logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
            float: left;
            margin-right: 20px;
        }
        
        .policy-block {
            clear: both;
            margin-bottom: 30px;
        }

        .policy-block h2 {
            font-family: var(--font-secondary);
            color: var(--privacy-red);
            font-size: 1.6rem;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--bg-cream);
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        
        .policy-block h3 {
            font-family: var(--font-primary);
            color: var(--privacy-red);
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        
        .policy-block p {
            margin-bottom: 20px;
        }
        
        .policy-block ul {
            list-style-type: disc;
            padding-left: 30px;
            margin-bottom: 20px;
        }
        
        .policy-block li {
            margin-bottom: 5px;
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
            .dpc-logo { float: none; margin: 0 auto 20px auto; display: block; }
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
                    <h1>PRIVACY POLICY</h1>
                    <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="aboutus.php">ABOUT US</a> • PRIVACY POLICY
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container privacy-content-wrapper">

            <div class="policy-block">
                <img src="../img/dpo.png" alt="buto mo" class="dpc-logo">
                <p><strong>Meridian Scholars University (MSU) Privacy Policy</strong></p>
                <p>Meridian Scholars University (MSU) is committed to protecting your personal information (PI) and sensitive personal information (SPI) and your privacy rights as enshrined in the Data Privacy Act of 2012 (DPA) and other relevant laws.</p>
            </div>
            
            <div class="policy-block">
                <h2>Our Privacy Notice</h2>
                <p>Meridian Scholars University (MSU) respects your privacy and is dedicated to protecting your PI and SPI. This Privacy Notice describes the types of PI and SPI we collect, how we collect, use, process, share, and secure it. It also outlines your rights regarding your PI and SPI.</p>
                
                <h3>Scope of Privacy Notice</h3>
                <p>This Privacy Notice covers the following data subjects:</p>
                <ul>
                    <li>Prospective students, alumni, faculty, staff, and job applicants.</li>
                    <li>Visitors to MSU websites and social media platforms.</li>
                    <li>Individuals who transact with MSU.</li>
                </ul>

                <h3>Under What Privacy Notice</h3>
                <p>Your PI and SPI will be processed under the following specific Notices:</p>
                <ul>
                    <li>The Student Data Privacy Notice.</li>
                    <li>The Faculty/Staff/Job Applicant Data Privacy Notice.</li>
                    <li>The Alumni Data Privacy Notice.</li>
                </ul>
            </div>
            
            <div class="policy-block">
                <h2>Collection of Personal Information</h2>
                <h3>Information We Collect</h3>
                <p>We collect PI and SPI from various sources, including:</p>
                <ul>
                    <li>The moment you enter into a contract with MSU (e.g., enrollment, employment).</li>
                    <li>Online and physical forms you fill out.</li>
                    <li>Through MSU websites and social media platforms.</li>
                    <li>From other sources (e.g., government agencies, educational institutions).</li>
                </ul>
                
                <h3>Information We Collect</h3>
                <p>The PI and SPI we collect include, but are not limited to:</p>
                <ul>
                    <li>Name, age, date of birth, address, and contact information.</li>
                    <li>Academic and employment history.</li>
                    <li>Financial information (e.g., tuition payments, salaries).</li>
                    <li>Health information (e.g., medical certificates).</li>
                    <li>Government-issued identification (e.g., SSS, PAGIBIG).</li>
                    <li>Photographs and videos.</li>
                    <li>Information collected through technology (e.g., CCTV, cookies).</li>
                </ul>

                <h3>Sensitive Personal Information We Collect</h3>
                <p>The SPI we collect include, but are primarily limited to:</p>
                <ul>
                    <li>Racial or ethnic origin, political opinions, religious beliefs.</li>
                    <li>Genetic or biometric data.</li>
                    <li>Sexual life.</li>
                    <li>Health records.</li>
                    <li>Licenses and permits.</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>Use of Collected Information</h2>
                <p>We use your PI and SPI for the following purposes:</p>
                <ul>
                    <li>Legitimate educational interest (e.g., admission, enrollment, graduation).</li>
                    <li>Administration and management of the university (e.g., payroll, human resources).</li>
                    <li>Research, institutional planning, and policy development.</li>
                    <li>Compliance with legal and regulatory obligations.</li>
                    <li>Protection of vital interests of the data subject.</li>
                    <li>Marketing and promotion of MSU programs.</li>
                </ul>
            </div>
            
            <div class="policy-block">
                <h2>Transfer and Sharing of Collected Information</h2>
                <p>We may share your PI and SPI with the following parties:</p>
                <ul>
                    <li>Government agencies (e.g., CHED, DOH, DSWD, PNP, NBI) to comply with legal mandates.</li>
                    <li>Educational institutions (e.g., MSU System members, partner schools) for academic purposes.</li>
                    <li>Third-party service providers (e.g., banks, insurance providers) for operational necessities.</li>
                    <li>Accrediting bodies (e.g., PAASCU, FAAPI) for quality assurance.</li>
                    <li>Other parties with your consent or as required by law.</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>Retention of Collected Information</h2>
                <p>We retain your PI and SPI for as long as necessary to fulfill the purposes for which it was collected, to comply with our legal and regulatory obligations, and to resolve disputes.</p>
            </div>
            
            <div class="policy-block">
                <h2>Security of Collected Information</h2>
                <p>We implement appropriate physical, technical, and organizational measures to protect your PI and SPI from loss, misuse, unauthorized access, disclosure, alteration, and destruction.</p>
                <ul>
                    <li>Physical security measures (e.g., locked file cabinets, secure storage areas).</li>
                    <li>Technical security measures (e.g., firewalls, encryption, access controls).</li>
                    <li>Organizational security measures (e.g., data privacy policies, employee training).</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>Personal Information of Minor Individuals</h2>
                <p>MSU only processes the PI and SPI of minor individuals with the consent of their parents or legal guardians, unless the processing is necessary for the protection of their vital interests.</p>
            </div>

            <div class="policy-block">
                <h2>Your Rights as Data Subject</h2>
                <p>You have the following rights regarding your PI and SPI:</p>
                <ul>
                    <li>The right to be informed.</li>
                    <li>The right to object.</li>
                    <li>The right to access.</li>
                    <li>The right to rectification.</li>
                    <li>The right to erasure or blocking.</li>
                    <li>The right to damages.</li>
                    <li>The right to data portability.</li>
                    <li>The right to lodge a complaint with the National Privacy Commission (NPC).</li>
                </ul>
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