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

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Email = $_POST['Email'];
    $Username = $_POST['Username'];
    $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
    $Country = $_POST['Country'];

    // Insert data into the users table
    $sql = "INSERT INTO user_data(First_name, Last_name, Email, Username, Password, Country)
            VALUES ('$First_name', '$Last_name', '$Email', '$Username', '$Password', '$Country')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
