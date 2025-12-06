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
    <title>Meridian Scholars University - Scholarships & Financial Aid</title>
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
            --about-red: #8B0000;
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
            background-color: #6D2932; 
            background-size: cover;
            background-position: center;
            height: 250px;
            position: relative;
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(86, 28, 36, 0.4), rgba(86, 28, 36, 0.4));
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
            padding: 0 0 60px 0;
        }

        .main-content-area {
            width: 100%;
            padding: 0 15px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .main-content-area h2 {
            font-family: var(--font-secondary);
            font-size: 1.8rem;
            color: var(--primary-maroon);
            margin-bottom: 25px;
            text-transform: uppercase;
            border-bottom: 2px solid var(--bg-cream);
            padding-bottom: 5px;
        }

        .info-block {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: var(--off-white);
            border: 1px solid var(--bg-cream);
            border-radius: 8px;
        }
        
        .info-block-wide {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: var(--off-white);
            border: 1px solid var(--bg-cream);
            border-radius: 8px;
        }
        
        .info-image-container {
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 50%;
            border: 3px solid var(--primary-maroon);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 5px; 
        }
        
        .info-block-wide .info-image-container {
             border: none;
             border-radius: 0;
             width: 100px; 
             height: auto;
             align-items: flex-start; 
             margin-top: 0; 
        }
        
        .info-block-wide .info-image {
             width: 100%;
             height: auto;
             max-height: 80px; 
             object-fit: contain;
        }

        .info-image {

            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }

        .info-details {
            flex-grow: 1;
        }

        .info-details h3 {
            font-family: var(--font-secondary);
            font-size: 1.4rem;
            color: var(--about-red);
            margin: 0 0 10px 0;
            line-height: 1.2;
        }

        .info-details p, .info-block-wide p {
            font-size: 0.95rem;
            margin-bottom: 10px;
        }
        
        .info-details strong {
            font-weight: 700;
            color: var(--primary-maroon);
        }

        .info-details a, .info-block-wide a {
            color: var(--secondary-red);
            text-decoration: underline;
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
        @media (max-width: 992px) {
            .width-navigation { display: none; }
            .width-logo { flex-grow: 1; justify-content: center; }
            .content-container { flex-direction: column; padding: 20px 15px; }
            .info-block { flex-direction: column; text-align: center; }
            .info-image-container { margin: 0 auto 15px auto; }
            .info-block-wide { flex-direction: column; }
            .info-block-wide .info-image-container { width: 100%; max-width: 100px; margin: 0 auto 15px auto; }
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

                <li class="menu-item tc-menu-item menu-item-has-children  current-menu-item">
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
                    <h1>SCHOLARSHIP</h1>
                <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="admissions.php">ADMISSIONS</a> • FINANCIAL AID
                </div>
            </div>
        </div>
    </div>
        
        <div class="main-content-area">

            <h2>Unified Student Financial Assistance System for Tertiary Education (UniFAST)</h2>

            <div class="info-block">
                <div class="info-image-container" style="border: none;">
                    <img src="../img/UNIFAST.png" class="info-image">
                </div>
                <div class="info-details">
                    <h3>Unified Student Financial Assistance System for Tertiary Education (UniFAST)</h3>
                    <p><strong>RA 10687 “Unified Student Financial Assistance System for Tertiary Education” (UniFAST)</strong> is an act that reconciles, improves, strengthens, expands, and puts under one body all government-funded modalities of Student Financial Assistance Programs (StuFAPs) for Tertiary Education – and special purpose education assistance – in both public and private institutions.</p>
                    <p>These modalities include scholarship, grants-in-aid, student loans and other specialized forms of StuFAPs formulated by the UniFAST BOARD.</p>
                    <p><strong>RA 10931 “Universal Access to Quality Tertiary Education Act (UAQTEA)”</strong> is an act promoting universal access to quality tertiary education by providing free tuition and other school fees in State Universities and Colleges, Local Universities and Colleges, and State-Run Technical-Vocational Institutions, establishing the Tertiary Education Subsidy and Student Loan Program, strengthening the Unified Student Financial Assistance System for Tertiary Education, and appropriating fund therefore, as stated in the title of the Law.</p>
                    <p><strong>Programs under UAQTEA:</strong></p>
                    <ul>
                        <li>Free Higher Education (FHE)</li>
                        <li>Tertiary Education Subsidy (TES)</li>
                        <li>Free Technical-Vocational Education and Training (TVET) in Post- Secondary State-Run TVIs</li>
                        <li>Student Loan Program (SLP)</li>
                    </ul>
                    <p>For more details, kindly click the link provided below.</p>
                    <p><a href="https://unifast.gov.ph" target="_blank">https://unifast.gov.ph</a></p>
                </div>
            </div>
            
            <h2>Other Scholarship and Financial Aid Programs</h2>

            <div class="info-block">
                <div class="info-image-container">
                    <img src="../img/logo.png" class="info-image">
                </div>
                <div class="info-details">
                    <h3>Meridian Scholars Program (MSP)</h3>
                    <p>The Meridian Scholars Program (MSP), sponsored by the Meridian Scholars University Financial Aid Office, provides tuition and allowance support for residents demonstrating academic merit and financial need.</p>
                    <p>For more details, kindly check the latest University Policies or contact the MSU Financial Aid and Grants Division.</p>
                    <p><a href="https://msu.edu.ph/financial-aid-office" target="_blank">https://msu.edu.ph/financial-aid-office</a></p>
                </div>
            </div>
            
            <div class="info-block-wide">
                <div class="info-image-container">
                    <img src="../img/sm.png"  class="info-image">
                </div>
                <div class="info-details" style="flex-grow: 1;">
                    <h3>SM Foundation College Scholarship Program</h3>
                    <p>The SM Foundation provides scholarship support to deserving students pursuing college degrees, particularly in fields related to engineering, computer science, and education.</p>
                    <p>This program assists students from economically challenging backgrounds to complete their tertiary education and contribute to nation-building.</p>
                    <p>For application requirements, eligibility criteria, and more details on the college scholarship program, please visit the official SM Foundation page:</p>
                    <p><a href="https://www.sm-foundation.org/what_we_do/college-scholarship-program/" target="_blank">https://www.sm-foundation.org/what_we_do/college-scholarship-program/</a></p>
                </div>
            </div>
            
            <h2 style="margin-top: 30px;">Contact Information (Scholarship Office)</h2>
            <p>Landline: +63 (2) 8555-5000 (Local 4200)</p>
            <p>Email address: <a href="mailto:scholarships@msu.edu.ph">scholarships@msu.edu.ph</a></p>
            <p>Office address: MSU Main Campus, Administration Building, Scholar Services Wing, Second Floor.</p>
            <p><strong>Official Facebook page:</strong> MSU Financial Aid and Grants Division</p>
            <p><a href="https://www.facebook.com/MSUFinAid" target="_blank">https://www.facebook.com/MSUFinAid</a></p>

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