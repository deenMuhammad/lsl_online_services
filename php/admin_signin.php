<?php

session_start();

	$email = $_POST['email'];
	$password = $_POST['password'];		
	include('connect.php');//connectiong into database

	//making appropriate query
	$query = "SELECT * FROM admin WHERE pass = '$password' AND email = '$email'";
	//running query
	$results = $db->query($query);
	if($results->num_rows==0){
		$_SESSION['message'] = "You Typed Wrong Email or Password So No Admin Found";
		header("location: error.php");
	}
	else{
	$user = $results->fetch_assoc();
	 $_SESSION['ID'] = $user['ID'];
	 $_SESSION['password'] = $user['pass'];
	$_SESSION['email'] = $user['email'];
	$_SESSION["admin_state"] = 1;
	header("location: ../admin_index.php");
}

?>