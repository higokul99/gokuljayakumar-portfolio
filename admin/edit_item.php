<?php
require_once '../functions.php';
check_login();

$section = isset($_GET['section']) ? $_GET['section'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

$valid_sections = ['experience', 'education', 'achievements', 'certifications', 'skills'];

if (!in_array($section, $valid_sections) || !$id) {
    header("Location: index.php");
    exit();
}

// Fetch Item
$stmt = $conn->prepare("SELECT * FROM $section WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    header("Location: manage_section.php?section=$section");
    exit();
}

// Update is handled in manage_section.php logic, but we can reuse the form or submit to manage_section.php
// It's easier to just make this form submit to manage_section.php with a hidden ID field.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="admin-container">
        <a href="manage_section.php?section=<?php echo $section; ?>" class="nav-back">&larr; Back to List</a>
        <h1>Edit Item</h1>

        <form action="manage_section.php?section=<?php echo $section; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">

            <?php if ($section == 'experience'): ?>
                <div class="form-group"><label>Date Range</label><input type="text" name="date_range" value="<?php echo htmlspecialchars($item['date_range']); ?>" required></div>
                <div class="form-group"><label>Title</label><input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required></div>
                <div class="form-group"><label>Company</label><input type="text" name="company" value="<?php echo htmlspecialchars($item['company']); ?>" required></div>
                <div class="form-group"><label>Description (HTML)</label><textarea name="description"><?php echo htmlspecialchars($item['description']); ?></textarea></div>
            <?php elseif ($section == 'education'): ?>
                <div class="form-group"><label>Date Range</label><input type="text" name="date_range" value="<?php echo htmlspecialchars($item['date_range']); ?>" required></div>
                <div class="form-group"><label>Degree</label><input type="text" name="degree" value="<?php echo htmlspecialchars($item['degree']); ?>" required></div>
                <div class="form-group"><label>School</label><input type="text" name="school" value="<?php echo htmlspecialchars($item['school']); ?>" required></div>
                <div class="form-group"><label>Score</label><input type="text" name="score" value="<?php echo htmlspecialchars($item['score']); ?>"></div>
            <?php elseif ($section == 'achievements'): ?>
                <div class="form-group"><label>Title</label><input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required></div>
                <div class="form-group"><label>Description</label><textarea name="description" required><?php echo htmlspecialchars($item['description']); ?></textarea></div>
            <?php elseif ($section == 'certifications'): ?>
                <div class="form-group"><label>Title</label><input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required></div>
                <div class="form-group"><label>Issuer</label><input type="text" name="issuer" value="<?php echo htmlspecialchars($item['issuer']); ?>" required></div>
                <div class="form-group"><label>Description</label><textarea name="description"><?php echo htmlspecialchars($item['description']); ?></textarea></div>
                <div class="form-group"><label>Image URL</label><input type="text" name="image_url" value="<?php echo htmlspecialchars($item['image_url']); ?>"></div>
            <?php elseif ($section == 'skills'): ?>
                <div class="form-group"><label>Skill Name</label><input type="text" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required></div>
            <?php endif; ?>

            <div class="form-group"><label>Order Index</label><input type="number" name="order_index" value="<?php echo $item['order_index']; ?>"></div>
            <button type="submit">Update Item</button>
        </form>
    </div>
</body>
</html>
