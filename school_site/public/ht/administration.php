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
    <title>Meridian Scholars University - Administration and Governance</title>
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
            --admin-red: #8B0000;
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
            padding: 0 0 60px 0;
        }

        .section-title-bar {
            background-color: var(--admin-red);
            padding: 15px 0;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .section-title-bar h2 {
            color: var(--white);
            font-family: var(--font-secondary);
            font-size: 1.8rem;
            text-transform: uppercase;
        }
        
        .admin-block {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        
        .admin-block:last-child {
            border-bottom: none;
        }

        .admin-item {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            margin-bottom: 40px;
        }

        .admin-photo {
            flex-shrink: 0;
            width: 130px;
            height: 130px;
            background-color: var(--bg-cream);
            border: 1px solid #ccc;
            overflow: hidden;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            text-align: center;
            font-size: 0.9rem;
        }
        .admin-photo img,
        .dean-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
           object-position: top; 
            display: block;
        }

        .admin-details {
            flex-grow: 1;
        }

        .admin-details h3 {
            font-family: var(--font-secondary);
            font-size: 1.2rem;
            color: var(--admin-red);
            margin-bottom: 5px;
            text-transform: uppercase;
            line-height: 1.2;
        }
        
        .admin-details h4 {
            font-family: var(--font-primary);
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .admin-details p {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 0;
        }
        
        .dean-item {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            margin-bottom: 30px;
        }

        .dean-photo {
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            background-color: var(--bg-cream);
            border: 1px solid #ccc;
            overflow: hidden;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            text-align: center;
            font-size: 0.8rem;
        }

        .dean-details {
            flex-grow: 1;
        }
        
        .dean-details h4 {
            font-family: var(--font-secondary);
            font-size: 1.1rem;
            color: var(--primary-maroon);
            margin-bottom: 5px;
            text-transform: uppercase;
            line-height: 1.2;
        }
        
        .dean-details p {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0;
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
            .admin-item, .dean-item { flex-direction: column; text-align: center; }
            .admin-photo, .dean-photo { margin: 0 auto 15px auto; }
            .admin-details, .dean-details { text-align: center; }
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
                    <h1>ADMINISTRATION AND GOVERNANCE</h1>
                <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="aboutus.php">ABOUT US</a> • ADMINS
                </div>
            </div>
        </div>
    </div>
        
        <div class="container">

            <div class="admin-block">
                <div class="admin-item">
                    <div class="admin-photo"><img src="../img/president.png"></div>
                    <div class="admin-details">
                        <h3>Dr. Ada Weng</h3>
                        <h4>University President</h4>
                        <p>Dr. Weng is the President of the University of Meredian Scholars, responsible for guiding the university’s vision and strategy while fostering excellence in academics, research, and community engagement.</p>
                    </div>
                </div>
            </div>
            
            <div class="section-title-bar">
                <h2>Vice Presidents</h2>
            </div>

            <div class="admin-block">
                <div class="admin-item">
                    <div class="admin-photo"><img src="../img/giannis.jpg"></div>
                    <div class="admin-details">
                        <h3>Steven Antetokounmpo</h3>
                        <h4>Vice President for Academic Affairs</h4>
                        <p>Dr. Antetokounmpo is the Vice President for Academic Affairs of the University of Meredian Scholars. She ensures that academic programs meet high standards and supports faculty and students in achieving educational excellence.</p>
                    </div>
                </div>

                <div class="admin-item">
                    <div class="admin-photo"><img src="../img/lebron.jpeg"></div>
                    <div class="admin-details">
                        <h3>LeBron Raymone James Jr.</h3>
                        <h4>Vice President for Administration</h4>
                        <p>Mr. James is the Vice President for Administration of the University of Meredian Scholars. He manages operations, finances, and campus infrastructure to ensure smooth and efficient university functioning.</p>
                    </div>
                </div>

                <div class="admin-item">
                    <div class="admin-photo"><img src="../img/durant.jpg"></div>
                    <div class="admin-details">
                        <h3>Kevin Wayne Durant</h3>
                        <h4>Vice President for Student Services</h4>
                        <p>Mr. Kevin Durant is the Vice President for Student Services of the University of Meredian Scholars. he oversees student welfare, guidance, and activities, fostering a vibrant and supportive campus life.</p>
                    </div>
                </div>
            </div>
            
            <div class="section-title-bar">
                <h2>Deans of Colleges</h2>
            </div>
            
            <div class="admin-block">
                <div class="dean-item">
                    <div class="dean-photo"><img src="../img/CURRY.jpg"></div>
                    <div class="dean-details">
                        <h4>College of Computer Studies</h4>
                        <p>Engr. Curry is the Dean of the College of Computer Studies at the University of Meredian Scholars. He leads programs in IT and computer science while promoting research and innovation.</p>
                    </div>
                </div>

                <div class="dean-item">
                    <div class="dean-photo"><img src="../img/therock.jpg"></div>
                    <div class="dean-details">
                        <h4>College of Education</h4>
                        <p>Dr. Dwayne Johnson is the Dean of the College of Education at the University of Meredian Scholars. She focuses on training quality educators and advancing pedagogical research.</p>
                    </div>
                </div>

                <div class="dean-item">
                    <div class="dean-photo"><img src="../img/michaelb.jpg"></div>
                    <div class="dean-details">
                        <h4>College of Finance</h4>
                        <p>Dr. Micheal B. Jordan is the Dean of the College of Finance at the University of Meredian Scholars. He oversees finance programs, labs, and student projects.</p>
                    </div>
                </div>

                <div class="dean-item">
                    <div class="dean-photo"><img src="../img/goat.jpg"></div>
                    <div class="dean-details">
                        <h4>College of Engineering</h4>
                        <p>Engr. Navarro is the Dean of the College of Engineering at the University of Meredian Scholars. He oversees engineering programs, labs, and student projects.</p>
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