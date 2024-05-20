<?php
// Check if the ID parameter is set
if (isset($_POST['id'])) {
    // Connect to your database
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Escape the ID to prevent SQL injection
    $id = $conn->real_escape_string($_POST['id']);

    // Delete the row with the specified ID
    $sql = "DELETE FROM your_table_name WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo 'Record deleted successfully';
    } else {
        echo 'Error deleting record: ' . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
