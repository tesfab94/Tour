<?php
session_start();

      include("connection.php");
      include("functions.php");

     $user_data = check_login($con);
?>
<!Doctype html>
<html>
	<head>
		<title>My website</title>
	</head>
	<body>
		
		<a href="logout.php">logout</a>
		<h1>this is the index page</h1>

		<br>
		Hello, username.
	</body>
</html>