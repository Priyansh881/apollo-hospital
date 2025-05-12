<?php
session_start();

// Set your fixed login credentials here
$valid_username = "admin";
$valid_password = "admin@1311";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">
  <div class="bg-red-50 p-8 rounded-2xl shadow-2xl w-full max-w-sm">
    <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Admin Login</h2>
    <?php if (!empty($error)): ?>
      <p class="text-red-600 text-center mb-4 font-semibold"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="POST" class="space-y-5">
      <div>
        <label class="block text-red-800 font-semibold mb-1">Username</label>
        <input type="text" name="username" required
               class="w-full px-4 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-400" />
      </div>
      <div>
        <label class="block text-red-800 font-semibold mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-4 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-400" />
      </div>
      <button type="submit"
              class="w-full bg-red-600 text-white font-bold py-2 rounded-lg hover:bg-red-700 transition">
        Login
      </button>
    </form>
  </div>
</body>
</html>
