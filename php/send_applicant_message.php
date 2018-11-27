<?php
session_start();
if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){//this block is executed if user has already signed up or signed in last time 
$ID = $_SESSION['ID'];
$message = $_POST['message'];
$subject = $_POST['subject'];
include("connect.php");

$result = $db->query("INSERT messages_to_admin values('NULL', '$ID', '$message', NULL, '$subject', 0)");
if($result){
    echo "";
}
else{
    $_SESSION['message'] = "Failed to query while inserting new message to DB";
    header("location: error.php");
}
}
else{
    $_SESSION['message'] = "Please log in or sign up!";
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Application Rendering...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body onload="Function()">
    <div class="jumbotron">
    <h2>Your Message has been sent to the admin!</h2>
    <h3>Taking you to Contact to Admin Page in <h2 id = "tick"></h2></h3>
    </div>
    <script>
    var i = 8;
    function Function(){
        setInterval(function(){ window.location.assign("http://localhost:8888/lsl_application/contact.php"); }, 7000);
        setInterval(function(){ document.getElementById("tick").innerHTML = i--; }, 1000);
    }
    </script>
</body>
</html>