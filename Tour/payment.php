<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "some";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the uploads folder exists, if not, create it
$uploads_dir = __DIR__ . '/uploads';
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0755, true);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    // File upload handling
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        // Move the uploaded file to the uploads folder on the server
        $target_file = $uploads_dir . '/' . basename($file_name);
        move_uploaded_file($file_tmp, $target_file);
    } else {
        echo "File upload failed.";
    }
    // Insert data into the database
    $sql = "INSERT INTO payments (name, email, file_name) VALUES ('$name', '$email', '$file_name')";
    if ($conn->query($sql) === TRUE) {
        echo 'Form submitted successfully';
        header("Location: payment.html"); // Redirect to the login page
       
        exit();
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
