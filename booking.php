<?php
$host = "localhost";
$user = "root";
$pass = ""; // default XAMPP password is empty
$db = "hospital";

// Connect to database
$conn = new mysqli($host, $user, $pass, $hospital
);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize POST data
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$service = $_POST['service'];
$date = $_POST['date'];
$time = $_POST['time'];
$request = $_POST['request'];

// Insert into database
$sql = "INSERT INTO appointments (first_name, email, mobile, service, appointment_date, appointment_time, special_request)
        VALUES ('$first_name', '$email', '$mobile', '$service', '$date', '$time', '$request')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
