<?php
session_start();

if(isset($_SESSION["admin_state"])){
	header("location: php/logout.php");
}
else{
if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){//this block is executed if user has already signed up or signed in last time 
	$email = $_SESSION['email'];
	$password = $_SESSION['password'];
	echo "<style>
	#sign-in-up-form{
	display:none;
}
	</style>";
	echo "<style>
		#signup_signin_done{
		display:block;
		}
	    </style>";
}
else{
	echo "<style>
		#signup_signin_done{
		display:none;
		}
	    </style>";

	    echo "<style>
	#sign-in-up-form{
	display:block;
}
	</style>";
}
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<link rel="icon" href="http://lsl.uztutor.com/images/icon.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LSL &mdash; O'qish va uqish labaratoriyasi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="LSL(Learning Skills Lab)" />
	<meta name="keywords" content="Your Bright future is with us! Courses education" />
	<meta name="author" content="LSL.UZTUTOR.COM" />

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
	
	<?php
        require_once('links.html');
    ?>
	
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
    $("#signin").click(function(){
    	 $("#signinform").fadeIn("slow");
        $("#signinform").css("display", "block");
        $("#signup").css("display", "block");
        $(this).css("display", "none");
        $("#signupform").css("display", "none");
    });
});
$(document).ready(function(){
    $("#signup").click(function(){
    	$("#signupform").fadeIn("slow");
    	$("#signin").css("display", "block");
    	$(this).css("display", "none");
        $("#signupform").css("display", "block");
        $("#signinform").css("display", "none");
    });
});
</script>
<style type="text/css">
	.button {
  border: 0;
  border-bottom: 1px red dashed;
  outline: none;
  border-radius: 0;
  padding: 15px 0;
  font-size: 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: #1ab188;
  color: #ffffff;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  -webkit-appearance: none;
}
.button:hover, .button:focus {
  background: #179b77;
}

.button-block {
  display: block;
  width: 100%;
}
#pass_warning{
	display:none;
}
#pass_again_warning{
    display: none;
}
</style>

	</head>
	<body onload="admin_function()">
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<?php
	require_once("navigation_bar.php");
	  ?>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<?php
							if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
								echo '<h1 style= "font-size: 6vh;">Welcome <br><i><b>'.$user['name'].'</b></i> !<br>We are more than happy to see you always!</h1>';
							}
								else{
							echo '<h1>Join LSL Family<br>Start Your Bright Future with Us!</h1>';
						}
							?>	
						</div>
						<div id="sign-in-up-form" class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							
						
							<div style="background-color: #09C6AB;" class="form-wrap"  id="signupform"><center><button id="signin" class="btn btn-primary " >Already Registered? Push Me!</button></center>
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Sign up for LSL:</h3>
											<p>It is easy!</p>
											<form id="form_sign_up" action="php/signup.php" method="POST">
												<div class="row form-group">
													<div class="col-md-12">
														Your Name:
														<input name="name" type="text" id="fullname" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														Email:
														<input id="email" name="email" placeholder="example@domain.com" required="" type="email" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														Create a password:
														<input id="password_input" type="password" name="password" required="" class="form-control">
														<p id="pass_warning" class="alert alert-danger"></p>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														Confirm Your Password:
														<input id="pass_again" type="password" id="repassword" name="repassword" required="" class="form-control">
														<p id="pass_again_warning" class="alert alert-danger"></p>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" value="Submit" name="submit_sign_up" style="width: 17vh; height: 6vh;" >
													</div>
												</div>
											</form>	
										</div>

										
									</div>

								</div>
							</div>
							<div class="form-wrap" style="background-color: #09C6AB; display: none;" id="signinform"><center><button id="signup" class="btn btn-primary " style="display: none; padding-left: 5px;" >Do You want to Register? Push Me!</button></center></center>
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Log in to your LSL Account:</h3>
											<form id="form_sign_in" action="php/signin.php" method="POST">
												<div class="row form-group">
													<div class="col-md-12">
														Enter Your Email:
														<input id="email" name="email" placeholder="Email" required="" tabindex="2" type="text" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														Enter Your password:
														<input type="password" id="password" placeholder="Password" name="password" required="" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" value="Submit" name="submit_sign_in" style="width: 17vh; height: 6vh;">
													</div>
												</div>
											</form>	
										</div>

										
									</div>
									
								</div>
							</div>
						</div>
						<div id="signup_signin_done" class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<?php 
							include('php/connect.php');//connectiong into database

							//making appropriate query
							$query = "SELECT title from applied natural join courses where ID = '$ID'";
							//running query

							$results = $db->query($query) ;
							if($results->num_rows==0){
								$applied_courses = array("None");
							}
							else{
								$applied_courses = array();
								for ($i=0;$i<$results->num_rows;$i++){
								    $courses=$results->fetch_assoc();
									array_push($applied_courses,$courses['title']);
								}	
							}
							$query = "SELECT title from enrolled natural join courses where ID = '$ID'";
							//running query

							$results = $db->query($query) ;
							if($results->num_rows==0){
								$enrolled_courses = array("None");
							}
							else{
								$enrolled_courses = array();
								for ($i=0;$i<$results->num_rows;$i++){
								    $courses=$results->fetch_assoc();
									array_push($enrolled_courses,$courses['title']);
								}	
							}
							 ?>
							 <div class="form-wrap"  id="signupform">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>LSL Personal info:</h3>
											<?php 
											echo '<h4 style="display: inline-block; color: green;">Name: <b>'.$user['name'].'</b></h4>'."<br/>";
											echo '<h4 style="display: inline-block; color: blue;">'."Applied Courses:".'</h4>'."<br/>"; 
											echo "<ul>";
											foreach ($applied_courses as $key => $value) {
												echo "<li>".$value."</li>";
											}
											echo "</ul>";
											echo '<h4 style="display: inline-block; color: blue;">'."Enrolled Courses:".'</h4>'."<br/>"; 
											echo "<ul>";
											foreach ($enrolled_courses as $key => $value) {
												echo "<li>".$value."</li>";
											}
											echo "</ul>";
											?>
										</div>

										
									</div>

</div>
								</div>

							 <a href="manage_account.php"><button id="" class="button button-block">Manage Account</button></a>
							 <a href="php/logout.php"><button id="" class="button button-block" >Log Out</button></a>
						</div>
					</div>
							
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Most Popular Courses</h2>
					<p>Please get aware of our newly featured courses.</p>
				</div>
			</div>
			<div class="row">
				<?php       if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
					$ID = $_SESSION['ID'];
							$query = "SELECT * from courses NATURAL join (SELECT name as taught_by, course_id, ID as teacher_id from teachers NATURAL join teaches) as T where course_id not in (select course_id from applied where ID = '$ID') AND course_id not in (select course_id from enrolled where ID = '$ID')";
						}
						else{
							$query = "SELECT * from courses NATURAL join (SELECT name as taught_by, course_id, ID as teacher_id from teachers NATURAL join teaches) as T";
						}
							//running query

							$results = $db->query($query) ;
							if($results->num_rows==0){}
							else{
								$nn = $results->num_rows;
								for ($i=0;$i<$nn;$i++){

									$courses=$results->fetch_assoc();
									echo '<div class="col-lg-4 col-md-4 col-sm-6">
									<div  class="fh5co-card-item">
										<figure>
											<div class="overlay"><i class="ti-plus"></i></div>
											<img src="images/img_'.(($i+1)%6+1).'.jpg" alt="Image" class="img-responsive">
										</figure>
										<div class="fh5co-text">
											<h2>'.$courses['title'].'</h2>
											<p>Course ID: '.$courses['course_id'].'</p>
											<p>Course duration: '.$courses['duration'].'days</p>
											<p>Taught by: '.$courses['taught_by'].'</p>
											<p>Course cost: '.$courses['cost'].'Uzbek Soums</p>
											<a href = "apply_for_course.php?course_id='.$courses['course_id'].'&title='.$courses['title'].'&duration='.$courses['duration'].'&cost='.$courses['cost'].'&taught_by='.$courses['taught_by'].'&teacher_id='.$courses['teacher_id'].'"><button id="cc'.$i.'" class="btn btn-primary" type="button">Apply</button></a>
										</div>
									</div>
								</div>';
								}
							}
					 ?>
				<!-- <div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/img_1.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/img_1.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>New York, USA</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/img_2.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/img_2.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Seoul, South Korea</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/img_3.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/img_3.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Paris, France</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
				</div>


				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/img_4.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/img_4.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Sydney, Australia</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/img_5.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/img_5.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Greece, Europe</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/img_6.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/img_6.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Spain, Europe</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
				</div> -->

			</div>
		</div>
	</div>
	
	<div id="gtco-features">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>How It Works</h2>
					<p>We care about every applicant as our member of LSL Family. Below you can see how to become active member of our Family</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>1</i>
						</span>
						<h3>Sign Up</h3>
						<p>Sign Up as new applicant. It takes few steps to become new member: Sign Up -> Verify your email -> and welcome!</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>2</i>
						</span>
						<h3>Enjoy Functionalities</h3>
						<p>LSL online site offers you distant application to courses, online test, knowing result online, and directly messaging to LSL administration online</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>3</i>
						</span>
						<h3>Responsible Administration</h3>
						<p>LSL Administration enrolls you to the course you applied and took placement test in LSL main Campus! Instant responses any inquiries!.</p>
					</div>
				</div>
				

			</div>
		</div>
	</div>


	<div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>We have high quality services that you will surely love!</h1>
				</div>	
			</div>
		</div>
	</div>

	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Our Success</h2>
					<p>Learning Skills Lab has been offering  online services for very short time. However, LSL offline family has bocome much wider than you think!</p>
				</div>
			</div>

			<div class="row">
				
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="10" data-speed="2000" data-refresh-interval="50">1</span>
						<span class="counter-label">Fields</span>

					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="20" data-speed="3000" data-refresh-interval="50">1</span>
						<span class="counter-label">Courses</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="1000" data-speed="4000" data-refresh-interval="50">1</span>
						<span class="counter-label">Family Members</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="500" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Members overseas</span>

					</div>
				</div>
					
			</div>
		</div>
	</div>

	

<div id="gtco-subscribe">
		<div class="gtco-container">

			<?php  
					if (isset($_SESSION['email']) AND! empty($_SESSION['email'])) {
						$email=$_SESSION['email'];
						$result = $db->query("SELECT * from mailing_list where email = '".$email."'");
						if($result->num_rows>0){
							echo '<div class="row animate-box">
								<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
									<h2>LSL News Feed</h2>
									<p>You have already subscribed to our News Feed.</p>
								</div>
							</div>
							<div class="row animate-box">
								<div class="col-md-8 col-md-offset-2">
									<form class="form-inline" action="php/unsubscribe.php" method="GET">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label for="email" class="sr-only">Email</label>
												<input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="'.$email.'" required="required">
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
											<button type="submit" class="btn btn-default btn-block">Unsubscribe</button>
										</div>
									</form>
								</div>
							</div>';
						}
						else{
							echo '<div class="row animate-box">
									<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
										<h2>Subscribe</h2>
										<p>Be the first to know about the new courses offered.</p>
									</div>
								</div>
								<div class="row animate-box">
									<div class="col-md-8 col-md-offset-2">
										<form class="form-inline" action="php/subscribe.php" method="POST">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="email" class="sr-only">Email</label>
													<input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="'.$email.'" required="required">
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<button type="submit" class="btn btn-default btn-block">Subscribe</button>
											</div>
										</form>
									</div>
								</div>';
						}
					}
					else{
						echo '<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Subscribe</h2>
					<p>Be the first to know about the new courses offered.</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline" action="php/subscribe.php" method="POST">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input name="email" type="email" class="form-control" id="email" placeholder="Your Email" required="required">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<button type="submit" class="btn btn-default btn-block">Subscribe</button>
						</div>
					</form>
				</div>
			</div>';
					}
					?>



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

	<script type="text/javascript">
	
	var myPassInput = document.getElementById('password_input');
	var warning = "You have to create at least 6 characters password!";
	var pass_again = document.getElementById('pass_again');
	var warning_pass_not_duplicate = "You have typed two different passwords!";
	myPassInput.addEventListener('blur', function(e){
			if(myPassInput.value.length<6 || myPassInput.value.length>15){
				document.getElementById('pass_warning').style.display="block";
				document.getElementById('pass_warning').innerHTML="";
				var i = 0;
				var txt = "You have to create at least 6, and at most 15 character password!";
				var speed = 50;
				setTimeout(typeWriter, speed);
				function typeWriter() {
				if (i < txt.length) {
					document.getElementById("pass_warning").innerHTML += txt.charAt(i);
					i++;
					setTimeout(typeWriter, speed);
				}
				}
				myPassInput.focus();
			}
			else{
				document.getElementById('pass_warning').style.display="none";
			}
	}, );
	
	pass_again.addEventListener('blur', function(e){
			if(pass_again.value != myPassInput.value){
				document.getElementById('pass_again_warning').style.display="block";
				document.getElementById('pass_again_warning').innerHTML="";
				var i = 0;
				var txt = warning_pass_not_duplicate;
				var speed = 50;
				setTimeout(typeWriter, speed);
				function typeWriter() {
				if (i < txt.length) {
					document.getElementById("pass_again_warning").innerHTML += txt.charAt(i);
					i++;
					setTimeout(typeWriter, speed);
				}
				}
				myPassInput.focus();
			}
			else{
				document.getElementById('pass_again_warning').style.display="none";
			}
	}, );
	
		function myFunction(id) {
			document.getElementById("cc"+id.toString()).innerHTML = "Applied";
		}

		function loadDoc(course_id, id) {
			var xhttp;
			xhttp=new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  myFunction(id);
			}
			};
			xhttp.open("GET", "http://localhost:8888/lsl_appliation/apply_course.php?course_id="+course_id, true);
			xhttp.send();
		}
		var color = ["red,", "pink", "green","#dd00aa", "blue"];
		var border =["dotted","dashed","dotted","dashed" ];
		var i = 0;
		var j = 0;
		
		function admin_function(){
		    var signin_button = document.getElementById('signin');
		    var former_col = signin_button.style.backgroundColor;
		    var former_font_size = signin_button.style.fontSize;
		    var new_font_size = former_font_size+17;
		    setTimeout(function(){signin_button.style.backgroundColor = "#42f4f4";}, 700);
		    setTimeout(function(){signin_button.style.fontSize = new_font_size;}, 700);
		    setTimeout(function(){signin_button.style.backgroundColor = "#41f4d0";}, 1400);
		    setTimeout(function(){signin_button.style.backgroundColor = former_col;}, 2100);
		    setTimeout(function(){signin_button.style.fontSize = former_font_size;}, 2100);
		    setInterval(function(){
		    setTimeout(function(){signin_button.style.backgroundColor = "#42f4f4";}, 700);
		    setTimeout(function(){signin_button.style.fontSize = new_font_size;}, 700);
		    setTimeout(function(){signin_button.style.backgroundColor = "#41f4d0";}, 1400);
		    setTimeout(function(){signin_button.style.backgroundColor = former_col;}, 2100);
		    setTimeout(function(){signin_button.style.fontSize = former_font_size;}, 2100);}, 10000);
			document.getElementById("admin_btn").style.backgroundColor="red";
			setInterval(function(){ document.getElementById("admin_btn").style.background=color[i++]; }, 1000);
			setInterval(function(){ document.getElementById("admin_btn").style.borderStyle=border[j++]; }, 200);
			setInterval(function(){ i=0; }, 5000);
			setInterval(function(){ j=0; }, 800);
			setInterval(function(){ document.getElementById("admin_btn").style.backgroundColor="red"; }, 10000);
		}
	</script>

	</body>
</html>

