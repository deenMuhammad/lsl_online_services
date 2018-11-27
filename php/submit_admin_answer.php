<?php
session_start();

if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){//this block is executed if user has already signed up or signed in last time 
    if(isset($_POST['submit'])){
        $message_ID = ($_POST['message_ID']);
        $answer = $_POST['answer'];
        include("connect.php");
        $query = "UPDATE messages_to_admin set answer = '$answer' where message_ID = '$message_ID'";
        $result = $db->query($query);
        if($result){
        }
        else{
            $_SESSION['message'] = "Failed to query while querying to update answer of the applicant message!";
            header("location: error.php");
        }
    }
    else{
        header("location: ../show_admin_messages.php");
    }
}
else{
    $_SESSION['message'] = "Please Log in as admin";
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
    <h2>Your Answer has been submitted to the applicant!</h2>
    <h3>Taking you to Application messages page in <h2 id = "tick"></h2></h3>
    </div>
    <script>
    var i = 8;
    function Function(){
        setInterval(function(){ window.location.assign("http://localhost:8888/lsl_application/show_admin_messages.php"); }, 7000);
        setInterval(function(){ document.getElementById("tick").innerHTML = i--; }, 1000);
    }
    </script>
</body>
</html>