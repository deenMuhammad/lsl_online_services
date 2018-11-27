<?php 
/* Main page with two forms: sign up and log in */
//require 'db.php';
session_start();
if(!isset($_SESSION['email'])){
  $_SESSION['message'] = "Please Log In First to Upload Images!";
  header("location: error.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Photo Upload</title>
  <?php include 'css/css.html'; ?>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>
<body>
  <div class="form">
      
      <ul class="tab-group">
        <center><li class="tab active"><a href="#login">Beauty uploading below</a></li></center>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>This is where we start to know each other more!</h1>
          
          <form action="handle_photo.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
          
            <div class="field-wrap">
            <input type="file" required name="photo" id="photo" />
          </div>
          
          <input class="button button-block" type="submit" name="submit_photo" value="Upload">
          
          </form>

        </div>
          
        <div id="signup">   
          
          
          
        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
