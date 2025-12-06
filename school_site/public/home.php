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
    <title>Meridian Scholars University</title>
    <link rel="stylesheet" href = "styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-maroon: #561C24;
            --secondary-red: #6D2932;
            --accent-beige: #C7B7A3;
            --bg-cream: #E8D8C4;
            --text-color: #333;
            --white: #ffffff;
            --off-white: #f9f9f9;
            --text-dark: #333333;
            --text-light: #666666;
            --font-primary: 'Open Sans', sans-serif;
            --font-secondary: 'Oswald', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-primary);
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--white);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }
        .hero-section {
            text-align: center;
            justify-content: center;
            height: 600px;
            background: url("img/logo.png") center/cover no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: var(--white);
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(86, 28, 36, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 15px;
            z-index: 1;
        }
        .hero-content {
            align-items: center;
            text-align: center;
            justify-content: center;
            max-width: 1500px;
        }

        .hero-content h2 {
            font-family: var(--font-secondary);
            font-size: 3.8rem;
            line-height: 1.1;
            margin-bottom: 20px;
            text-transform: uppercase;
            color: var(--bg-cream);
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 35px;
            font-weight: 300;
            color: #f0f0f0;
        }

        .hero-buttons {
            position: absolute;
            bottom: 170px;
            right: 560px;
            justify-content: center;
            align-items: center;
            text-align: center;
            display: flex;
            gap: 15px;
        }

        .btn {
            display: inline-block;
            padding: 14px 35px;
            text-transform: uppercase;
            font-weight: 600;
            border-radius: 2px;
            transition: all 0.3s ease;
            font-family: var(--font-secondary);
            letter-spacing: 1px;
        }

        .btn-primary {
            background-color: var(--bg-cream);
            color: var(--primary-maroon);
            border: 2px solid var(--bg-cream);
        }

        .btn-primary:hover {
            background-color: var(--accent-beige);
            border-color: var(--accent-beige);
            color: var(--primary-maroon);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--bg-cream);
            border: 2px solid var(--bg-cream);
        }

        .btn-secondary:hover {
            background-color: var(--primary-maroon);
            border-color: var(--primary-maroon);
            color: var(--white);
        }

        .quick-links {
            padding: 60px 0;
            background-color: var(--white);
            border-bottom: 1px solid #eee;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            justify-content: center;
        }

        .quick-link-box {
            background: var(--white);
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid var(--accent-beige);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .quick-link-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border-top-color: var(--primary-maroon);
        }

        .quick-link-box .icon {
            font-size: 40px;
            color: var(--primary-maroon);
            margin-bottom: 20px;
        }

        .quick-link-box h3 {
            font-family: var(--font-secondary);
            color: #333;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-size: 1.2rem;
        }

        .link-arrow {
            color: var(--secondary-red);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
        }

        .link-arrow:hover {
            color: var(--primary-maroon);
        }

        .news-section {
            padding: 90px 0;
            background-color: var(--primary-maroon); 
            color: var(--white);
        }

        .section-header {
            text-align: center;
            justify-content: center;
            margin-bottom: 50px;
        }

        .section-header h3 {
            font-family: var(--font-secondary);
            font-size: 2.8rem;
            margin-bottom: 10px;
            color: var(--bg-cream);
        }

        .section-header p {
            color: var(--accent-beige);
        }

        .separator {
            height: 4px;
            width: 60px;
            background-color: var(--accent-beige);
            margin-top: 20px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .news-item {
            background: var(--white);
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .news-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .news-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .news-content {
            padding: 25px;
        }

        .news-meta {
            font-size: 12px;
            color: var(--secondary-red);
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .news-content h4 a {
            color: #333;
            font-family: var(--font-secondary);
            font-size: 20px;
            line-height: 1.4;
            font-weight: 400;
        }

        .news-content h4 a:hover {
            color: var(--primary-maroon);
        }

        .site-footer {
            background-color: #1a1a1a;
            color: #999;
            padding: 70px 0 30px;
            text-align: center;
            border-top: 6px solid var(--accent-beige);
        }

        .footer-logo img {
            height: 80px;
            margin-bottom: 25px;
        }

        .social-icons {
            margin-bottom: 25px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #333;
            color: var(--white);
            border-radius: 50%;
            margin: 0 5px;
            transition: background 0.3s;
        }

        .social-icons a:hover {
            background-color: var(--primary-maroon);
            color: var(--bg-cream);
        }

        .footer-links {
            font-size: 14px;
            margin-bottom: 25px;
            font-family: var(--font-primary);
        }

        .footer-links a {
            color: #ccc;
            margin: 0 8px;
        }

        .footer-links a:hover {
            color: var(--bg-cream);
        }

        .copyright {
            font-size: 13px;
            color: #666;
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
                                <a href="home.php">
                                <img src="img/logo.png" alt="Meridian Scholars University">
                                </a>
                                    <div class="logo-text">
                                        <h1>Meridian Scholars University</h1>
                                        <span>Honing The Future Scholars</span>
                                    </div>
                        </div>
        <nav class="width-navigation table-cell table-right">
                <ul class="nav navbar-nav menu-main-menu">
                    <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="html/academics.php">Academic Programs</a>
                    <ul class="sub-menu">
                        <li><a href="html/computer.php">College of Computer Studies</a></li>
                        <li><a href="html/educ.php">College of Education</a></li>
                        <li><a href="html/engineering.php">College of Engineering</a></li>
                        <li><a href="html/finance.php">College of Finance</a></li>
                    </ul>
                </li>

                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="ht/admissions.php" class="tc-menu-inner">Admissions</a>
                    <ul class="sub-menu">
                        <li><a href="html/applicant_req.php">Application Requirements</a></li>
                        <li><a href="ht/scholarship.php">Tuition and Financial Aid / Scholarships</a></li>
                        <li><a href="register.php">Online Application</a></li>
                    </ul>
                </li>
                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="ht/aboutus.php" class="tc-menu-inner">About Us</a>
                    <ul class="sub-menu">
                        <li><a href="ht/mission.php">Mission & Vision</a></li>
                        <li><a href="ht/history.php">History</a></li>
                        <li><a href="ht/administration.php">Governance</a></li>
                        <li><a href="ht/contact.php">Contact Us</a></li>
                        <li><a href="ht/faculty.php">Faculty Directory</a></li>
                        <li><a href="ht/privacy.php">Privacy Policy</a></li>
                    </ul>
                </li>
                <li class="menu-item tc-menu-item menu-item-has-children">
                    <a href="html/campuslife.php" class="tc-menu-inner">Campus Life</a>
                    <ul class="sub-menu">
                        <li><a href="html/organizations.php">Organizations</a></li>
                        <li><a href="html/sports.php">Sports & Athletics</a></li>
                        <li><a href="html/news.php">News</a></li>
                    </ul>
                </li>

                <?php if ($user): ?>
                    <li class="tc-menu-item">
                        <a href="<?= $dashboardLink ?>">Dashboard</a>
                    </li>
                    <li class="tc-menu-item">
                        <a href="logout.php" style="color:#ffdddd;">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
    <section class="hero-section">
        <div class="hero-overlay" style = "text-align: center;">
            <div class="container">
                <div class="hero-content">
                    <h2>Shaping Tomorrow's Scholars</h2>
                    <p>Meridian Scholars University is committed to academic excellence, pursuing knowledge, and community enlightenment.</p>
                    <div class="hero-buttons">
                        <a href="html/applicant_req.php" class="btn btn-primary">Apply Now</a>
                        <a href="ACADEMICS.html" class="btn btn-secondary">View Programs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-links">
        <div class="container">
            <div class="quick-links-grid">
                <div class="quick-link-box">
                    <div class="icon"><i class="fa fa-pencil-alt"></i></div>
                    <h3>Apply Now</h3>
                    <a href="html/applicant_req.php" class="link-arrow">View More <i class="fa fa-chevron-right"></i></a>
                </div>
                <div class="quick-link-box">
                    <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                    <h3>Scholarships</h3>
                    <a href="ht/scholarship.php" class="link-arrow">View More <i class="fa fa-chevron-right"></i></a>
                </div>
                <div class="quick-link-box">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <h3>About Us</h3>
                    <a href="ht/aboutus.php" class="link-arrow">View More <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <h3>In The News</h3>
                <p>Read about the latest university initiatives, achievements, and developments.</p>
                <div class="separator"></div>
            </div>
            
            <div class="news-grid">
                <article class="news-item">
                    <div class="news-image">
                        <img src="img/news1.jpg" alt="News 1">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">Nov 4, 2025</div>
                        <h4><a href="html/news1.php">MSU Becomes 3rd Top Performing University in the Country</a></h4>
                    </div>
                </article>
                <article class="news-item">
                    <div class="news-image">
                        <img src="img/international.jpg" alt="News 2">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">Nov 18, 2025</div>
                        <h4><a href="html/news2.php">MSU GOES INTERNATIONAL</a></h4>
                    </div>
                </article>
                <article class="news-item">
                    <div class="news-image">
                        <img src="img/49th.png" alt="News 3">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">Nov 18, 2025</div>
                        <h4><a href="html/news3.php">MSU COMMENCES 49TH FOUNDING ANNIVERSARY</a></h4>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <footer id="colophon" class="site-footer has-footer-bottom">
        <div class="footer-bottom">
            <div class="container">
                <div class="textwidget">
                    <div class="footer-branding">
                        <img class="footer-logo-img" src="img/logo.png" alt="Meridian Logo"><br>
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
                        <a href="ht/contact.php">Contact us</a> | 
                        <a href="ht/privacy.php">Privacy</a> | 
                        <a href="ht/privacy.php">Terms</a>
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