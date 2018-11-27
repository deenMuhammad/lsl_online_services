<?php 

session_start();
if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){//this block is executed if user has already signed up or signed in last time 
}
else {
	$_SESSION['message'] = "Please log in or sign up to write message to Administrator";
	header("location: php/error.php");
}
 ?>


<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Contact Us</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once("meta.html");?>

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
	<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>

	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body onload="seen_function()">
		
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
							<span class="intro-text-small">Don't be shy</span>
							<h1>Get In Touch</h1>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
					<h3>New Message to Administration:</h3>
					<form method = "post" action="php/send_applicant_message.php">
						<div class="row form-group">
							<div class="col-md-12">
								<h5>From:</h5>
								<input type="text" name="name" disabled id="name" class="form-control" <?php echo 'value = "'.$user['name'].'"'?>>
							</div>
							
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<input name = "email" disabled type="text" id="email" class="form-control" <?php echo 'value = "'.$user['email'].'"'?>>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label  for="subject">Subject:</label>
								<select name="subject" id ="about">
									<option value="About Course Registration" selected="selected">About Course Registration</option>
									<option value="About Teachers">About Teachers</option>
									<option value="About Courses">About Courses</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Message</label>
								<textarea name="message" id="message" cols="30" rows="10" maxlength = "999" class="form-control" placeholder="Write us something(max 1000 characters)"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Send Message" class="btn btn-primary">
							
						</div>

					</form>		
					<button onclick="send_message()" class="btn btn-primary">Send via Ajax</button>
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">
					
					<div class="gtco-contact-info">
						<h3>Your messages to Administration:</h3>
						<div id ="message_field">
							<?php
							include("php/connect.php");
							$ID = $_SESSION['ID'];
							$result = $db->query("SELECT * from messages_to_admin where ID = '$ID'");
							if($result){
								if($result->num_rows>0){
									$n = $result->num_rows;
									for($i=0;$i<$n;$i++){//fetching every messages of the user
										$row = $result->fetch_assoc();
										echo '<div style = "border-bottom: 2px dashed #aaffaa; margin : 2px;" >';
										echo '<form >';
										echo "<h5>".($i+1).". Message</h5>";
										echo '<textarea name="message" disabled id="message"  maxlength = "1000" class="form-control">'.$row['message'].'</textarea>';
										if($row['answer']!=NULL){//answered message
											echo "<h5>Answer:</h5>";
										echo '<textarea name="answer" disabled id="message" style = "background-color: beige" maxlength = "1000" class="form-control">'.$row['answer'].'</textarea>';
										}
										else{
											echo '<h5 class = "alert alert-info">Not yet responded!</h5>';
										}
										echo "</form>";
										echo "</div>";
									}
								}
								else{//no messages found belonging to user
									echo '<h5 class = "alert alert-info">You have not written any messages yet!</h5>';
								}
							}
							else{
								$_SESSION['message'] = "Failed while querying about user messages";
								header("location: php/error.php");
							}
							?>
						</div>
					</div>


				</div>
				</div>
			</div>
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
	<!-- Ajax Prototype-->
	<script src="js/ajax/ajaxPrototype.js"></script>
	<script src="js/ajax/ajaxUpdater.js"></script>
	<script src="js/ajax/ajaxPeriodicUpdater.js"></script>
	<!--Ajax function-->
	<script>
	var myDiv = document.getElementById("message_field");
	function onSuccess_forPeriodic(xhrResponse){
		alert("Update ongoing");
		myDiv.innerHTML=xhrResponse.responseText;
	}
	//call for ajax periodic updater
	var param = "ID="+<?php echo $_SESSION['ID'];?>;
	//setInterval(makeAjaxPeriodicUpdaterPrototype('message_field', "http://localhost:8888/lsl_application/php/update_message_field.php?"+param, "GET", param, onSuccess_forPeriodic, 1), 2000);

	//  new Ajax.PeriodicalUpdater('message_field', "http://localhost:8888/lsl_application/php/update_message_field.php?"+param, {
    //     method: "GET",
    //     frequency: 2,
    //     decay: 1,
    //     onSuccess: onSuccess_forPeriodic,
    //     onFailure: function(xhrResponse){
    //         alert("Failed to update!"+xhrResponse.statusText);
    //     }
	// });
	
	new Ajax.PeriodicalUpdater('message_field', "http://localhost:8888/lsl_application/php/update_message_field.php?"+param, {
            method: "GET",
            frequency: 1,
            //asynchronous: false,
            onSuccess: onSuccess_forPeriodic,
            onFailure: function(xhrResponse){
                alert("Failed to update!"+xhrResponse.statusText);
            }
        });

	function on_Succes(xhrResponse){
		myDiv.innerHTML=xhrResponse.responseText;
		document.getElementById("message").value = "";
		document.getElementById("message").focus();
	}

	function onSuccess(xhrResponse){
		param = "ID="+<?php echo $_SESSION['ID'];?>;
		makeAjaxUpdaterPrototype(myDiv, "http://localhost:8888/lsl_application/php/update_message_field.php?"+param, "GET", param, on_Succes);
	}
	function send_message(){
		param ="ID=" + <?php echo $_SESSION['ID'];?>;
		var e = document.getElementById ("about");
		var strUser = e.options[e.selectedIndex].value;
		param +="&about="+strUser; 
		param +="&message=" + document.getElementById("message").value;
		makeAjaxPrototype("http://localhost:8888/lsl_application/php/send_applicant_message_via_ajax.php?"+param, "GET", param, onSuccess);
	}
	function on_seen_success(xhrResponse){
		document.getElementById('messages_alert').innerHTML = "";
	}
	function seen_function(){
		param ="ID=" + <?php echo $_SESSION['ID'];?>;
		makeAjaxPrototype("http://localhost:8888/lsl_application/php/seen_messages_via_ajax.php?"+param, "GET", param, on_seen_success);
	}

	</script>

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

