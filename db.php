<?php
// db.php - Database connection

$servername = "localhost";  // Your MySQL server, usually localhost
$username = "root";         // Your MySQL username (default is root)
$password = "";             // Your MySQL password
$dbname = "lexus"; // Database name (should match the one you created)

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$lexus", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
