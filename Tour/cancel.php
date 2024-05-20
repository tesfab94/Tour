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

// Get the ID of the booking to be canceled
$id = $_POST['id'];

// SQL query to update the status of the booking to 'canceled'
$sql = "UPDATE bookings SET status = 'canceled' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Booking canceled successfully";
} else {
    echo "Error canceling booking: " . $conn->error;
}

// Close the connection
$conn->close();
?>
