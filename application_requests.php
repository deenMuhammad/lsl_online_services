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

$result = $db->query("select * from (select course_id, title, cnt from courses NATURAL left join(SELECT course_id, count(course_id) as cnt from applied GROUP by course_id) as T ) as DT_ NATURAL join (SELECT course_id, photo from teaches NATURAL join (SELECT ID , photo from teachers) as S) as DT");
if($result){
	$row_course_array = array();
	for($num_of_course=0;$num_of_course<$result->num_rows;$num_of_course++){
		$row = $result->fetch_assoc();
		array_push($row_course_array,$row);
}
}
else{
	$_SESSION["Querying the database failed while querying application requests"];
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
	<title>Pending Application Requests</title>
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
							<span class="intro-text-small">To the best of your applicants' convenience</span>
							<h2>Accept or Cancel Following application requests!</h2>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	
	<div style="border-bottom:2px dashed #d4f142;" class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row" >
			<h1>Application requests by Courses: </h1>
			<br>
				<?php
				for($i = 0; $i<sizeof($row_course_array);$i++){ //check for bugs
					$rows = $row_course_array[$i];
					$num = 0;
					if($rows['cnt']>0){
						$num = $rows['cnt'];
					}
				echo '<div class="col-lg-4 col-md-4 col-sm-6">
				<div  class="fh5co-card-item">
					<figure>
						<div class="overlay"><i class="ti-plus"></i></div>';
						if($rows['photo']==NULL){//no photo of the course so default
							echo '<img src="images/user_avatar.png" alt="Image" class="img-responsive">';
						}
						else{
							echo '<img src="images/teacherImages/'.$rows['photo'].'" alt="Image" class="img-responsive">';
						}
						//<img src="images/'.jpg" alt="Image" class="img-responsive">
					echo '</figure>
					<div class="fh5co-text">
						<h2>'.$rows['title'].'</h2>
						<p>Course ID: <h6 style="display: inline; background: #d4f142; color: black;border-radius:10% 20%; padding:3px; outline: none;border-color: #ff0000;box-shadow: 0 0 10px #ff0000;">'.$rows['course_id'].'</h6></p>
						<p>New Applications: <h6 style="display: inline; background: #d4f142; color: black;border-radius:10% 40%; padding:3px; outline: none;border-color: #ff0000;box-shadow: 0 0 10px #ff0000;">'.$num.'</h6></p>
						<a href = "application_request_more.php?course_id='.$rows['course_id'].'&title='.$rows['title'].'"><button class="btn btn-primary" type="button">More</button></a>
					</div>
				</div>
			</div>';
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

