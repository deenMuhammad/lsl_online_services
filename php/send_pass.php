<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$email = $_POST['email'];
$password = randomPassword();


include("connect.php");

$query_one = "UPDATE applicant SET pass = '$password' where email = '$email'";

$query = "SELECT * FROM applicant WHERE email = '$email'";
    //running query

    $results = $db->query($query);
    if($results->num_rows==0){
        $_SESSION['message'] = "The email: <i><b>".$email."</b></i> is not registered in our database! <br>Please try to use valid email!<br>or You can Sign up to a new account!";
    header("location: error.php");
    }
else{

$result = $db->query($query_one);



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'zorro199696@gmail.com';                 // SMTP username
    $mail->Password = '+1587455';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('zorro199696@gmail.com', 'DeenMuhammad');
    $mail->addAddress($email);     // Add a recipient            // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('logo.png', 'new.png');    // Optional name
    $body = "<h2>LSL Setting Password</h2>
    <strong>Thank You for staying up with LSL</strong>
    <strong><br>We have Set password randomly!</strong>
    <strong><br>You can change it any time with Manage Account Setting!</strong>
    <strong><br>Your new Password: ".$password."</strong>
    <strong><br>Please </strong>
    <a href='http://localhost:8888/lsl_application/index.php'>Click here To Go to LSL Main Page</a>
    ";
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'LSL Random Password Setting!';
    $mail->Body    = $body;
    $mail->AltBody = stripslashes($body);

    $mail->send();
} catch (Exception $e) {
    $_SESSION['message'] = "Failed to Send Send Random Password Setting email: ".$mail->ErrorInfo;
    header("location: error.php");
}

}




 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Setting new Random Password</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="col-md-12 col-md-offset-0 text-left">
						<center><h1>Email Verification is Needed!</h1></center>
						<center><h4>We have sent to this <?php echo $email;  ?>  a random password!</h4></center>
						<div class="alert alert-info">
    <strong>Info!</strong> Please Check Your Email! <br> Then you can sign in with new random password!
  </div>
					</div>
					<div>
						<center><a href="logout.php"><button class="btn btn-primary">Home</button></a></center>
					</div>
</body>
</html>