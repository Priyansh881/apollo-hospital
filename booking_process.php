<?php
// Turn on error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = "localhost";
$user = "root";
$password = "";
$database = "lexus";  // ✅ Your actual database name

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

// Collect and sanitize data
$first_name = $conn->real_escape_string($_POST['first_name']);
$email = $conn->real_escape_string($_POST['email']);
$mobile = $conn->real_escape_string($_POST['mobile']);
$service = $conn->real_escape_string($_POST['service']);
$date = $conn->real_escape_string($_POST['date']);
$time = $conn->real_escape_string($_POST['time']);
$request = $conn->real_escape_string($_POST['request']);

// Insert data
$sql = "INSERT INTO appointments (first_name, email, mobile, service, appointment_date, appointment_time, special_request)
        VALUES ('$first_name', '$email', '$mobile', '$service', '$date', '$time', '$request')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('✅ Appointment booked successfully!'); window.location.href='booking.html';</script>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
