<?php 
session_start(); 
$email = $_GET['email'];
$ID = $_GET['ID'];
echo $email, $ID;
echo "<br>";
require_once("connect.php");
$query = "UPDATE applicant  SET email_verf = 1 where ID = '$ID' and email = '$email'";
$result = $db->query($query);
if(!$result){
	print_r($result);
	$_SESSION['message'] = "Email Verification Failed: Database Querying Failed!";
	header("location: error.php");
}
echo "<h3>Email Verification was Successful!</h3>";
echo '<a href="http://localhost:8888/lsl_application/"><button>Go To LSL Main Page</button></a>';
?>