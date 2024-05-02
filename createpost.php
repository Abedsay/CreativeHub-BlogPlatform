<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";
$conn = new mysqli($servername, $username, $password, $database, "3308");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();
$user_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $image_url = $_POST['image_url'];
  $sql = "INSERT INTO posts (user_id, title, content, image_url) VALUES ('$user_id', '$title', '$content', '$image_url')";
  $conn->query($sql);
}
$conn->close();
?>
<?php header("Location: user.php"); ?> 