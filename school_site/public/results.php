    <?php

    session_start();
    include "../includes/auth.php"; 
    include "../includes/config.php";
    $user = $_SESSION['user'];

    $id = $user['id'];
    $query = $conn->query("SELECT passed FROM users WHERE id = $id");
    $row = $query->fetch_assoc();
    $passed = (int)$row['passed'];

    $sys = $conn->query("SELECT results_released FROM system_settings WHERE id = 1")->fetch_assoc();

    if ((int)$sys['results_released'] !== 1) {

        echo "
        <div style='margin:50px auto; width:60%; padding:20px; 
            background:white; border-radius:10px; text-align:center;'>
            <h2>Results Not Yet Released</h2>
            <p>Please wait for the announcement from the administration.</p>
            <a href='applicant_dashboard.php' class='btn'>Back to Dashboard</a>
        </div>";
        exit;
    }

    ?>


    <!DOCTYPE html>
    <html>
    <head>
    <title>Exam Results</title>
    <style>
        body { font-family: Poppins, sans-serif; padding: 20px; background: #f5f5f5; }
        .box { background: white; padding: 25px; border-radius: 10px; width: 60%; margin: auto; }
        .btn { display: inline-block; padding: 12px 18px; background: #a41024ff; color:white;border-radius:8px;margin-top:20px;text-decoration:none;}
    </style>
    </head>
    <body>

    <div class="box">
        <h2>Entrance Exam Results</h2>

        <?php if ($passed === 0): ?>
            <p>You did not pass the entrance exam.</p>
            <p>Please try again next intake.</p>
            <a href="applicant_dashboard.php" class="button">Back to Dashboard</a>

        <?php else: ?>
            <p><strong>Congratulations!</strong> You passed the exam.</p>
            <a href="generate_id.php" class="btn">Generate Student ID</a>
        <?php endif; ?>

    </div>

    </body>
    </html>
