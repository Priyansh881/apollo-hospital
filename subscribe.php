<?php
// subscribe.php - Subscription form

include 'db.php';  // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email input from the form
    $email = $_POST['email'];

    // Check if email is already subscribed
    $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "You're already subscribed!";
    } else {
        // Insert the email into the subscribers table
        $stmt = $pdo->prepare("INSERT INTO subscribers (email) VALUES (?)");
        $stmt->execute([$email]);
        echo "You have been subscribed successfully!";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Your Email Goes Here" required>
    <button type="submit">Subscribe</button>
</form>
