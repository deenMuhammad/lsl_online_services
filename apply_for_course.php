<?php 

session_start();

$course_id = $_GET['course_id'];
$title = $_GET['title'];
$duration = $_GET['duration'];
$cost = $_GET['cost'];
$taught_by = $_GET['taught_by'];
$teacher_id = $_GET['teacher_id'];
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
	<title><?php echo "Apply for ".$title; ?></title>
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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style type="text/css">
	@media screen and (max-width: 968px) {
		.gtco-container{
			margin: 0px 15px 0px 15px;
		}
	}
	</style>

	</head>
	<body onload="typeWriter()">
		
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
							<span class="intro-text-small">Apply For this Course:</span>
							<h1><?php echo $title; ?></h1>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-14">
				<?php  
				echo '<ul class="list-group" style="list-style: none;">';
						echo '<h3>Course Information</h3>';

						echo '<li class="list-group-item active"><span class="glyphicon glyphicon-paperclip"></span> Course Name:&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$title.'</b></li>
						<li class="list-group-item "><span class="glyphicon glyphicon-qrcode"></span> Course ID:&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$course_id.'</b>';
						echo '<li class="list-group-item "><span class="glyphicon glyphicon-time"></span> Duration:<b>&nbsp;&nbsp;&nbsp;&nbsp;'.$duration.'&nbsp;days 
						</b></li>';
						echo '<li class="list-group-item "><span class="glyphicon glyphicon-usd"></span> Cost:<b>&nbsp;&nbsp;&nbsp;&nbsp;'.$cost.'&nbsp;Sums 
						</b></li>';
						echo '<li class="list-group-item "><span class="glyphicon glyphicon-user"></span> Taught by:<b>&nbsp;&nbsp;&nbsp;&nbsp;'.$taught_by.'&nbsp; 
						</b></li>';
						
						echo '<center><a href="commit_apply.php?course_id='.$course_id.'"><button style="margin: 5px;" class="btn btn-primary">Proceed to Apply</button></a></center>
						<h6 style="display: none;" id="write_all_cell" class="alert alert-danger">If You want to Change Your Personal Info Please Complete The Form Below</h6>';
						?>
					</ul>
					<br>
			</div>
			<div class="col-md-14">
				<?php  
				include("php/connect.php");
				$result = $db->query("SELECT * from teachers NATURAL join teacher_info where ID = '$teacher_id'");
				if(!$result){
					$_SESSION['message'] = "Failed to query while querying about teacher Info";
					header("location: php/error.php");
				}
				else{
					$row  = $result->fetch_assoc();
				echo '<ul class="list-group" style="list-style: none;">';
						echo '<h3>Teacher Information</h3>';
						echo '<li class="list-group-item active">';
						if($row['photo']==NULL){
							echo '<img  src="images/user_avatar.png" style="padding: 10px;text-align: center; border: 3px dashed #ccc; border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/>';
						}
						else{
							echo '<a href="images/teacherImages/'.$row['photo'].'" class="image-popup"><img  src="images/teacherImages/'.$row['photo'].'" style=" padding: 10px;text-align: center; border: 3px dotted #ccc; border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/></a>';
						}
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$row['name'].'</b></li>';
						echo '<li class="list-group-item "><span class="glyphicon glyphicon-phone"></span> Contact info:&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$row['contact'].'</b>';
						echo '<li class="list-group-item "><blockquote class="blockquote-reverse"><i><p id = "demo" onload="typeWriter()"></p></i><footer>LSL Edu.</footer></blockquote></li>';
						}//else done
						?>
						<h6 style="display: none;" id="write_all_cell" class="alert alert-danger">If You want to Change Your Personal Info Please Complete The Form Below</h6>
					</ul>
					<br>
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
	<script type="text/javascript">
		var i = 0;
		var txt = <?php echo '"'.$row['about'].'"';?>;
		var speed = 60;
		function typeWriter() {
		  if (i < txt.length) {
		    document.getElementById("demo").innerHTML += txt.charAt(i);
		    i++;
		    setTimeout(typeWriter, speed);
		  }
		}
	</script>

	</body>
</html>

