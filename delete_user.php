<?php
session_start();
header('Content-Type: application/json');

$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

$conn = new mysqli("localhost", "root", "", "blog", "3308");
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

if ($userId > 0) {
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    if ($stmt->execute()) {
        echo json_encode(['success' => 'User deleted successfully']);
    } else {
        echo json_encode(['error' => 'Error deleting user: ' . $stmt->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid user ID']);
}
?>