<?php  

$dbb = mysqli_connect("localhost","Deen","+1587455","lsl_application");

$sql = "SELECT * FROM applicant WHERE email = '$email'";
//running query

$results = mysqli_query($dbb, $sql);
  	if (mysqli_num_rows($results) > 0) {
  		$_SESSION['message'] = 'The Email you have typed has already been used once before! Use another email or try to sign in with that email!';
		header("location: error.php");
  	}else{
  		//No duplicate email found
		$emailok=1;
  	}

?>