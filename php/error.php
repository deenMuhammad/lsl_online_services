<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container text-center jumbotron vertical-center" style="vertical-align: middle;">
    <h1 class="text-warning">Error:</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
      echo '<img src="../images/robot-msg-error.png" class="img-fluid" style="width: 30vh; height: 32vh">';
        echo '<h4 class="text-info text-center">'.$_SESSION['message'].'</h4>'; 
        echo '<h4 class="text-info text-center">Please Try Again!</h4>';   
    else:
        header( "location: ../index.php" );
    endif;
    ?>
    </p>  
    <?php 
    if($_SESSION['message']=="You Typed Wrong Email or Password So No User Found"){
      echo '<a class="text-center" href="logout.php"><button type="button" class="btn btn-success"/>Home</button></a>';
    }
    elseif($_SESSION['message']=="Failed to query while querying to update answer of the applicant message!"){
      echo '<a class="text-center" href="../show_admin_messages.php"><button type="button" class="btn btn-success"/>Go back</button></a>';
    }
    elseif ($_SESSION['message']=="Changing Your Personal Info Failed: You have typed Wrong Old password!" OR $_SESSION['message']=="Updating Failed: Problem with database!" OR $_SESSION['message']== "Updating Failed: You did not complete The form!<br> IF YOU DO NOT WANT TO CHANGE JUST SOME OF YOUR INFO JUST TYPE OLD INFO!") {
      echo '<a class="text-center" href="../manage_account.php"><button type="button" class="btn btn-success"/>Back</button></a>';
    }
    elseif ($_SESSION['message']=="Failed to query while querying to insert in teaches table!" or $_SESSION['message']=="Failed to query while querying to insert new course to courses!") {
      echo '<a class="text-center" href="../create_course.php"><button type="button" class="btn btn-success"/>Back</button></a>';
    }
    else{
      echo '<a class="text-center" href="../index.php"><button type="button" class="btn btn-success"/>Home</button></a>';
    }
     ?>   
    
</div>
</body>
</html>
