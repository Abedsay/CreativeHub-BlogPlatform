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
  $sql = "SELECT * FROM posts WHERE post_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $post_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $post = $result->fetch_assoc();
  } else {
    echo "<p style='color: red;'>Error: Post not found.</p>";
  }

  $stmt->close();
} else {
  echo "<p style='color: red;'>Error: Invalid post ID.</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $post_id > 0) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    $sql = "UPDATE posts SET title = ?, content = ?, image_url = ? WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $content, $image_url, $post_id);
    $stmt->execute();
    header("Location: user.php");
}

$conn->close();
?>

<?php if (isset($post)): ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Post</title>
</head>
<body>
  <h2>Update Post</h2>
  <form action="updatepost.php?post_id=<?php echo $post['post_id']; ?>" method="post">
    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>">
    <br>
    <label for="content">Content:</label>
    <input type="text" name="content" id="content" value="<?php echo $post['content']; ?>">
    <br>
    <label for="image_url">Image:</label>
    <input type="file" name="image" id="image">
    <br>
    <button type="submit">Update Post</button>
  </form>
</body>
</html>
<?php endif; ?>