<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "some";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the booking to be confirmed
$id = $_POST['id'];

// SQL query to update the status of the booking to 'confirmed'
$sql = "UPDATE bookings SET status = 'confirmed' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Booking confirmed successfully";
} else {
    echo "Error confirming booking: " . $conn->error;
}

// Close the connection
$conn->close();
?>
