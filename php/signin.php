<?php

session_start();

	$email = $_POST['email'];
	$password = $_POST['password'];		
	include('connect.php');//connectiong into database

	//making appropriate query
	$query = "SELECT * FROM applicant WHERE email = '$email' AND pass = '$password'";
	//running query

	$results = $db->query($query);
	if($results->num_rows==0){
		$_SESSION['message'] = "You Typed Wrong Email or Password So No User Found";
		header("location: error.php");
	}
	else{
	$user = $results->fetch_assoc();
	if($user['email_verf']==1){
	 $_SESSION['ID'] = $user['ID'];
	 $_SESSION['password'] = $user['pass'];
	$_SESSION['email'] = $user['email'];
	header("location: ../index.php");
	}
	else{
		$_SESSION['message'] = "Sign In Failed: You Have not verified your email!<br> Please look up your email box and verify your email!";
		header("location: error.php");header("location: error.php");
	}
}

?>