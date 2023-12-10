<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
       /* resetpassword.php styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    text-align: center;
}

h2 {
    color: #333;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <form method="post" action="processreset.php">
            <h2>Reset Password</h2>
            <label for="password">Enter your new password:</label>
            <input type="password" name="password" required>
            <label for="confirm_password">Confirm your new password:</label>
            <input type="password" name="confirm_password" required>
            <button type="submit">Save Password</button>
        </form>
    </div>
</body>
</html>