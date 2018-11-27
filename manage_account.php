<?php 

session_start();

 ?>


<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
<style type="text/css">
	#write_all_cell{
		display: none;
	}
</style>
	<?php 
	if(isset($_POST['name'])AND ! empty($_POST['name'])AND isset($_POST['email'])AND ! empty($_POST['email'])AND isset($_POST['old_pass'])AND ! empty($_POST['old_pass'])AND isset($_POST['new_pass'])AND ! empty($_POST['new_pass'])){
		if($_SESSION["password"]==$_POST['old_pass']){
			//old pass is ok
			include("php/connect.php");
			$ID = $_SESSION['ID'];
			$name = $_POST['name'];
			$email = trim($_POST['email']);
			$pass = $_POST['new_pass'];
			$query = "UPDATE applicant SET name = '$name', email = '$email', pass = '$pass', email_verf = 0 where ID = '$ID'";
			$result = $db->query($query);
			if($result){
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $pass;
				header("location: php/manage_account_send_email.php");
				//update successful
						}
			else{
				$_SESSION['message'] = "Updating Failed: Problem with database!";
				header("location: php/error.php");
			}
		}
		else{
			//user typed wrong old pass
			$_SESSION['message'] = "Changing Your Personal Info Failed: You have typed Wrong Old password!";
			header("location: php/error.php");
		}

}
if(isset($_POST['Submit'])){
	$_SESSION['message'] = "Updating Failed: You did not complete The form!<br> IF YOU DO NOT WANT TO CHANGE JUST SOME OF YOUR INFO JUST TYPE OLD INFO!";
	header("location: php/error.php");
}
	 ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Manage Your Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->


	<script type="text/javascript">
	$(document).ready(function(){
	    $("#personal_change_button").click(function(){
	    	 $("#change_personal_info").fadeIn("slow");
	        $("#change_personal_info").css("display", "block");
	        $("#write_all_cell").css("display", "block");
	        $(this).css("display", "none");
	        $("#personal_change_button_back").css("display", "block");
	    });
    });
    $(document).ready(function(){
	    $("#personal_change_button_back").click(function(){
	    	 $("#change_personal_info").fadeIn("slow");
	        $("#change_personal_info").css("display", "none");
	        $("#write_all_cell").css("display", "none");
	        $(this).css("display", "none");
	        $("#personal_change_button").css("display", "block");
	    });
    });
	</script>
	</style>
	<style type="text/css">
	@media screen and (max-width: 968px) {
		.gtco-container{
			margin: 0px 15px 0px 15px;
		}
	}
	</style>
	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<?php
	require_once("navigation_bar.php");
	  ?>

	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">

						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">To Your Conveniece</span>
							<h1>Manage Your Acount</h1>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container" style="border-bottom: 1px dashed black; ">
			<div class="row">
				<div class="col-md-15">
					<?php 
					if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
								include('php/connect.php');
								$ID = $_SESSION['ID'];
								$query = "SELECT photo FROM applicant_photo where ID = '$ID'";
								
								$result = $db->query($query);
								if($result->num_rows==0){
									echo '<a href="php/photo_upload.php"><img  src="images/user_avatar.png" style="border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/></a>';
								}
								else{
									$rows = $result->fetch_assoc();
									echo '<img  src="images/userImages/'.$rows['photo'].'" style="border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;/>';
								}
							}
							else{
								echo '<a href="php/photo_upload.php"><img  src="images/user_avatar.png" style="border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/></a>';
							}


					echo '<ul class="list-group" style="list-style: none;">';
						echo '<h3>Your Personal Info</h3>';

						echo '<li class="list-group-item active">Name:&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$user['name'].'</b></li>
						<li class="list-group-item ">Email:&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$user['email'].'';
						if($user['email_verf'] == 0){
							echo "<strong style = 'width = 10px;' class='alert alert-danger'>&nbsp;&nbsp;&nbsp;&nbspnot verified</strong></b></li>";
						}
						else{
							echo "<strong width = '10px' class='alert alert-success'>&nbsp;&nbsp;&nbsp;&nbspverified</strong></b></li>";
						}
						$pass_star ="";
						for($i=0;$i<strlen($user['pass']);$i++){$pass_star = $pass_star."*";}
						echo '<li type="password" class="list-group-item *">Password:&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$pass_star.' 
						</b></li>';
						?>
						<center><button  id="personal_change_button" style="margin: 5px;" class="btn-primary">Change</button></center>
						<h6 style="display: none;" id="write_all_cell" class="alert alert-danger">If You want to Change Your Personal Info Please Complete The Form Below</h6>
					</ul>
					<br>
					<div style="display: none;" id="change_personal_info" class="col-md-15">
					<div class="col-md-15 animate-box">
					<h3>Change Your Personal Info</h3>
					<form method="post" action="?" autocomplete="off">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name</label>
								<input name="name" type="text" id="name" class="form-control" placeholder="Change your name">
							</div>
							
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<input name="email" type="text" id="email" class="form-control" placeholder="Change your email address">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="password">Old Password</label>
								<input name="old_pass" type="password" id="subject" class="form-control" placeholder="Type Your Old Password" >
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Your New Password</label>
								<input name="new_pass" type="password" id="message" class="form-control" placeholder="Type Your New Password">
							</div>
						</div>
						<div class="form-group">
							<input name="Sumbit" type="submit" value="Submit Changes" class="btn btn-primary">
						</div>
						<div id="personal_change_button_back" style=" display: none;" class="form-group">
							<input  value="Cancel Changes" class="btn btn-primary">
						</div>
					</form>		
				</div>
				</div>
			<div class="col-md-13">
			<h3>Your Applied Courses</h3>
			<?php       if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
					$ID = $_SESSION['ID'];
							$query = "Select * from applied natural join courses where ID = '$ID'";
						}
						else{
							$query = "SELECT * from courses NATURAL join (SELECT name as taught_by, course_id, ID as teacher_id from teachers NATURAL join teaches) as T limit 0,6";
						}
							//running query

							$results = $db->query($query) ;
							if($results->num_rows==0){ echo "<h2 class='alert alert-info'>You have not applied any Courses yet!</h2>";}
							else{
								for ($i=0;$i<$results->num_rows;$i++){
									$courses=$results->fetch_assoc();
									echo '<div class="col-lg-4 col-md-4 col-sm-6">
									<div  class="fh5co-card-item">
										<figure>
											<div class="overlay"><i class="ti-plus"></i></div>
											<img src="images/img_'.($i+1).'.jpg" alt="Image" class="img-responsive">
										</figure>
										<div class="fh5co-text">
											<h2>'.$courses['title'].'</h2>
											<p>Course ID: '.$courses['course_id'].'</p>
											<p>Course duration: '.$courses['duration'].'days</p>
											<p>Course cost: '.$courses['cost'].'Uzbek Soums</p>
											<a href = "delete_applied.php?course_id='.$courses['course_id'].'&title='.$courses['title'].'&duration='.$courses['duration'].'&cost='.$courses['cost'].'"><button id="cc'.$i.'" class="btn btn-primary" type="button">Cancel Application</button></a>
										</div>
									</div>
								</div>';
								}
							}
					 ?>
			</div>
			<br>
			<div class="col-md-10">
			<h3>Your Enrolled Courses</h3>
			<?php       if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
					$ID = $_SESSION['ID'];
							$query = "Select * from enrolled natural join courses where ID = '$ID'";
						}
						else{
							$query = "SELECT * from courses NATURAL join (SELECT name as taught_by, course_id, ID as teacher_id from teachers NATURAL join teaches) as T limit 0,6";
						}
							//running query

							$results = $db->query($query) ;
							if($results->num_rows==0){ echo "<h2 class='alert alert-info'>You have not enrolled any Courses yet!</h2>";}
							else{
								for ($i=0;$i<$results->num_rows;$i++){
									$courses=$results->fetch_assoc();
									echo '<div class="col-lg-4 col-md-4 col-sm-6">
									<div  class="fh5co-card-item">
										<figure>
											<div class="overlay"><i class="ti-plus"></i></div>
											<img src="images/img_'.($i+1).'.jpg" alt="Image" class="img-responsive">
										</figure>
										<div class="fh5co-text">
											<h2>'.$courses['title'].'</h2>
											<p>Course ID: '.$courses['course_id'].'</p>
											<p>Course duration: '.$courses['duration'].'days</p>
											<p>Course cost: '.$courses['cost'].'Uzbek Soums</p>
										</div>
									</div>
								</div>';
								}
							}
					 ?>
			</div>
			</div>
			<br>
			<br>
			<br>
		</div>
	</div>

<?php  
	require_once("footer.html");
	 ?>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<!-- Datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	

	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

