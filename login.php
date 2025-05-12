<?php
// login.php - User login

include 'db.php';  // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // You can set a session here if needed
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email.";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Your Email" required>
    <input type="password" name="password" placeholder="Your Password" required>
    <button type="submit">Sign In</button>
</form>
