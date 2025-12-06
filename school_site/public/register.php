<?php
session_start();
include "../includes/config.php";

function generateStudentID() {
    return rand(10, 99) . "-" . rand(1000, 9999);
}

$MAX_FILE_SIZE = 5 * 1024 * 1024;
$ALLOWED_EXT = ['pdf', 'jpg', 'jpeg', 'png'];
$ALLOWED_MIME = [
    'application/pdf',
    'image/jpeg',
    'image/png'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $raw_password = $_POST['password'] ?? '';

    $program = $_POST['program'] ?? '';
    $course  = $_POST['course'] ?? '';

    $form138_data = null;
    $form138_name = null;
    $goodmoral_data = null;
    $goodmoral_name = null;

    if ($fullname === '' || $email === '' || strlen($raw_password) < 8) {
        $_SESSION['error'] = 'Please complete the required fields correctly.';
        header("Location: register.php");
        exit;
    }

    if ($program === '' || $course === '') {
        $_SESSION['error'] = 'Please select a Program and Course.';
        header("Location: register.php");
        exit;
    }

    if (!empty($_FILES['form138']) && $_FILES['form138']['error'] !== UPLOAD_ERR_NO_FILE) {
        $f = $_FILES['form138'];
        if ($f['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "Error uploading Form 138: " . $f['error'];
            header("Location: register.php");
            exit;
        }
        if ($f['size'] > $MAX_FILE_SIZE) {
            $_SESSION['error'] = "Form 138 exceeds maximum size of 5MB.";
            header("Location: register.php");
            exit;
        }
        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $f['tmp_name']);
        finfo_close($finfo);

        if (!in_array($ext, $ALLOWED_EXT) || !in_array($mime, $ALLOWED_MIME)) {
            $_SESSION['error'] = "Form 138 must be a PDF or image (jpg, png).";
            header("Location: register.php");
            exit;
        }

        $form138_data = file_get_contents($f['tmp_name']);
        $form138_name = basename($f['name']);
    }

    if (!empty($_FILES['goodmoral']) && $_FILES['goodmoral']['error'] !== UPLOAD_ERR_NO_FILE) {
        $g = $_FILES['goodmoral'];
        if ($g['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "Error uploading Good Moral Certificate: " . $g['error'];
            header("Location: register.php");
            exit;
        }
        if ($g['size'] > $MAX_FILE_SIZE) {
            $_SESSION['error'] = "Good Moral Certificate exceeds maximum size of 5MB.";
            header("Location: register.php");
            exit;
        }
        $ext = strtolower(pathinfo($g['name'], PATHINFO_EXTENSION));
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $g['tmp_name']);
        finfo_close($finfo);

        if (!in_array($ext, $ALLOWED_EXT) || !in_array($mime, $ALLOWED_MIME)) {
            $_SESSION['error'] = "Good Moral must be a PDF or image (jpg, png).";
            header("Location: register.php");
            exit;
        }

        $goodmoral_data = file_get_contents($g['tmp_name']);
        $goodmoral_name = basename($g['name']);
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        $_SESSION['error'] = 'An account with that email already exists.';
        header("Location: register.php");
        exit;
    }

    $student_id = generateStudentID();
    $tries = 0;

    while ($tries < 10) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows === 0) break;
        $student_id = generateStudentID();
        $tries++;
    }

    if ($tries >= 10) {
        $_SESSION['error'] = 'Failed to generate Student ID.';
        header("Location: register.php");
        exit;
    }

    $password_hash = password_hash($raw_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (student_id, fullname, email, password, role_id, passed)
         VALUES (?, ?, ?, ?, 1, 0)"
    );
    $stmt->bind_param("ssss", $student_id, $fullname, $email, $password_hash);

    if ($stmt->execute()) {

        $_SESSION['success'] = "Application Successful! Your ID is: $student_id";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Registration failed.";
        header("Location: register.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration (Simulation)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background: #f6f6f6;
            font-family: Poppins, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,.1);
        }
        h2 { text-align: center; color: #781a22; }
        h3 {
            margin-top: 25px;
            color: #781a22;
            border-left: 4px solid #781a22;
            padding-left: 8px;
        }
        .form-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        label { font-weight: 600; }
        .btn {
            background: #781a22;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover { background: #9c1f2a; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 10px; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; }
        a { color: #781a22; }

        small.hint { display:block; margin-top:6px; color:#666; font-size:13px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Application Form</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Note enctype added -->
    <form action="register.php" method="POST" enctype="multipart/form-data">

        <h3>Program Choice</h3>
        <div class="form-section">
            <div class="form-group">
                <label>Program *</label>
                <select name="program" id="program" required>
                    <option value="">Select Program</option>
                    <option>College of Computer Studies</option>
                    <option>College of Education</option>
                    <option>College of Engineering</option>
                    <option>College of Finance</option>
                </select>
            </div>

            <div class="form-group">
                <label>Course *</label>
                <select name="course" id="course" required>
                    <option value="">Select Course</option>
                </select>
            </div>
        </div>

        <h3>Personal Information</h3>
        <div class="form-section">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender">
                    <option value="">Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Prefer not to say</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact">
            </div>
            <div class="form-group">
                <label>Home Address</label>
                <input type="text" name="home_address">
            </div>
            <div class="form-group">
                <label>Emergency Contact</label>
                <input type="text" name="emergency_contact">
            </div>
            <div class="form-group" style="grid-column: span 2;">
                <label>Email Address *</label>
                <input type="email" name="email" required>
            </div>
        </div>

        <h3>Academic Information</h3>
        <div class="form-section">
            <div class="form-group">
                <label>Last School Attended</label>
                <input type="text" name="last_school">
            </div>

            <div class="form-group">
                <label>Grade Level Completed</label>
                <input type="text" name="grade_level">
            </div>

            <div class="form-group">
                <label>General Average / GPA</label>
                <input type="text" name="gpa">
            </div>
        </div>

        <h3>Verify Documents (Upload)</h3>
        <div class="form-section">
            <div class="form-group">
                <label>Form 138 / Transcript of Records</label>
                <input type="file" name="form138" accept=".pdf,image/*">
                <small class="hint">Allowed: pdf, jpg, jpeg, png — max 5MB.</small>
            </div>

            <div class="form-group">
                <label>Good Moral Certificate</label>
                <input type="file" name="goodmoral" accept=".pdf,image/*">
                <small class="hint">Allowed: pdf, jpg, jpeg, png — max 5MB.</small>
            </div>
        </div>

        <h3>Account Details</h3>
        <div class="form-section">
            <div class="form-group" style="grid-column: span 2;">
                <label>Password *</label>
                <input type="password" name="password" minlength="8" required>
            </div>
        </div>

        <button class="btn" type="submit">Submit Application</button>
    </form>

    <p style="text-align:center; margin-top:20px;">
        Already have an account? <a href="login.php">Login here</a>
    </p>
</div>

<script>
const programSelect = document.getElementById("program");
const courseSelect = document.getElementById("course");

const courses = {
    "College of Computer Studies": [
        "BS in Computer Science",
        "BS in Information Technology",
        "BS in Information Systems"
    ],
    "College of Education": [
        "Bachelor of Elementary Education",
        "Bachelor of Secondary Education",
        "Bachelor of Special Needs Education"
    ],
    "College of Finance": [
        "BS in Accountancy",
        "BS in Financial Management",
        "BS in Business Administration"
    ],
    "College of Engineering": [
        "BS in Industrial Engineering",
        "BS in Electrical Engineering",
        "BS in Computer Engineering"
    ]
};

programSelect.addEventListener("change", function () {
    const selected = this.value;
    courseSelect.innerHTML = '<option value="">Select Course</option>';

    if (courses[selected]) {
        courses[selected].forEach(course => {
            const opt = document.createElement("option");
            opt.value = course;
            opt.textContent = course;
            courseSelect.appendChild(opt);
        });
    }
});
</script>

</body>
</html>
