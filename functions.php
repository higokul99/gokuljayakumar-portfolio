<?php
require_once dirname(__FILE__) . '/db.php';

session_start();

function get_setting($key) {
    global $conn;
    $stmt = $conn->prepare("SELECT value FROM settings WHERE key_name = ?");
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['value'];
    }
    return "";
}

function update_setting($key, $value) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO settings (key_name, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
    $stmt->bind_param("ss", $key, $value);
    return $stmt->execute();
}

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function get_all_experiences() {
    global $conn;
    $sql = "SELECT * FROM experience ORDER BY order_index ASC";
    return $conn->query($sql);
}

function get_all_education() {
    global $conn;
    $sql = "SELECT * FROM education ORDER BY order_index ASC";
    return $conn->query($sql);
}

function get_all_achievements() {
    global $conn;
    $sql = "SELECT * FROM achievements ORDER BY order_index ASC";
    return $conn->query($sql);
}

function get_all_certifications() {
    global $conn;
    $sql = "SELECT * FROM certifications ORDER BY order_index ASC";
    return $conn->query($sql);
}

function get_all_skills() {
    global $conn;
    $sql = "SELECT * FROM skills ORDER BY order_index ASC";
    return $conn->query($sql);
}
?>
