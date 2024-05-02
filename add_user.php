<?php
session_start();
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";
$port = "3308";

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$email = $_POST['email'] ?? '';
$role = 'user'; 

if (!$username || !$password || !$email) {
    echo json_encode(['error' => 'All fields are required.']);
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $passwordHash, $email, $role);
if ($stmt->execute()) {
    echo json_encode(['success' => 'User added successfully']);
} else {
    echo json_encode(['error' => 'Error adding user: ' . $stmt->error]);
}
?>
