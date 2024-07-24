<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is from a POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the current date in the format YYYY-MM-DD
    $today = date("Y-m-d");
    $column_name = "attendance_" . str_replace('-', '_', $today); // e.g., attendance_2023_10_12
    $enrollmentNumber = $_POST['enrollmentNumber'];
    $status = $_POST['status']; // 'p' for present, 'a' for absent

    // Check if the column for today's date exists, if not, add it
    $result = $conn->query("SHOW COLUMNS FROM `attendance_records` LIKE '{$column_name}'");
    if ($result->num_rows == 0) {
        // Column doesn't exist, so create it
        $conn->query("ALTER TABLE attendance_records ADD `{$column_name}` CHAR(1) DEFAULT NULL");
    }

    // Check if there's already a record for the student today, if not, create it
    $result = $conn->query("SELECT `enrollment_number` FROM attendance_records WHERE `enrollment_number` = {$enrollmentNumber}");
    if ($result->num_rows == 0) {
        // Record doesn't exist, so create it
        $conn->query("INSERT INTO attendance_records (enrollment_number, `{$column_name}`) VALUES ({$enrollmentNumber}, NULL)");
    }

    // Update the attendance status for the given enrollment number
    $stmt = $conn->prepare("UPDATE attendance_records SET `{$column_name}` = ? WHERE enrollment_number = ?");
    $stmt->bind_param("si", $status, $enrollmentNumber);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Attendance recorded successfully";
    } else {
        echo "No attendance change made or wrong enrollment number";
    }

    $stmt->close();
} else {
    echo "No POST data received.";
}

$conn->close();
?>
