<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";

$conn = new mysqli($servername, $username, $password, $database, "3308");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$post_id = $_GET['post_id']; 

if ($post_id > 0) {
  $sql = "DELETE FROM posts WHERE post_id = '$post_id'";
  $conn->query($sql);
} 
else {
    echo "<p style='color: red;'>Error: Invalid book ID.</p>";
  }

$conn->close();
?>