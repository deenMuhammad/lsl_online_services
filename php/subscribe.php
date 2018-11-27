<?php 
session_start(); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
require_once("connect.php");

$result = $db->query("SELECT * from mailing_list where email = '".$email."'");
if($result->num_rows>0){
	$_SESSION['message'] = "Your email has already been subscribed to our News Feed!";
	header("location: error.php");
}
else{
$results = $db->query("INSERT mailing_list values(NULL, '".$email."')");
if(!$results){
	$_SESSION['message'] = "Failed while subscribing to our News Feed!<br>Database Connection Error!";
	header("location: error.php");
}
else{
$href = "http://localhost:8888/lsl_application/";
$unscubs_href = "http://localhost:8888/lsl_application/php/unsubscribe.php?email=".$email;
//Load Composer's autoloader
include('vendor/autoload.php');

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
    $mail->addAddress($email, $email);     // Add a recipient            // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('logo.png', 'new.png');    // Optional name
    $body = "<h2>LSL News Feed Subscription</h2>
    <strong>Thank You for Subscribing to LSL News Feed</strong>
    <strong><br>LSL will always try to offer you valuable decisions for your Future!</strong>
    <strong><br>Stay Tuned with LSL!</strong>
    <strong><br>Please </strong>
    <a href='".$href."'>Click here To go to LSL Home Page!</a>
    <br><br><br><br>
    <strong><br>Do you want to Unsubscribe? </strong>
    <p><a href='".$unscubs_href."'>Click here to Unsubscribe</a></p>";
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'LSL Email Verification!';
    $mail->Body = $body;
    $mail->AltBody = stripslashes($body);

    $mail->send();
} catch (Exception $e) {
    $_SESSION['message'] = "Failed to Send Verification email: ".$mail->ErrorInfo;
    header("location: error.php");
}



}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription to LSL</title>
</head>
<body>
<h4>You Have Subscribed to LSL Mailing List</h4>
<h5>Stay Tuned With LSL</h5>
<h5 id="loading">#</h5>
<script type="text/javascript">
	setInterval(function(){ window.location.assign("http://localhost:8888/lsl_application/index.php"); }, 5000);
	setInterval(function(){ document.getElementById("loading").innerHTML = document.getElementById("loading").innerHTML + '#'; }, 100);
</script>
</body>
</html>