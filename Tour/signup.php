<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
    // SOMETHING WAS POSTED
    $Email = $_POST['Email'];
    $password = $_POST['password'];

    if(!empty($Email) && !empty($password))
    {
        // SAVE TO DATABASE
        $user_id=random_num(20);
        $query = "INSERT INTO users (user_id, Email, password) VALUES ('$user_id','$Email','$password')";
        mysqli_query($con, $query);

        header("location: login.php");
        die;
    }
    else
    {
        echo "wrong Email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style type="text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }
        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: lightblue;
            border: none;
        }
        #box{
            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div id="box">
    <form method="post">
        <div style="font-size: 20px; margin: 10px; color: white;">signup</div>
        <input id="text" type="text" name="Email"><br><br>
        <input id="text" type="password" name="password"><br><br>
        <input id="button" type="submit" value="signup"><br><br>
        <a href="login.php">click to login</a><br><br>
    </form>
</div>
</body>
</html>
