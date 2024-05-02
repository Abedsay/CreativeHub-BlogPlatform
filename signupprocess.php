<?php
$servername= "localhost";
$usernamee = "root"; 
$password = ""; 
$database = "blog"; 
$conn = new mysqli($servername, $usernamee, $password, $database, "3308");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$usernamee = "";
  
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $sql = "INSERT INTO users(username, password, email, role) VALUES('$username','$pass','$email','user')";
    if ($conn->query($sql) === TRUE) { 
        echo "New record created successfully"; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: registration.php");
}
else {
    echo "submission method not allowed";
}

$conn->close();
?>
