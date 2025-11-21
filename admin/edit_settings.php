<?php
require_once '../functions.php';
check_login();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        update_setting($key, $value);
    }
    $message = "Settings updated successfully!";
}

$settings_keys = [
    'site_title', 'header_logo_part1', 'header_logo_part2',
    'hero_title_prefix', 'hero_title_name', 'hero_description',
    'about_title', 'about_subtitle', 'about_detailed_title', 'about_detailed_text',
    'contact_email', 'contact_phone', 'contact_linkedin', 'contact_github', 'contact_whatsapp',
    'footer_text', 'footer_copyright'
];

$current_settings = [];
foreach ($settings_keys as $key) {
    $current_settings[$key] = get_setting($key);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Settings</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="admin-container">
        <a href="index.php" class="nav-back">&larr; Back to Dashboard</a>
        <h1>Edit Site Settings</h1>

        <?php if ($message): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <h2>General</h2>
            <div class="form-group">
                <label>Site Title</label>
                <input type="text" name="site_title" value="<?php echo htmlspecialchars($current_settings['site_title']); ?>">
            </div>
            <div class="form-group">
                <label>Logo Part 1 (White)</label>
                <input type="text" name="header_logo_part1" value="<?php echo htmlspecialchars($current_settings['header_logo_part1']); ?>">
            </div>
            <div class="form-group">
                <label>Logo Part 2 (Color)</label>
                <input type="text" name="header_logo_part2" value="<?php echo htmlspecialchars($current_settings['header_logo_part2']); ?>">
            </div>

            <h2>Hero Section</h2>
            <div class="form-group">
                <label>Title Prefix</label>
                <input type="text" name="hero_title_prefix" value="<?php echo htmlspecialchars($current_settings['hero_title_prefix']); ?>">
            </div>
            <div class="form-group">
                <label>Title Name</label>
                <input type="text" name="hero_title_name" value="<?php echo htmlspecialchars($current_settings['hero_title_name']); ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="hero_description"><?php echo htmlspecialchars($current_settings['hero_description']); ?></textarea>
            </div>

            <h2>About Section</h2>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="about_title" value="<?php echo htmlspecialchars($current_settings['about_title']); ?>">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="about_subtitle" value="<?php echo htmlspecialchars($current_settings['about_subtitle']); ?>">
            </div>
            <div class="form-group">
                <label>Detailed Title</label>
                <input type="text" name="about_detailed_title" value="<?php echo htmlspecialchars($current_settings['about_detailed_title']); ?>">
            </div>
            <div class="form-group">
                <label>Detailed Text (HTML allowed)</label>
                <textarea name="about_detailed_text" style="height: 200px;"><?php echo htmlspecialchars($current_settings['about_detailed_text']); ?></textarea>
            </div>

            <h2>Contact Info</h2>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="contact_email" value="<?php echo htmlspecialchars($current_settings['contact_email']); ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="contact_phone" value="<?php echo htmlspecialchars($current_settings['contact_phone']); ?>">
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="text" name="contact_linkedin" value="<?php echo htmlspecialchars($current_settings['contact_linkedin']); ?>">
            </div>
            <div class="form-group">
                <label>GitHub URL</label>
                <input type="text" name="contact_github" value="<?php echo htmlspecialchars($current_settings['contact_github']); ?>">
            </div>
            <div class="form-group">
                <label>WhatsApp URL</label>
                <input type="text" name="contact_whatsapp" value="<?php echo htmlspecialchars($current_settings['contact_whatsapp']); ?>">
            </div>

            <h2>Footer</h2>
            <div class="form-group">
                <label>Footer Text</label>
                <textarea name="footer_text"><?php echo htmlspecialchars($current_settings['footer_text']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Copyright Text</label>
                <input type="text" name="footer_copyright" value="<?php echo htmlspecialchars($current_settings['footer_copyright']); ?>">
            </div>

            <button type="submit">Save Settings</button>
        </form>
    </div>
</body>
</html>
