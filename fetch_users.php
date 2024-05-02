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

$result = $conn->query("SELECT user_id, username, email, role FROM users");
$users = [];

if ($result) {
    while ($user = $result->fetch_assoc()) {
        $users[] = $user;
    }
    echo json_encode($users);
} else {
    echo json_encode(['error' => 'No users found']);
}
?>