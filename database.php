<?php
// Database connection settings
$host = "localhost"; // Change to your database host
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$database = "flight"; // Change to your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$tickets = $_POST['tickets'];
$from = $_POST['from'];
$to = $_POST['to'];
$city = $_POST['city'];
$state = $_POST['state'];
$postal_code = $_POST['postal_code'];
$dob = $_POST['dob'];
$date_of_journey = $_POST['date_of_journey'];
$phone = $_POST['phone'];

// SQL query to insert the data into a table
$sql = "INSERT INTO passenger (Passenger_name, Email, `Number of tickets`, from_location, to_location, city, state, postal_code, dob, date_of_journey, phone)
        VALUES ('$name', '$email', $tickets, '$from', '$to', '$city', '$state', '$postal_code', '$dob', '$date_of_journey', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Booking successful. Your data has been stored in the database.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
