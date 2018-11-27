<?php 

session_start();

include("php/connect.php");

$query = "SELECT * from applied";
$results = $db->query($query);
if($results->num_rows>0){
	$pending_application_request = $results->num_rows;
}
else{
	$pending_application_request = 0;
}

$query = "SELECT * from messages_to_admin where answer is NULL";
$results = $db->query($query);
if($results->num_rows>0){
	$messages_to_admin = $results->num_rows;
}
else{
	$messages_to_admin = 0;
}
$result = $db->query("Select * from messages_to_admin natural join applicant where answer is NULL");
if($result){
	$row_messages_array = array();
	for($num_of_course=0;$num_of_course<$result->num_rows;$num_of_course++){
		$row = $result->fetch_assoc();
		array_push($row_messages_array,$row);
}
}
else{
	$_SESSION["Querying the database failed while querying applicant messages to administration"];
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
	<title>Admin Page</title>
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

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<?php
	require_once("admin_navbar.php");
	  ?>

	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">

						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<h2>Dear <?php echo $user['name'];?></h2>
							<span class="intro-text-small">Currently:</span>
							<span class="intro-text-small"> <p style="display: inline; background: #d4f142; color: black;border-radius:10% 40%; padding:3px; outline: none;border-color: #9ecaed;box-shadow: 0 0 10px #9ecaed;"><?php echo $messages_to_admin;?></p>  Messages from Applicants</span>
							<span class="intro-text-small">Are Pending for your kind responses!</span>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
            <h1>Messages from Applicants: </h1>
            <?php
            if(sizeof($row_messages_array)==0){
                echo '<h2 class = "alert alert-info">No one has asked anything recently!</h2>';
            }
            else{
            for($i = 0; $i<sizeof($row_messages_array);$i++){
                echo '<div style = "border-bottom: 2px dashed #aaffaa; margin : 2px 2px 50px 2px;" >';
				echo '<form method ="post" action = "php/submit_admin_answer.php" >';
                echo "<h5>".($i+1).". Message</h5>";
                echo '<input style="display:none" name = "message_ID" class="form-control" type = "text" value = "'.$row_messages_array[$i]['message_ID'].'">';
                echo '<input disabled id="name" class="form-control" type = "text" value = "'.$row_messages_array[$i]['name'].'">';
                echo '<input disabled id="name" class="form-control" type = "text" value = "Subject: '.$row_messages_array[$i]['subject'].'">';
                echo '<textarea name="message" style="color: rgb(100,200,100);" disabled id="message"  maxlength = "1000" class="form-control">'.$row_messages_array[$i]['message'].'</textarea>';
                echo '<textarea name="answer"  id="message"  maxlength = "1000" class="form-control" placeholder = "Please write answer here and submit(Max 1000 characters!)"></textarea>';
                echo '<input style="float:right;" name="submit" type="submit" value="Submit Answer" class="btn-primary">';
        		echo "</form>";
			    echo "</div>";
            }
        }
                ?>
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

