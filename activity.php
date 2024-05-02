<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - Blog</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #f5f5f5;
      color: #333;
      margin: 0;
      padding: 0;
    }

    header, footer {
      background-color: #7B1FA2;
      color: white;
      padding: 20px;
      text-align: center;
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
      color: white;
      font-weight: 700;
    }

    .chart-container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    footer {
  text-align: center;
  background-color: #7B1FA2;
  color: #f8f9fa;
  padding: 10px;
  bottom: 0;
  width: 100%;
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
    @media (max-width: 768px) {
      nav ul li {
        display: block;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>
  <header>
  <img src="log.jpg" alt="BlogPlatform logo">
    <h1>User Dashboard - Blog</h1>
    <nav>
      <ul>
        <li><a href="index.php">Main Page</a></li>
        <li><a href="user.php">My Posts</a></li>
        <li><a href="activity.php">User Activity</a></li>
      </ul>
    </nav>
  </header>
  <div class="chart-container">
    <canvas id="postsChart"></canvas>
  </div>
  <footer>
    <p>©All rights reserved.</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('postsChart').getContext('2d');
      var postsChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets: [{
            label: 'Number of Posts',
            data: [10, 12, 8, 15, 9, 7, 14, 11, 6, 5, 8, 10],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>
</body>
</html>
