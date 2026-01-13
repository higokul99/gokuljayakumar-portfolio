<?php
require_once '../functions.php';
check_login();

$section = isset($_GET['section']) ? $_GET['section'] : 'experience';
$valid_sections = ['experience', 'education', 'achievements', 'certifications', 'skills'];

if (!in_array($section, $valid_sections)) {
    header("Location: index.php");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM $section WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage_section.php?section=$section");
    exit();
}

// Handle Add/Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if ($section == 'experience') {
        $date_range = $_POST['date_range'];
        $title = $_POST['title'];
        $company = $_POST['company'];
        $description = $_POST['description'];
        $order_index = $_POST['order_index'];

        if ($id) {
            $stmt = $conn->prepare("UPDATE experience SET date_range=?, title=?, company=?, description=?, order_index=? WHERE id=?");
            $stmt->bind_param("ssssii", $date_range, $title, $company, $description, $order_index, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO experience (date_range, title, company, description, order_index) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $date_range, $title, $company, $description, $order_index);
        }
    } elseif ($section == 'education') {
        $date_range = $_POST['date_range'];
        $degree = $_POST['degree'];
        $school = $_POST['school'];
        $score = $_POST['score'];
        $order_index = $_POST['order_index'];

        if ($id) {
            $stmt = $conn->prepare("UPDATE education SET date_range=?, degree=?, school=?, score=?, order_index=? WHERE id=?");
            $stmt->bind_param("ssssii", $date_range, $degree, $school, $score, $order_index, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO education (date_range, degree, school, score, order_index) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $date_range, $degree, $school, $score, $order_index);
        }
    } elseif ($section == 'achievements') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $order_index = $_POST['order_index'];

        if ($id) {
            $stmt = $conn->prepare("UPDATE achievements SET title=?, description=?, order_index=? WHERE id=?");
            $stmt->bind_param("ssii", $title, $description, $order_index, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO achievements (title, description, order_index) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $title, $description, $order_index);
        }
    } elseif ($section == 'certifications') {
        $title = $_POST['title'];
        $issuer = $_POST['issuer'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $order_index = $_POST['order_index'];

        if ($id) {
            $stmt = $conn->prepare("UPDATE certifications SET title=?, issuer=?, description=?, image_url=?, order_index=? WHERE id=?");
            $stmt->bind_param("ssssii", $title, $issuer, $description, $image_url, $order_index, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO certifications (title, issuer, description, image_url, order_index) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $title, $issuer, $description, $image_url, $order_index);
        }
    } elseif ($section == 'skills') {
        $name = $_POST['name'];
        $order_index = $_POST['order_index'];

        if ($id) {
            $stmt = $conn->prepare("UPDATE skills SET name=?, order_index=? WHERE id=?");
            $stmt->bind_param("sii", $name, $order_index, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO skills (name, order_index) VALUES (?, ?)");
            $stmt->bind_param("si", $name, $order_index);
        }
    }

    $stmt->execute();
    header("Location: manage_section.php?section=$section");
    exit();
}

// Fetch items
$result = $conn->query("SELECT * FROM $section ORDER BY order_index ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage <?php echo ucfirst($section); ?></title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="admin-container">
        <a href="index.php" class="nav-back">&larr; Back to Dashboard</a>
        <h1>Manage <?php echo ucfirst($section); ?></h1>

        <div class="card" style="margin-bottom: 20px;">
            <h3>Add New Item</h3>
            <form method="POST">
                <?php if ($section == 'experience'): ?>
                    <div class="form-group"><label>Date Range</label><input type="text" name="date_range" required></div>
                    <div class="form-group"><label>Title</label><input type="text" name="title" required></div>
                    <div class="form-group"><label>Company</label><input type="text" name="company" required></div>
                    <div class="form-group"><label>Description (HTML)</label><textarea name="description"></textarea></div>
                <?php elseif ($section == 'education'): ?>
                    <div class="form-group"><label>Date Range</label><input type="text" name="date_range" required></div>
                    <div class="form-group"><label>Degree</label><input type="text" name="degree" required></div>
                    <div class="form-group"><label>School</label><input type="text" name="school" required></div>
                    <div class="form-group"><label>Score</label><input type="text" name="score"></div>
                <?php elseif ($section == 'achievements'): ?>
                    <div class="form-group"><label>Title</label><input type="text" name="title" required></div>
                    <div class="form-group"><label>Description</label><textarea name="description" required></textarea></div>
                <?php elseif ($section == 'certifications'): ?>
                    <div class="form-group"><label>Title</label><input type="text" name="title" required></div>
                    <div class="form-group"><label>Issuer</label><input type="text" name="issuer" required></div>
                    <div class="form-group"><label>Description</label><textarea name="description"></textarea></div>
                    <div class="form-group"><label>Image URL</label><input type="text" name="image_url"></div>
                <?php elseif ($section == 'skills'): ?>
                    <div class="form-group"><label>Skill Name</label><input type="text" name="name" required></div>
                <?php endif; ?>

                <div class="form-group"><label>Order Index</label><input type="number" name="order_index" value="0"></div>
                <button type="submit">Add Item</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <?php if ($section == 'experience'): ?>
                        <th>Date</th><th>Title</th><th>Company</th><th>Order</th>
                    <?php elseif ($section == 'education'): ?>
                        <th>Date</th><th>Degree</th><th>School</th><th>Order</th>
                    <?php elseif ($section == 'achievements'): ?>
                        <th>Title</th><th>Description</th><th>Order</th>
                    <?php elseif ($section == 'certifications'): ?>
                        <th>Title</th><th>Issuer</th><th>Order</th>
                    <?php elseif ($section == 'skills'): ?>
                        <th>Name</th><th>Order</th>
                    <?php endif; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <?php if ($section == 'experience'): ?>
                            <td><?php echo htmlspecialchars($row['date_range']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['company']); ?></td>
                        <?php elseif ($section == 'education'): ?>
                            <td><?php echo htmlspecialchars($row['date_range']); ?></td>
                            <td><?php echo htmlspecialchars($row['degree']); ?></td>
                            <td><?php echo htmlspecialchars($row['school']); ?></td>
                        <?php elseif ($section == 'achievements'): ?>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars(substr($row['description'], 0, 50)) . '...'; ?></td>
                        <?php elseif ($section == 'certifications'): ?>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['issuer']); ?></td>
                        <?php elseif ($section == 'skills'): ?>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <?php endif; ?>

                        <td><?php echo $row['order_index']; ?></td>
                        <td class="actions">
                            <a href="edit_item.php?section=<?php echo $section; ?>&id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="manage_section.php?section=<?php echo $section; ?>&delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
