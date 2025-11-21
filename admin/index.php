<?php
require_once '../functions.php';
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="admin-container">
        <header>
            <h1>Dashboard</h1>
            <div class="user-info">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> |
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <div class="dashboard-grid">
            <div class="card">
                <h3>Site Settings</h3>
                <p>Edit titles, descriptions, and contact info.</p>
                <a href="edit_settings.php" class="btn">Edit Settings</a>
            </div>
            <div class="card">
                <h3>Experience</h3>
                <p>Manage work experience entries.</p>
                <a href="manage_section.php?section=experience" class="btn">Manage Experience</a>
            </div>
            <div class="card">
                <h3>Education</h3>
                <p>Manage education entries.</p>
                <a href="manage_section.php?section=education" class="btn">Manage Education</a>
            </div>
            <div class="card">
                <h3>Achievements</h3>
                <p>Manage achievements.</p>
                <a href="manage_section.php?section=achievements" class="btn">Manage Achievements</a>
            </div>
            <div class="card">
                <h3>Certifications</h3>
                <p>Manage certifications.</p>
                <a href="manage_section.php?section=certifications" class="btn">Manage Certifications</a>
            </div>
            <div class="card">
                <h3>Skills</h3>
                <p>Manage skills list.</p>
                <a href="manage_section.php?section=skills" class="btn">Manage Skills</a>
            </div>
        </div>
    </div>
</body>
</html>
