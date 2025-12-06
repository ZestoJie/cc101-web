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
    <title>CCS Programs - Meridian Scholars University</title>
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
            --college-color: #561C24; 
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

        #main-content {
            flex: 1;
            background-color: var(--off-white);
        }

        .section-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-heading h1 {
            font-family: var(--font-secondary);
            font-size: 3rem;
            color: var(--college-color);
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .section-heading p {
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
        }

        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .program-card {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            border-top: 5px solid var(--college-color);
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .card-header {
            background-color: var(--college-color);
            color: var(--white); 
            padding: 20px 25px;
            text-align: center;
        }

        .card-header h3 {
            font-family: var(--font-secondary);
            font-size: 1.6rem;
            margin: 0;
            text-transform: uppercase;
        }

        .card-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content p {
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .btn-details {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--bg-cream);
            color: var(--primary-maroon);
            border-radius: 4px;
            font-family: var(--font-secondary);
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            text-align: center;
            border: 1px solid var(--bg-cream);
        }

        .btn-details:hover {
            background-color: var(--primary-maroon);
            color: var(--white);
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
                    <li class="menu-item tc-menu-item menu-item-has-children current-menu-item">
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
                <li class="menu-item tc-menu-item menu-item-has-children">
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
                    <h1>PROGRAMS OFFERED</h1>
                <div class="breadcrumbs">
                    <a href="../home.php">HOME</a> • <a href="academics.php">ACADEMIC PROGRAMS</a> • ENGINEERING
                </div>
            </div>
        </div>
    </div>
        <div class="container">
            
            <div class="section-heading">
                <h1>College of Engineering Programs</h1>
                <p>Innovate, design, and build the infrastructure of tomorrow. Our engineering programs blend rigorous science with practical design and problem-solving.</p>
            </div>

            <div class="program-grid">
                <div class="program-card">
                    <div class="card-header">
                        <h3>BS Computer Engineering</h3>
                    </div>
                    <div class="card-content">
                        <p>Combines computer science and electrical engineering to design and develop computer hardware and software. Focuses on microprocessors, embedded systems, and computer architecture.</p>
                        <a href="#" class="btn-details">View Curriculum</a>
                    </div>
                </div>

                <div class="program-card">
                    <div class="card-header">
                        <h3>BS Industrial Engineering</h3>
                    </div>
                    <div class="card-content">
                        <p>Optimizing complex processes or systems. Focuses on resource management, logistics, quality control, and improving efficiency and productivity across various industries.</p>
                        <a href="#" class="btn-details">View Curriculum</a>
                    </div>
                </div>

                <div class="program-card">
                    <div class="card-header">
                        <h3>BS Electronics Engineering</h3>
                    </div>
                    <div class="card-content">
                        <p>Deals with the design, development, and maintenance of electronic equipment, circuits, and systems, including telecommunications, signal processing, and integrated circuits.</p>
                        <a href="#" class="btn-details">View Curriculum</a>
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