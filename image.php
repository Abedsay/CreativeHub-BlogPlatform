<?php
session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; 
$servername = "localhost";
$usernamee = "root"; 
$password = ""; 
$database = "blog";
$conn = new mysqli($servername, $usernamee, $password, $database, "3308");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);

    $stmt = $conn->prepare("SELECT image_url FROM posts WHERE post_id = ?");
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($image);
        $stmt->fetch();
        $stmt->close();

        if ($image !== null) {
            header('Content-Type: image/jpeg'); 
            echo $image;
        } else {
            header("Location: w2.jpg");
        }
    } else {
        echo 'Image not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
