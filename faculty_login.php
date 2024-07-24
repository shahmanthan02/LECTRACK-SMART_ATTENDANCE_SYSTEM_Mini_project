<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}






session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate username and password (e.g., check against the database)
    // If valid, set session variables and redirect to dashboard.


}

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn,$sql);

if ($result->num_rows == 1) {
    // User is valid, set session variables
    $_SESSION["username"] = $username;

    // Redirect to dashboard
    header("Location: attendence1.html");
    exit();
} else {
    // echo "Invalid username or password.";
}

$conn->close();
?>