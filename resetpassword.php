<?php
// Define your database connection details
$hostname = '127.0.0.1'; // Your MySQL host (often 'localhost')
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password
$database = 'userlogin'; // Your MySQL database name

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume you have a form field for the user to enter their email
    $email = $_POST['email'];

    // Generate a random token (you can use a more secure method)
    $token = bin2hex(random_bytes(32));

    // Store the token in the database for the user
    $updateTokenQuery = "UPDATE user_data SET Password = '$token' WHERE Email = '$email'";
    if (mysqli_query($conn, $updateTokenQuery)) {
        // Send the password reset link to the user's email
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: http://localhost/DBMSProject/resetpassword.php?email=$email&token=$token";
        $headers = "From: charithneeli2005@example.com"; // Change this to your email or leave it blank

        // Use your mail server's configuration here
        $smtp_host = 'smtp.gmail.com';
        $smtp_port = 587;
        $smtp_username = 'charithneeli2005@gmail.com';
        $smtp_password = 'neeliCharith@@27072005';

// ... (rest of your code)

// Set SMTP configuration using ini_set()
        ini_set("SMTP", $smtp_host);
        ini_set("smtp_port", $smtp_port);
        ini_set("sendmail_from", $smtp_username);
        mail($email, $subject, $message, $headers);

        echo "Password reset link sent to your email.";
    } else {
        echo "Error updating reset token: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
