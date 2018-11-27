<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
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
        <center><li class="tab active"><a href="#login">Log In</a></li></center>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="signin.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              <span class="req"></span>
            </label>
            <input type="email" placeholder="Email Address *" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              <span class="req"></span>
            </label>
            <input type="password" placeholder="Password *" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
          
          <button class="button button-block" name="login" />Log In</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          
        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
