<?php
session_start();
include "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $identity = trim($_POST['identity'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($identity === '' || $password === '') {
        $_SESSION['error'] = "Please provide ID/email and password.";
        header("Location: index.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT id, student_id, fullname, email, password, role_id FROM users WHERE student_id = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $identity, $identity);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = [
                'id' => $user['id'],
                'student_id' => $user['student_id'],
                'fullname' => $user['fullname'],
                'email' => $user['email'],
                'role_id' => $user['role_id']
            ];

            $_SESSION['success'] = "Welcome back, " . $user['fullname'];

            if ((int)$user['role_id'] === 1) {
                header("Location: applicant_dashboard.php");
            } 
            else if( (int)$user['role_id'] === 2) {
                header("Location: student_dashboard.php");
            }
            else if( (int)$user['role_id'] === 3) {
                header("Location: faculty_dashboard.php");
            }
            else if( (int)$user['role_id'] === 4) {
                header("Location: admin_dashboard.php");
            }
            exit;
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "No student found with that ID or email.";
    }

    header("Location: index.php");
    exit;
}
?>

<?php
$flash = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);

$user = $_SESSION['user'] ?? null;

if ($user) {
    switch ((int)$user['role_id']) {
        case 1: header("Location: applicant_dashboard.php"); exit;
        case 2: header("Location: student_dashboard.php"); exit;
        case 3: header("Location: faculty_dashboard.php"); exit;
        case 4: header("Location: admin_dashboard.php"); exit;
        default: header("Location: home.php"); exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meridian University | Login</title>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">
    <link rel="stylesheet" href = "styles/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
</head>
<style>
.quick-links {
    background: white;
    border-radius: 12px;
    margin: 90px auto;
    padding: 50px 50px;
    max-width: 480px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    text-align: center;
}

.quick-links h2 {
    font-size: 2rem;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    letter-spacing: 1px;
}

form label {
    width: 430px;
    margin-left: 25px;
    font-weight: bold;
    color: #333;
    text-align: left;
    display: block;
}

form input {
    margin-left: 25px;
    padding: 12px;
    border: 1px solid #bbb;
    border-radius: 6px;
    font-size: 1rem;
    width: 430px;
}

form input:focus {
    outline: none;
    border-color: var(--primary-maroon);
    box-shadow: 0 0 4px rgba(128, 0, 0, 0.5);
}

form div {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

button {
    margin: 25px auto;
    padding: 12px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn-primary {
    background: black;
    color: white;
}

.btn-primary:hover {
    background: #660000;
}

.btn-secondary {
    background: #ddd;
}

.btn-secondary:hover {
    background: #bbb;
}

.quick-links a {
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    margin-top: 10px;
    transition: 0.3s;
}

.quick-links a:hover {
    text-decoration: underline;
}

p[style*="color:green"] {
    background: #eaffea;
    padding: 10px;
    border-radius: 6px;
    color: green;
}

p[style*="color:red"] {
    background: #ffeaea;
    padding: 10px;
    border-radius: 6px;
    color: red;
}

</style>
<body>
<header class="site-header">
    <div class="container thim-nav-wrapper">
        <div class="row">
            <div class="navigation col-sm-12">
                <div class="tm-table">

                    <div class="width-logo table-cell sm-logo">
                        <a href="index.php">
                            <img src="img/logo.png" alt="Meridian Scholars University" style="max-height:65px;">
                        </a>
                        <div class="logo-text">
                            <h1>Meridian Scholars University</h1>
                            <span>Honing The Future Scholars</span>
                        </div>
                    </div>

                    <nav class="width-navigation table-cell table-right">
                        <ul class="nav navbar-nav menu-main-menu" style="display: flex; gap: 25px;">
                <?php if ($user): ?>
                    <li class="tc-menu-item">
                        <a href="<?= $dashboardLink ?>">Dashboard</a>
                    </li>
                    <li class="tc-menu-item">
                        <a href="logout.php" style="color:#ffdddd;">Logout</a>
                    </li>
                <?php endif; ?>
                            <li class="tc-menu-item">
                                <a href="index.php">Index Page</a>
                            </li>

                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</header>

<section class="quick-links fade-in" style="padding:60px 0;">
    <div class="container" style="max-width:500px;">

        <?php if ($flash): ?>
            <p style="color:green; font-weight:bold;"><?= htmlspecialchars($flash) ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p style="color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <h2 style="font-family:var(--ff-secondary); text-transform:uppercase; color:var(--primary-maroon); text-align:center; margin-bottom:22px;">
            Login
        </h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" 
      style="display:flex; flex-direction:column; gap:14px;">

    <label for="identity">ID or Email:</label>
    <input type="text" name="identity" placeholder="XX-XXXX or email@example.com" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" minlength="8" placeholder="Password" required>

    <div style="margin: 25px; display:flex; gap: 12px;">
        <button type="reset" class="btn btn-secondary" style="flex:1;">Clear</button>
        <button type="submit" class="btn btn-primary" style="flex:1;">Login</button>
    </div>

</form>
        <p style="margin-top:18px; text-align:center;">
            <a href="register.php" style="color:var(--secondary-red); font-weight:bold;">Apply as a Student</a>
        </p>

        <p style="text-align:center;">
            <a href="home.php" style="color:var(--secondary-red); font-weight:bold;">Go to Homepage</a>
        </p>

    </div>
</section>

<footer class="site-footer">
    <div class="footer-content">
        <div>
            <p style="text-align:center;">© 2025 Meridian University</p>
        </div>
    </div>
</footer>

</body>
</html>
