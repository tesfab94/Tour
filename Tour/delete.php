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

// Get the ID of the booking to be deleted
$id = $_POST['id'];

// SQL query to delete the booking
$sql = "DELETE FROM bookings WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Booking deleted successfully";
} else {
    echo "Error deleting booking: " . $conn->error;
}

// Close the connection
$conn->close();
?>

           
