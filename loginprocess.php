<?php
$servername= "localhost";
$usernamee = "root"; 
$password = ""; 
$database = "blog"; 
$conn = new mysqli($servername, $usernamee, $password, $database, "3308");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else {
    echo "Connected successfully<br>";
}

$usernamee = "";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $stmt = $conn->prepare("SELECT user_id, username, password, role FROM users WHERE username= '$user' AND password= '$pass'");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            session_start();
            $row = $result->fetch_assoc();
            $role = $row['role'];
            $user_id =$row['user_id'];
            $username = $row['username'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            if ($role === 'admin') {
                header("Location: index2.php");
            }
            else if ($role === 'user') {
                header("Location: index.php?user_id=" . $user_id);
            }
            else {
                $error = "Unexpected user type";
            }
            exit();
        }
        else {
            echo "<script>alert('Invalid username or password');</script>";
        }
        
    }
    else {
        echo "<script>alert('login data not received');</script>";
    }
}
else {
    echo "<script>alert('submission method not allowed');</script>";
}


$conn->close();
?>
<script>
  window.location.href = "registration.php";
</script>