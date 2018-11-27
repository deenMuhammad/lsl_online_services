<?php
session_start();

	$ID = 0;
	$name = $_POST['name'];
	$email = $_POST['email'];
	$name = $_POST['name'];

//checking email syntax
	// if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
	// 	$_SESSION['message'] = "Sign Up Failed! You have typed invalid email!";
	// 	header("location: error.php");
	// }
	include("connect.php");

	$query = "SELECT * FROM applicant WHERE email = '$email'";
    //running query

    $results = $db->query($query);
    if($results->num_rows>0){
        $_SESSION['message'] = "The email: <i><b>".$email."</b></i> has already been registered in our database! <br>Please try to use another email!";
    header("location: error.php");
    }
	else{

	$password = trim($_POST['password']);
	$repassword = trim($_POST['repassword']);
	$passok = 0;
	$emailok = 0;


	//opening increment txt file to get last number of applicant ID 
	$fp = fopen("increment.txt", 'r+');
	if(!$fp){
		$_SESSION['message']="Could not Register. Problem with generating ID!";
		    header("location: error.php");
	}
	$ID = fgets($fp);
	$ID +=1;

	fclose($fp);

	$fp = fopen("increment.txt", 'w');
	if(!$fp){
		$_SESSION['message']="Could not Register. Problem with generating ID!";
		    header("location: error.php");
	}

	fwrite($fp, $ID);

	fclose($fp);


	if($password == $repassword){
		$passok = 1;
	}
	if($passok == 1){

		

		 $query = "INSERT INTO applicant(ID,pass,name,email) VALUES('$ID','$password','$name','$email')";
		 $results = $db->query($query);
		 if($results){
		 	$_SESSION['email'] = $email;
		 	$_SESSION['password'] = $password;
		 	$_SESSION['ID'] = $ID;
		 	$_SESSION['name'] = $name;
		 	header("location: send_email.php");
		 	//header("location: ../index.php");
		 }
		 else{
		 	$_SESSION['message']="Could not Register.".$ID;
		    header("location: error.php");
		 }
	}
	else{
		$_SESSION['message']="You typed two different passwords!";
		header("location: error.php");
	}
}
?>