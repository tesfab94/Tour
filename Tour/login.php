<?php
// Database connection parameters
$host = 'localhost'; // or your host
$username = 'root'; // or your username
$password = ''; // or your password
$database = 'some'; // or your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the user exists
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Verify password
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // Direct comparison of passwords
            // Return a success message
            echo 'success';
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
