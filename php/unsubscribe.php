<?php 
$email = $_GET['email'];
require_once("connect.php");

$result = $db->query("DELETE FROM mailing_list WHERE email = '".$email."'");
if(!$result){
	$_SESSION['message'] = "Failed while subscribing to our News Feed!<br>Database Connection Error!";
	header("location: error.php");
}
else{

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Unsubscription to LSL</title>
</head>
<body>
<h4>You Have Unsubscribed to LSL Mailing List</h4>
<h5>Stay Tuned With LSL</h5>
<h5 id="loading">#</h5>
<script type="text/javascript">
	setInterval(function(){ window.location.assign("http://localhost:8888/lsl_application/index.php"); }, 5000);
	setInterval(function(){ document.getElementById("loading").innerHTML = document.getElementById("loading").innerHTML + '#'; }, 100);
</script>
</body>
</html>