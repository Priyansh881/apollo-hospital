<?php
session_start();

// Mock doctor login (replace with real login in future)
$_SESSION['doctor_id'] = 1; // This should come from login
$doctor_id = $_SESSION['doctor_id'];

// Database configuration
$host = 'localhost';
$db   = 'lexus';
$user = 'root';
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Fetch doctor details
    $doctor_stmt = $pdo->prepare("SELECT * FROM doctors WHERE id = ?");
    $doctor_stmt->execute([$doctor_id]);
    $doctor = $doctor_stmt->fetch();

    // Fetch all bookings for the doctor
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE doctor_id = ?");
    $stmt->execute([$doctor_id]);
    $bookings = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-4 text-red-600">Welcome, Dr. <?php echo $doctor['name']; ?></h2>

        <h3 class="text-xl font-semibold mb-4">Your Appointments</h3>

        <?php if (count($bookings) > 0): ?>
            <table class="w-full bg-white shadow-md rounded mb-4">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="p-2 text-left">Patient Name</th>
                        <th class="p-2 text-left">Service</th>
                        <th class="p-2 text-left">Date</th>
                        <th class="p-2 text-left">Time</th>
                        <th class="p-2 text-left">Mobile</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr class="border-b">
                            <td class="p-2"><?php echo $booking['first_name']; ?></td>
                            <td class="p-2"><?php echo $booking['service']; ?></td>
                            <td class="p-2"><?php echo $booking['date']; ?></td>
                            <td class="p-2"><?php echo $booking['time']; ?></td>
                            <td class="p-2"><?php echo $booking['mobile']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
