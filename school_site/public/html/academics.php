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
    <title>Meridian Scholars University - Academics</title>
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
            --about-red: #561C24;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-primary);
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--white);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; transition: all 0.2s ease; }
        ul { list-style: none; }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 15px; width: 100%; }

        .page-header-banner { background:linear-gradient(90deg, rgba(86,28,36,0.9), rgba(86,28,36,0.6)); height:220px; position:relative; margin-bottom:30px; display:flex; align-items:flex-end; color:var(--white); }
        .page-header-banner .banner-overlay { padding:26px 15px; }
        .page-header-banner h1 { font-family:var(--font-secondary); font-size:2.6rem; margin:0; text-transform:uppercase; }
        .breadcrumbs { margin-top:6px; font-size:0.95rem; color:var(--accent-beige); }
        .breadcrumbs a { color:var(--accent-beige); font-weight:600; }

        #main-content { flex:1; background-color:var(--off-white); padding-bottom:60px; }

        .section-heading { text-align:center; margin-bottom:40px; padding-top:15px; }
        .section-heading h1 { font-family:var(--font-secondary); font-size:2.2rem; color:var(--primary-maroon); margin-bottom:10px; text-transform:uppercase; }
        .section-heading p { font-size:1rem; color:var(--text-light); max-width:700px; margin:0 auto; }

        .college-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap:22px; padding:0 8px 20px 8px; }
        .college-card { background:var(--white); border-radius:6px; overflow:hidden; box-shadow:0 6px 18px rgba(0,0,0,0.04); transition:transform .18s ease; display:flex; flex-direction:column; text-align:center; }
        .college-card:hover { transform:translateY(-6px); }
        .card-icon-area { background:linear-gradient(180deg, rgba(86,28,36,1), rgba(109,41,50,1)); padding:36px 16px; display:flex; align-items:center; justify-content:center; }
        .card-icon { color:var(--accent-beige); font-size:44px; }
        .card-content { padding:22px; flex-grow:1; display:flex; flex-direction:column; justify-content:space-between; }
        .card-content h3 { font-family:var(--font-secondary); font-size:1.2rem; color:var(--primary-maroon); margin-bottom:10px; text-transform:uppercase; letter-spacing:0.6px; }
        .card-content p { font-size:0.95rem; color:var(--text-light); margin-bottom:18px; flex-grow:1; }
        .btn-program { display:inline-block; padding:10px 18px; background-color:var(--bg-cream); color:var(--primary-maroon); border-radius:4px; font-family:var(--font-secondary); font-size:13px; font-weight:700; text-transform:uppercase; border:1px solid var(--bg-cream); width:100%; box-sizing:border-box; }
        .btn-program:hover { background:var(--primary-maroon); color:var(--white); border-color:var(--primary-maroon); }
        .content-layout { display:flex; gap:28px; align-items:flex-start; padding:0 8px; }
        .main-content-area { flex:2; padding-right:8px; }
        .sidebar-area { flex:1; min-width:260px; max-width:320px; background:transparent; padding:0; }

        .main-content-image { width:100%; height:160px; object-fit:cover; display:block; border-radius:6px; border:1px solid #ddd; }

        .link-blocks-container { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:28px; }
        .link-block { padding:12px; background:var(--white); border:1px solid #eee; box-shadow:0 6px 14px rgba(0,0,0,0.03); border-radius:6px; }
        .link-block-title { font-family:var(--font-secondary); font-size:1.05rem; color:var(--primary-maroon); margin-bottom:10px; text-transform:uppercase; }
        .link-block-image { width:100%; height:110px; object-fit:cover; margin-bottom:10px; border-radius:4px; border:1px solid #ccc; }

        .sidebar-block { background:var(--white); margin-bottom:18px; padding:0 0 14px 0; border-radius:6px; overflow:hidden; box-shadow:0 6px 18px rgba(0,0,0,0.03); }
        .sidebar-block h3 { font-family:var(--font-secondary); font-size:1.1rem; color:var(--white); padding:14px 16px; margin:0 0 6px 0; }
        .news-block h3 { background:var(--primary-maroon); }
        .glance-block h3 { background:var(--secondary-red); }
        .college-block h3, .campus-block h3 { background:var(--about-red); }

        .sidebar-news-item { padding:12px 16px; border-top:1px solid #f2f2f2; }
        .news-item-title { font-size:0.98rem; font-weight:700; color:var(--primary-maroon); display:block; margin-bottom:6px; }
        .news-item-meta { font-size:0.82rem; color:var(--text-light); }

        .glance-block ul, .college-block ul, .campus-block ul { padding:6px 20px 16px 20px; list-style:disc; }
        .glance-block li, .college-block li, .campus-block li { margin-bottom:8px; color:var(--text-dark); font-size:0.95rem; }

        @media (max-width:992px) {
            .width-navigation { display:none; }
            .college-grid { grid-template-columns:1fr; }
            .content-layout { flex-direction:column; }
            .sidebar-area { max-width:100%; min-width:100%; }
            .link-blocks-container { grid-template-columns:1fr; }
            .page-header-banner { height:180px; }
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
           <img src="../img/image.png">
            <div class="banner-overlay">
                    <h1>ACADEMIC PROGRAMS</h1>
                <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="academics.php">ACADEMIC PROGRAMS</a>
                </div>
            </div>
        </div>
    </div>
        <div class="main-content-wrapper container">

            <div class="content-layout">

                <div class="main-content-area">

                    <div class="section-heading" style="margin-bottom: 30px;">
                        <h1>Our Academic Colleges</h1>
                        <p>Discover the distinct academic communities that drive innovation and excellence at Meridian Scholars University.</p>
                    </div>

                    <div class="college-grid">
                        <div class="college-card">
                            <div class="card-icon-area">
                                <div class="card-icon"><i class="fa fa-laptop-code"></i></div>
                            </div>
                            <div class="card-content">
                                <h3>College of Computer Studies</h3>
                                <p>Innovating the future through cutting-edge technology, software development, and advanced digital systems.</p>
                                <a href="computer.php" class="btn-program">View Program</a>
                            </div>
                        </div>

                        <div class="college-card">
                            <div class="card-icon-area">
                                <div class="card-icon"><i class="fa fa-chalkboard-teacher"></i></div>
                            </div>
                            <div class="card-content">
                                <h3>College of Education</h3>
                                <p>Shaping the minds of the next generation through excellence in teaching, leadership, and counseling.</p>
                                <a href="educ.php" class="btn-program">View Program</a>
                            </div>
                        </div>

                        <div class="college-card">
                            <div class="card-icon-area">
                                <div class="card-icon"><i class="fa fa-chart-line"></i></div>
                            </div>
                            <div class="card-content">
                                <h3>College of Finance</h3>
                                <p>Mastering the art of wealth management, economic strategy, global markets, and business innovation.</p>
                                <a href="finance.php" class="btn-program">View Program</a>
                            </div>
                        </div>
                                <div class="college-card"></div>
                        <div class="college-card">
                            <div class="card-icon-area">
                                <div class="card-icon"><i class="fa fa-cogs"></i></div>
                            </div>
                            <div class="card-content">
                                <h3>College of Engineering</h3>
                                <p>Designing solutions for a sustainable world through civil, mechanical, and industrial engineering disciplines.</p>
                                <a href="engineering.php" class="btn-program">View Program</a>
                            </div>
                        </div>
                        <div class="college-card"></div>
                    </div>

                    <div class="link-blocks-container" style="margin-top: 36px;">

                        <div class="link-block">
                            <div class="link-block-title">About MSU</div>
                            <img src="../img/aboutmsu.png"  class="link-block-image" alt="About MSU">
                            <ul>
                                <li><a href="../ht/mission.php">Mission, Vision, and Values</a></li>
                                <li><a href="../ht/history.php">History and Accreditations</a></li>
                                <li><a href="../ht/administration.php">Administration and Governance</a></li>
                                <li><a href="../ht/contact.php">Contact Us</a></li>
                                <li><a href="../ht/faculty.php">Faculty & Staff Directory</a></li>
                                <li><a href="../ht/privacy.php">Privacy Policy</a></li>
                            </ul>
                        </div>

                        <div class="link-block">
                            <div class="link-block-title">Admission</div>
                            <img src="../img/shakinghands.png" class="link-block-image" alt="Admission">
                            <ul>
                                <li><a href="applicant_req.php">Application Requirements & Process Page</a></li>
                                <li><a href="../ht/scholarship.php">Tuition & Financial Aid</a></li>
                                <li><a href="../register.php">Online Application Form</a></li>
                            </ul>
                        </div>

                        <div class="link-block">
                            <div class="link-block-title">College Programs</div>
                            <img src="../img/flag.png" class="link-block-image" alt="Programs">
                            <ul>
                                <li><a href="engineering.php">College of Engineering</a></li>
                                <li><a href="finance.php">College of Finance</a></li>
                                <li><a href="computer.php">College of Computer Studies</a></li>
                                <li><a href="educ.php">College of Education</a></li>
                            </ul>
                        </div>

                        <div class="link-block">
                            <div class="link-block-title">Campus Life</div>
                            <img src="../img/campus.jfif" class="link-block-image" alt="Campus Life">
                            <ul>
                                <li><a href="organizations.php">Student Organizations</a></li>
                                <li><a href="sports.php">Sports / Athletics</a></li>
                                <li><a href="news.php">News</a></li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="sidebar-area">

                    <div class="sidebar-block news-block">
                        <h3>MSU NEWS</h3>
                        <div class="sidebar-news-item">
                            <a href="news1.php" class="news-item-title">MSU becomes 3rd top performing university in the country</a>
                            <p class="news-item-meta">November 4, 2025</p>
                        </div>
                        <div class="sidebar-news-item">
                            <a href="news2.php" class="news-item-title">MSU GOES INTERNATIONAL</a>
                            <p class="news-item-meta">November 18, 2025</p>
                        </div>
                        <div class="sidebar-news-item">
                            <a href="news3.php" class="news-item-title">MSU COMMENCES 49TH FOUNDING ANNIVERSARY</a>
                            <p class="news-item-meta">November 18, 2025</p>
                        </div>
                    </div>

                    <div class="sidebar-block glance-block">
                        <h3>MSU AT A GLANCE</h3>
                        <img src="../img/sidebar.png" class="main-content-image" style="height:100px; border:none; margin:10px;" alt="MSU at a glance">
                        <ul>
                            <li>MSU is a premier scholars-exclusive university located in Metro Manila, at the center of a vibrant cultural and rich academic district.</li>
                            <li>MSU is recognized for its rigorous academic training, internationally aligned programs, and highly skilled research output, producing top-tier leaders and innovators.</li>
                            <li>As of 2025, MSU maintains a highly favorable student-to-faculty ratio, ensuring personalized mentorship and outstanding academic guidance.</li>
                        </ul>
                    </div>

                    <div class="sidebar-block college-block">
                        <h3>COLLEGES</h3>
                       <ul>
                        <li><a href="engineering.php">College of Engineering</a></li>
                        <li><a href="finance.php">College of Finance</a></li>
                        <li><a href="computer.php">College of Computer Studies</a></li>
                        <li><a href="educ.php">College of Education</a></li>
                        </ul>
                    </div>
                    <div class="sidebar-block campus-block">
                        <h3>CAMPUS LIFE</h3>
                        <ul>
                            <li><a href="campuslife.php">Student Organizations</a></li>
                            <li><a href="campuslife.php">Sports / Athletics</a></li>
                            <li><a href="campuslife.php">News</a></li>
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