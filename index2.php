<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
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
        margin: 0;
        padding: 0;
        text-align: center;
    }
    nav ul li {
        display: inline;
        margin-right: 20px;
    }
    nav ul li a {
        text-decoration: none;
        color: #fff;
    }
    main {
        display: flex;
        justify-content: space-around; 
        align-items: flex-start;
        padding: 20px;
    }
    #userContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start; 
        align-items: flex-start;
        width: 75%; 
        overflow-x: auto; 
    }
    .user-card {
        width: 300px; 
        margin: 10px; 
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column; 
    }
    .user-info, .user-actions {
        margin-bottom: 10px;
    }
    button {
        padding: 10px 20px;
        background-color: #7B1FA2;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #0056b3;
    }
    form {
        width: 300px;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label, input, button[type="submit"] {
        display: block;
        width: calc(100% - 20px);
        margin-bottom: 10px;
    }
    footer {
        margin-top: 20px;
        text-align: center;
        background-color: #7B1FA2;
        color: white;
        padding: 10px;
        width: 100%;
        position: fixed;
        bottom: 0;
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
  <main>
    <div id="userContainer">

    </div>
    <div id="add_form">
    <form id="addUserForm" action="add_user.php" method="post">
    <input type="hidden" name="action" value="add">
    <h2>Add Account</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Add</button>
</form>

    </div>
  </main>
  <footer>
  <p>©All rights reserved.</p>
  </footer>
  <script src="admin.js"></script>
</body>
</html>
