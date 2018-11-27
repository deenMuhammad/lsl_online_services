<?php 
session_start();

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$ID = $_SESSION['ID'];
$name = $_SESSION['name'];
$href = "http://localhost:8888/lsl_application/php/verify_email.php?email=".$email."&ID=".$ID."";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

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
    $mail->addAddress($email, $name);     // Add a recipient            // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('logo.png', 'new.png');    // Optional name
    $body = "<h2>LSL Email Verification</h2>
    <strong>Thank You for Tuning up with LSL</strong>
    <strong><br>Just One Step to complete Your Update!</strong>
    <strong><br>Please </strong>
    <a href=".$href.">Click here To Verify</a>
    ";
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'LSL Email Verification!';
    $mail->Body    = $body;
    $mail->AltBody = stripslashes($body);

    $mail->send();
} catch (Exception $e) {
    $_SESSION['message'] = "Failed to Send Verification email: ".$mail->ErrorInfo;
    header("location: error.php");
}





 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Email Verification</title>

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
						<center><h4>We have sent to this <?php echo $email;  ?>  email a link to verify your email!</h4></center>
						<div class="alert alert-info">
    <strong>Info!</strong> Please Check Your Email! <br> After verification complete you can sign in!
  </div>
					</div>
					<div>
						<center><a href="logout.php"><button class="btn btn-primary">Home</button></a></center>
					</div>
</body>
</html>