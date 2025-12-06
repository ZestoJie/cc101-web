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
    height: 100%;
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
           Rotary Club of Meridian Scholars Universitys
        </h1>

    </div>

    <div class="article-content">
        The Rotary Club of Meridian Scholars University (RC-MSU) is a service-oriented student organization dedicated to fostering leadership, 
        volunteerism, and community involvement among the university’s scholars. Inspired by the global values of Rotary International, the club 
        embodies the principles of “Service Above Self,” encouraging students to use their talents and education to create meaningful change. RC-MSU 
        serves as a platform for young leaders to engage in humanitarian projects, develop professional skills, and cultivate a strong sense of civic 
        responsibility. Through its various initiatives, the organization strives to empower students to become compassionate individuals who make a 
        positive impact both within and beyond the university.
        <br>
        <br>
        The club regularly conducts outreach activities, environmental campaigns, and educational programs that address the needs of surrounding communities. 
        These projects help members understand real-world challenges and inspire them to act with empathy and purpose. RC-MSU also offers leadership 
        training, seminars, and workshops that strengthen communication, teamwork, and project-management skills—qualities essential for future professionals 
        and community leaders. Members are encouraged to collaborate with local Rotary clubs, allowing them to build networks, gain mentorship, and learn 
        from service-driven individuals who share the same mission.
        <br>
        <br>
        Beyond service and leadership, the Rotary Club of Meridian Scholars University promotes values such as integrity, respect, and global 
        understanding. It fosters a culture of inclusivity where students from diverse backgrounds come together to work toward common goals. 
        The organization also emphasizes personal growth by encouraging members to engage in reflective practices, participate in fellowship activities, 
        and maintain a healthy balance between academics and service. Through these efforts, RC-MSU nurtures well-rounded individuals who embody academic 
        excellence, social awareness, and strong moral character.
    </div>

    <div class="article-navigation">
        <div></div>
        <a href="org4.php" class="next-article">&lt; Back</a>
    </div>
    <div class="article-navigation">
        <div></div>
        <a href="org6.php" class="next-article">Next Article &gt;</a>
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