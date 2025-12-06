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
    <body>
        <style>
            .news-article-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    font-family: "Open Sans", sans-serif;
}

.back {
    margin-bottom: 10px;
}

.back-link {
    color: #3366cc;
    text-decoration: none;
    font-weight: 600;
}

.article-header {
    text-align: center;
    margin-bottom: 30px;
}

.article-photo {
    width: 100%;
    height: 400px;
    background: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-bottom: 20px;
    border-radius: 8px;
}

.article-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
}

.article-author {
    color: #555;
    margin-bottom: 20px;
}

.article-content p {
    line-height: 1.7;
    margin-bottom: 15px;
    text-align: justify;
}

.article-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.next-article {
    color: #3366cc;
    text-decoration: none;
    font-weight: 600;
}

        </style>
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
    <div id="main-content" class="news-article-container">

    <div class="back">
        <a href="organizations.php" class="back-link">
            &lt; Return to MSU Orgs
        </a>
    </div>

    <div class="article-header">
        <h1 class="article-title">
            MSU clenches the goal, FEU falls
        </h1>
    </div>

    <div class="article-content">
       The Meridian Student Parliament (MSP) is the highest governing student body of the university, dedicated to representing the collective voice, concerns, 
       and aspirations of the student community. As a legislative and policy-making organization, MSP plays a vital role in promoting student welfare and 
       ensuring that every learner is given the opportunity to thrive in an environment that supports growth, inclusivity, and academic success. It serves 
       as a bridge between students and the administration, fostering open communication and meaningful collaboration in addressing campus issues and 
       implementing student-centered initiatives.
        <br>
        <br>
        The Parliament is composed of student leaders who are elected to uphold accountability, transparency, and integrity in all its decisions and actions. Through regular sessions, 
        consultations, and forums, MSP provides a democratic space where student perspectives are heard, debated, and translated into programs that benefit 
        the entire campus community. The organization champions projects related to campus safety, academic support, student rights, and overall campus 
        development. It also organizes leadership training, policy-writing workshops, and civic engagement activities to empower students to participate 
        actively in governance.
        <br>
        <br>
        Beyond its legislative responsibilities, the Meridian Student Parliament seeks to cultivate responsible and service-oriented leaders. Members 
        are encouraged to practice ethical leadership, critical thinking, and effective communication—skills that not only strengthen student governance 
        but also prepare them for future roles in society. MSP also values solidarity and strives to bring students together through events that promote 
        unity, awareness, and student empowerment.
    </div>
    <div class="article-navigation">
        <div></div>
        <a href="org5.php" class="next-article">&lt; Back</a>
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