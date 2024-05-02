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
$sql2 = "SELECT * FROM posts";

$stmt = $conn->prepare($sql2);
$stmt->execute();
$result2 = $stmt->get_result();

$posts = [];
while ($row = $result2->fetch_assoc()) {
    $posts[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            color: #495057;
            margin: 0;
            padding: 0;
            }

           
            header {
      background-color: #7B1FA2;
      color: white;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
            header img {
      width: 240px;
      height: auto;
    }

            nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
            }

            nav ul li {
            display: inline;
            margin-right: 20px;
            }

            nav ul li a {
            text-decoration: none;
            color: #f8f9fa;
            }

            section, .container, form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            }

            button[type="submit"], .update-btn, .remove-btn {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            }

            button[type="submit"]:hover, .update-btn:hover, .remove-btn:hover {
            background-color: #0056b3;
            }.post-card {
                width: 250px; /* Adjusted from 300px to 250px for a more medium size */
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                border-radius: 8px;
                overflow: hidden;
                background: #fff;
                margin: 10px; /* Reduced margin for a more compact layout */
                display: inline-flex;
                flex-direction: column;
                transition: transform 0.3s ease; /* Smooth scale animation on hover */
            }

            .post-card:hover {
                transform: scale(1.05); /* Slight scale up on hover to indicate interactivity */
            }

            .post-image {
                width: 100%;
                height: auto; /* Ensures the image scales properly without distortion */
            }

            .post-info {
                padding: 15px;
                display: flex;
                align-items: center;
            }

            .user-avatar {
                width: 40px; /* Slightly smaller avatar */
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
            }

            .post-meta .user-name, .post-meta .post-date {
                display: block;
                color: #333;
            }

            .post-title {
                font-size: 16px; /* Slightly smaller font size for medium card */
                color: #007bff;
                margin-top: 5px; /* Reduced margin-top */
            }

            .post-excerpt {
                font-size: 14px; /* Smaller font size for the excerpt */
                color: #666;
                margin-top: 5px;
            }

            .read-more {
                background-color: #6A1B9A;
                color: white;
                border: none;
                padding: 8px 16px;
                text-align: center;
                display: block;
                width: 100%;
                border-radius: 4px;
                margin-top: 10px;
                cursor: pointer;
            }

            .read-more:hover {
                background-color: #7B1FA2;
            }

            .post-actions {
                display: flex;
                justify-content: space-between;
                padding: 10px; /* Padding inside actions for spacing */
            }

            .update-btn, .remove-btn {
                padding: 5px 10px;
                border-radius: 4px;
                border: none;
                color: white;
                font-size: 14px;
                cursor: pointer;
            }

            .update-btn {
                background-color: #28a745; /* Green for update */
            }

            .remove-btn {
                background-color: #dc3545; /* Red for remove */
            }

            .update-btn:hover {
                background-color: #218838;
            }

            .remove-btn:hover {
                background-color: #c82333;
            }

            .post-actions {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            }
            footer {
            text-align: center;
            background-color: #7B1FA2;
            color: #f8f9fa;
            padding: 10px;
            bottom: 0;
            width: 100%;
            }
            @media (max-width: 768px) {
            nav ul li {
                display: block;
                margin-top: 10px;
            }

            .post-card, .container, form {
                margin: 10px;
                padding: 15px;
            }
            }
            .container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      padding: 20px;
      max-width: 800px;
    }

    form {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    input[type="text"], textarea, input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    footer {
      text-align: center;
      background-color: #7B1FA2;
      color: white;
      padding: 10px;
      bottom: 0;
      width: 100%;
    }
    a {
      text-decoration: none;
      color: white;
    }

  </style>
</head>
<body>
  <header>
  <img src="log.jpg" alt="BlogPlatform logo">
    <h1>Admin Dashboard</h1>
    <nav>
        <ul>
        <li><a href="index2.php">Manage Accounts</a></li>
        <li><a href="posts.php">Manage Posts</a></li>
        </ul>
    </nav>
  </header>
  <?php if (isset($posts) && !empty($posts)): ?>
  <div class="main" id="main">
    <div class="posts">
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
            <img src="image.php?post_id=<?= $post['post_id'] ?>" alt="Post Image" class="post-image">
            <div class="post-info">
            <img src="w2.jpg" alt="User Avatar" class="user-avatar">
                <div class="post-meta">
                    <span class="user-name">Blogger ID: <?= htmlspecialchars($post['user_id']) ?></span>
                    <span class="post-date">Created at: <?= htmlspecialchars($post['created_at']) ?></span>
                </div>
            </div>
            <h2 class="post-title">Post Title: <?= htmlspecialchars($post['title']) ?></h2>
            <p class="post-excerpt"><?= htmlspecialchars($post['content']) ?></p>
            <div class="post-interactions">
                <span class="likes"><i class="fa fa-heart"></i> <?= htmlspecialchars($post['likes_count']) ?></span>
            </div>
            <div class="post-actions">
            <button class="remove-btn"><a href="delete.php?post_id=<?php echo $post['post_id']; ?>">Delete</a></button>
            </div>
        </div>
        <?php endforeach; ?>
         
    </div>
   </div>
   <?php else: ?>
    <p>You don't have any posts yet.</p>
    <?php endif; ?>
<footer>
<p>©All rights reserved.</p>
</footer>
</body>
</html>