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
    <title>University Faculty - Meridian Scholars University</title>
    <link rel="stylesheet" href="Eme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
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
                                    <div class="logo-text" style="text-align: left;">
                                        <h1>Meridian Scholars University</h1>
                                        <span >Honing The Future Scholars</span>
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
                    <h1>UNIVERSITY FACULTY</h1>
                <div class="breadcrumbs">
                        <a href="../home.php">HOME</a> • <a href="admissions.php">ABOUT US</a> • FACULTY
                </div>
            </div>
        </div>
    </section>

    <main class="faculty-directory container">

        <section class="college-section">
            <h3 class="college-title">College Of Computer Studies</h3>
            <div class="faculty-grid">
                <div class="faculty-card">
                    <img src="../img/aa.jpg" alt="Dr. John Dens" class="faculty-photo">
                    <p class="faculty-name">Dr. John Dens</p>
                    <p class="faculty-title">Assistant Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/aB.jpg" alt="Vih Lino" class="faculty-photo">
                    <p class="faculty-name">Vih Lino</p>
                    <p class="faculty-title">Software Engineer</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ac.jpg" alt="Dennis Wang" class="faculty-photo">
                    <p class="faculty-name">Dennis Wang, Ph.D.</p>
                    <p class="faculty-title">Associate Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ad.jpg" alt="Xavier Lee" class="faculty-photo">
                    <p class="faculty-name">Xavier Lee, B.Sc in Data</p>
                    <p class="faculty-title">Assistant Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/harr.jpg" alt="Dr. Alice Nguyen" class="faculty-photo">
                    <p class="faculty-name">Dr. Alic Nguyen, B.Sc</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/jos.jpg" alt="Ms. Maria Lopez" class="faculty-photo">
                    <p class="faculty-name">Mr. Mario Lopez, B.Tech in IT</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/xav.jpg" alt="Dr. David Kim" class="faculty-photo">
                    <p class="faculty-name">Dr. David Kim, Ph.D.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/xv.jpg" alt="Mr. Ethan Brown" class="faculty-photo">
                    <p class="faculty-name">Mr. Ethan Brown, M.Sc</p>
                    <p class="faculty-title">Assistant Prof.</p>
                </div>
            </div>
        </section>

        <hr>

        <section class="college-section">
            <h3 class="college-title">College Of Education</h3>
            <div class="faculty-grid">
                <div class="faculty-card">
                    <img src="../img/Anton.jpg" alt="Dr. Laura White" class="faculty-photo">
                    <p class="faculty-name">Dr Anton Rodriquez, Ed.D</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/Art.jpg" alt="Mr. Michael Davis" class="faculty-photo">
                    <p class="faculty-name">Mr. Michael Davis, B.Ed</p>
                    <p class="faculty-title">Associate Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/Dam.jpg" alt="Mr. James Patel" class="faculty-photo">
                    <p class="faculty-name">Mr. James Patel, B.A</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/Jen.jpg" alt="Ms. Eim Chan" class="faculty-photo">
                    <p class="faculty-name">Ms. Eim Chan, M.Ed</p>
                    <p class="faculty-title">Assistant Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/RObert.jpg" alt="Mr. William Brown" class="faculty-photo">
                    <p class="faculty-name">Mr. William Brown, M.Ed.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/toby.jpg" alt="Mr. Anthony Harris" class="faculty-photo">
                    <p class="faculty-name">Mr. Anthony Harris, B.A</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/TOm.jpg" alt="Mr. Benjamin Nguyen" class="faculty-photo">
                    <p class="faculty-name">Mr. Benjamin Nguyen, B.A</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/do.jpg" alt="Mr. Benjamin Nguyen" class="faculty-photo">
                    <p class="faculty-name">Mr. Joshua Montejo, B.A</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card empty-card"></div> 
            </div>
        </section>

        <hr>

        <section class="college-section">
            <h3 class="college-title">College Of Engineering</h3>
            <div class="faculty-grid">
                <div class="faculty-card">
                    <img src="../img/da.jpg" alt="Dr. Laura White" class="faculty-photo">
                    <p class="faculty-name">Dr Ant Rod, Engr.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/de.jpg" alt="Mr. Michael Davis" class="faculty-photo">
                    <p class="faculty-name">Mr. Rimuru Tempes, Electr Engr.</p>
                    <p class="faculty-title">Associate Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/di.jpg" alt="Mr. James Patel" class="faculty-photo">
                    <p class="faculty-name">Mr.Not Pa, Chem Engr</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/eo.jpg" alt="Ms. Eim Chan" class="faculty-photo">
                    <p class="faculty-name">Mr. Den Chan, Prof Engr.</p>
                    <p class="faculty-title">Assistant Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/du.jpg" alt="Mr. William Brown" class="faculty-photo">
                    <p class="faculty-name">Mr. Whity Mex, Sr. Engr.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ea.jpg" alt="Mr. Anthony Harris" class="faculty-photo">
                    <p class="faculty-name">Mr. Patrick Canlas, Chief Engr.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ee.jpg" alt="Mr. Benjamin Nguyen" class="faculty-photo">
                    <p class="faculty-name">Mr. Reiziah Torres, Jr. Engr.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ei.jpg" alt="Mr. Andrew Wilson" class="faculty-photo">
                    <p class="faculty-name">Mr. Andrew Tate, Proj Eng.</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card empty-card"></div> 
            </div>
        </section>
        <hr>

        <section class="college-section">
            <h3 class="college-title">College Of Financial Literacy</h3>
            <div class="faculty-grid">
                <div class="faculty-card">
                    <img src="../img/ba.jpg" alt="Mr. Andrew Wilson" class="faculty-photo">
                    <p class="faculty-name">Mr. Andrew Wilson, CFP</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/be.jpg" alt="Dr. Samir Khan" class="faculty-photo">
                    <p class="faculty-name">Dr. Samir Khan, Ph.D</p>
                    <p class="faculty-title">Associate Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/bi.jpg" alt="Mr. Kevin Johnson" class="faculty-photo">
                    <p class="faculty-name">Ms. Kelci Johnson, MBA</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/bo.jpg" alt="Mr. Harriet Harris" class="faculty-photo">
                    <p class="faculty-name">Ms. Harriet Harris, M.S</p>
                    <p class="faculty-title">Associate Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/co.jpg" alt="Mr. Matthew Jones" class="faculty-photo">
                    <p class="faculty-name">Ms. Matty Jones, CFA</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ca.jpg" alt="Mr. Brian Davis" class="faculty-photo">
                    <p class="faculty-name">Mr. Brian Davis, CFP</p>
                    <p class="faculty-title">Instructor</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/ce.jpg" alt="Mr. Joshua Carter" class="faculty-photo">
                    <p class="faculty-name">Mr. Joshua Carter, B.A</p>
                    <p class="faculty-title">Associate Prof.</p>
                </div>
                <div class="faculty-card">
                    <img src="../img/cu.jpg" alt="Mr. Christopher Miller" class="faculty-photo">
                    <p class="faculty-name">Mr. Christopher Miller, MBA</p>
                    <p class="faculty-title">Instructor</p>
                </div>
            </div>
        </section>

    </main>

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