<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Set to 2 for debugging information
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'charithneeli2005@gmail.com';
            $mail->Password = 'neeliCharith@@27072005';
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('charithneeli2005@gmail.com');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body = "Click the following link to reset your password: http://localhost/DBMSProject/resetpassword.php?email=$email&token=$token";

            $mail->send();
            echo "Password reset link sent to your email.";
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error updating reset token: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
