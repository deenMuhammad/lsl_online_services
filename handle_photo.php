<?php
session_start();




if($_FILES['photo']['error']>0){
	$_SESSION['message'] = "Problem: ";
	switch ($_FILES['photo']['error']) {
		case 1:
			$_SESSION['message'] = $_SESSION['message']."File exceeds the maximum file size of the system";
			break;
		case 2:
			$_SESSION['message'] = $_SESSION['message']."File exceeds the maximum file size of the HTML form";
			break;
		case 3:
			$_SESSION['message'] = $_SESSION['message']."File File only partially uploaded";
			break;
		case 4:
			$_SESSION['message'] = $_SESSION['message']."You have not uploaded any file";
			break;
		case 6:
			$_SESSION['message'] = $_SESSION['message']."Cannot upload the file: NO temp directory is specified";
			break;
		case 7:
			$_SESSION['message'] = $_SESSION['message']."Upload Failed: Cannot write to disk";
			break;
	}
	header("location: error.php");
}


if(isset($_FILES['photo']))
    {
        $_useImagePost = 1;
        $_imagePost = file_get_contents($_FILES['photo']);

        // Open DB Connection

        $_conn = mysqli_connect("localhost","Deen","+1587455","lsl_application");

        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $query = "SELECT ID FROM applicant WHERE email = '$email' AND pass = '$password'";

        $results = mysqli_query($_conn, $query);
		if($results->num_rows==0){
			$_SESSION['message'] = "You Typed Wrong Email or Password So No User Found";
			header("location: error.php");
		}
		$ID = mysqli_fetch_assoc($results);


        $_stmt = $_conn->prepare("INSERT INTO applicant_photo (ID, photo) VALUES (?,?)");
        $_stmt->bind_param("ib", $ID, $_useImagePost);
        $_stmt->send_long_data(4,$_imagePost);
        $_stmt->execute();

        // Close DB Connection
        $_conn->close();
    }



  ?>}
