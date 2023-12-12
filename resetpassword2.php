<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume you have a database connection, replace with your actual database logic
    $conn = new mysqli("127.0.0.1", "root", "", "userlogin");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate and sanitize user input
    $email = $conn->real_escape_string($_POST['email']);

    // Check if the email exists in your database (replace with your actual query)
    $sql = "SELECT * FROM user_data WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(32));

        // Store the token in your database for later verification (replace with your actual query)
        $sql = "UPDATE user_data SET reset_token = '$token' WHERE email = '$email'";
        $conn->query($sql);

        // Send the reset link to the user's email
        $reset_link = "http://yourwebsite.com/resetpassword.php?token=$token";

        $to = $email;
        $subject = "Password Reset Instructions";
        $message = "Click the following link to reset your password: $reset_link";

        // Replace the following line with your actual mail function
        mail($to, $subject, $message);

        echo "Password reset instructions sent to your email. Please check your inbox.";
    } else {
        echo "Email not found in our records.";
    }

    $conn->close();
}
?>
