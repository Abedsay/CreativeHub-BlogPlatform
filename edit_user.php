<?php
session_start();
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";
$port = "3308";

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = null;
if ($userId) {
    $stmt = $conn->prepare("SELECT user_id, username, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $username, $email, $userId);
    if ($stmt->execute()) {
        echo "User updated successfully.";
        header("Location: index2.php"); 
        exit();
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <?php if ($user): ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="role">Role:</label>
            

            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</body>
</html>