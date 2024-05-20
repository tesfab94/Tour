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

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$attraction = $_POST['attraction'];
$hotel = $_POST['hotel'];
$visitors = $_POST['visitors'];
$coupleType = isset($_POST['coupleType']) ? $_POST['coupleType'] : '';
$groupSize = isset($_POST['groupSize']) ? $_POST['groupSize'] : '';
$visitation = $_POST['visitation'];
$duration = isset($_POST['duration']) ? $_POST['duration'] : '';
$start_date = $_POST['start_date'];

// SQL query to insert data into the database
$sql = "INSERT INTO bookings (name, email, attraction, hotel, visitors, couple_type, group_size, visitation, duration, start_date)
        VALUES ('$name', '$email', '$attraction', '$hotel', '$visitors', '$coupleType', '$groupSize', '$visitation', '$duration', '$start_date')";

if ($conn->query($sql) === TRUE) {
    
 echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close the connection
$conn->close();
?>
