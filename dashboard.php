<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit;
}

// Database config
$host = 'localhost';
$db   = 'lexus';
$user = 'root';
$pass = ''; // Update as needed

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Fetch all admin users
    $stmt = $pdo->query("SELECT id, username, created_at FROM admin_users ORDER BY created_at DESC");
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen p-8">
  <div class="max-w-3xl mx-auto bg-red-50 p-8 rounded-xl shadow-2xl">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-red-600">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h1>
      <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Logout</a>
    </div>

    <h2 class="text-xl font-semibold text-red-800 mb-4">Admin User List</h2>
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-red-100 text-red-800 font-bold">
        <tr>
          <th class="py-2 px-4 text-left">ID</th>
          <th class="py-2 px-4 text-left">Username</th>
          <th class="py-2 px-4 text-left">Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
        <tr class="border-b hover:bg-red-50">
          <td class="py-2 px-4"><?php echo $user['id']; ?></td>
          <td class="py-2 px-4"><?php echo htmlspecialchars($user['username']); ?></td>
          <td class="py-2 px-4"><?php echo $user['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
