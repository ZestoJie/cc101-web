<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meridian University | Portal Selection</title>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">
    <style>
        :root {
            --primary-maroon: #741b1b;
            --secondary-red: #a82828;
        }

        body { margin: 0; font-family: 'Open Sans', sans-serif; }
        .popup-container {
            height: calc(100vh - 40px);
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0,0,0,0.4);
        }

        .popup-box {
            align-items: center;
            background: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        .popup-box h2 {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            margin-bottom: 25px;
            color: var(--primary-maroon);
        }

        .popup-btn {
            font-size: 30px;
            display: block;
            background: var(--secondary-red);
            color: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .popup-btn:hover {
            background: var(--primary-maroon);
        }

        .site-footer {
            text-align:center;
            padding: 10px;
            background: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="popup-container">
    <div class="popup-box">
        <h2>Select Portal</h2>
        <a href="login.php" class="popup-btn">Student / Faculty Module</a>
        <a href="register.php" class="popup-btn">Applicant Module</a>
        <a href="home.php" class="popup-btn">School Site</a>
    </div>
</div>

<footer class="site-footer">
    © 2025 Meridian University
</footer>

</body>
</html>