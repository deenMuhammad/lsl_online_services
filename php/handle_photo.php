<?php
session_start();


$_SESSION['message'] = "Problem: ";

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

if(!($_FILES["photo"]["type"]=="image/gif" || $_FILES["photo"]["type"]=="image/jpg"||$_FILES["photo"]["type"]=="image/jpeg"||$_FILES["photo"]["type"]=="image/png")){
	$_SESSION['message'] = $_SESSION['message']."Upload Failed: You have uploaded wrong type. Please Upload image type(gif/jpg/jpeg/png)!";
	header("location: error.php");
}


if(is_uploaded_file($_FILES["photo"]["tmp_name"]))
    {
    	//$type = "data:".$_FILES["photo"]["type"].";base64,";

    	//$type = $_FILES["photo"]["type"];


        //$image =mysqli_real_escape_string(addslashes(file_get_contents($_FILES["photo"]["tmp_name"])));
        

        //$_imagePost = $type.''.$image;
        //header("content-type:".$type);
        //echo base64_decode($_imagePost);
        //echo $_imagePost;

  //       $email = $_SESSION['email'];
  //       $password = $_SESSION['password'];
    	if(isset($_SESSION['ID'])){
        $ID = $_SESSION['ID'];
		}
		else{
		$query = "SELECT ID FROM applicant WHERE email = '$email' AND pass = '$password'";

        $results = $db->query($query);
		if($results->num_rows==0){
			$_SESSION['message'] = "You Typed Wrong Email or Password So No User Found";
			header("location: error.php");
		}
		$ID = $results->fetch_assoc();
		$ID = $ID['ID'];
		}

		$target_file = "../images/userImages/".$ID.basename($_FILES['photo']['name']);
		$_imagePost = $ID.basename($_FILES['photo']['name']);
    	if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo "<br>".$_imagePost;
	    } else {
	        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
	        header("location: error.php");
	    }

	    include("connect.php");
	    $insert_image="INSERT INTO applicant_photo VALUES('$ID','$_imagePost')";
		$results = $db->query($insert_image);
		if (!$results) {
			$_SESSION['message'] = $_SESSION['message']."Uploading failed while Querying!";
			header("location: error.php");
			# code...
		}
		else{
			header("location:../index.php");
		}
        // Close DB Connection
        $db->close();
    }



  ?>
