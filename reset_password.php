<?php
require_once 'db.php';

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt->bind_param("ss", $hashed_password, $username);

if ($stmt->execute()) {
    echo "<h1>Password Reset Successfully</h1>";
    echo "<p>The password for user '<strong>$username</strong>' has been reset to: <strong>$password</strong></p>";
    echo "<p style='color: red; font-weight: bold;'>IMPORTANT: Please delete this file (reset_password.php) immediately after use to prevent security risks.</p>";
    echo "<a href='admin/login.php'>Go to Login</a>";
} else {
    echo "Error resetting password: " . $conn->error;
}

$conn->close();
?>
