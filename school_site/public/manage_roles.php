<?php
session_start();
include "../includes/auth.php";
include "../includes/config.php";

$user = $_SESSION['user'];

// Only Admin (role_id = 4)
if ((int)$user['role_id'] !== 4) {
    $_SESSION['error'] = 'Access denied. Admins only.';
    header('Location: student_dashboard.php');
    exit;
}

// Fetch all users
$users = $conn->query("SELECT id, fullname, email, role_id FROM users ORDER BY role_id ASC, fullname ASC");

$roles = [
    1 => "Applicant",
    2 => "Student",
    3 => "Faculty",
    4 => "Admin"
];
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage User Roles</title>
<style>
    body { font-family: Poppins, sans-serif; background: #eef0ff; margin: 0; }
    header { background: #781a1a; color: #fff; padding: 15px; text-align: center; font-size: 24px; }
    .container {
        width: 80%; margin: 30px auto; background: #fff;
        padding: 25px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,.1);
    }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
    th { background: #781a1a; color: white; }
    select { padding: 6px; border-radius: 6px; }
    .button {
        display: inline-block; padding: 10px 15px; background: #781a1a; color: #fff;
        border-radius: 6px; text-decoration: none; font-weight: bold; margin-top: 20px;
    }
    .button:hover { background: #9c323e; }
</style>
</head>
<body>

<header>Manage User Roles</header>

<div class="container">
<h2>All Users</h2>
<p>Select a new role to update a user.</p>

<table>
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Current Role</th>
        <th>Change Role</th>
    </tr>

    <?php while($u = $users->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($u['fullname']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= $roles[$u['role_id']] ?></td>
        <td>
            <form action="update_role.php" method="POST">
                <input type="hidden" name="id" value="<?= $u['id'] ?>">

                <select name="role_id">
                    <?php foreach ($roles as $key => $label): ?>
                        <option value="<?= $key ?>" <?= $u['role_id'] == $key ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" style="padding:6px 12px;">Save</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>

</table>

<a href="admin_dashboard.php" class="button">Back to Dashboard</a>

</div>

</body>
</html>
