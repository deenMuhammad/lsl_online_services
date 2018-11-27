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
$query = "SELECT * from courses";
$results = $db->query($query);
if($results->num_rows>0){
	$num_of_courses = $results->num_rows;
}
else{
	$num_of_courses = 0;
}
$query = "SELECT ID, name from teachers";
$results = $db->query($query);
if($results->num_rows>0){
    $teachers_array = array();
    for($k=0;$k<$results->num_rows;$k++){
        array_push($teachers_array, $results->fetch_assoc());
    }
}
else{
	$teachers_array = 0;
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
	<title>Create New Course</title>
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
							<span class="intro-text-small">LSL has <p style="display: inline; background: #d4f142; color: black;border-radius:10% 40%; padding:3px; outline: none;border-color: #9ecaed;box-shadow: 0 0 10px #9ecaed;"><?php echo $num_of_courses;?></p>  Courses</span>
							<span class="intro-text-small">Below You can create new courses!</span>	
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
					<h3>Create new Course:</h3>
					<form action="php/commit_create_course.php" method ="post">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Course Title</label>
								<input type="text" id="name" class="form-control" name = "title" placeholder="Course title">
							</div>
						</div>
                        <div class="row form-group">
                            <div class="col-md-12">
								<label class="sr-only" for="ID">Course ID</label>
								<input type="text" id="name" class="form-control" name = "course_id" placeholder="Course ID (Must be Unique)">
							</div>
						</div>
                        <div class="row form-group">
                            <div class="col-md-12">
								<label class="sr-only" for="cost">Course Cost</label>
								<input for = "number" type="text" id="name" class="form-control" name = "cost" placeholder="Course Cost (Must be number in Uzbek Soms)">
							</div>
						</div>
                        <div class="row form-group">
                            <div class="col-md-12">
								<label class="sr-only" for="ID">Course duration</label>
								<input type="text" id="name" class="form-control" name = "duration" placeholder="Course Duration (Must be numbers in days)">
							</div>
						</div>
                        <div class="row form-group">
							<div class="col-md-12">
								<label  for="teacher">Who teaches:</label>
								<select name="teacher_id" class = "btn" size="1">
                                <?php
                                for($l=0;$l<sizeof($teachers_array);$l++)
                                {
                                    echo '<option value="'.$teachers_array[$l]['ID'].'">'.$teachers_array[$l]['name'].'</option>';
                                }
                                ?>	
								</select>
								<label  for="teacher">Language:</label>
								<select name="lang" size="1">
								<option value="English">English</option>
								<option value="Uzbek">Uzbek</option>
								<option value="Korean">Korean</option>	
							</select>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name = "submit" value="Create" class="btn btn-primary">
						</div>

					</form>		
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

