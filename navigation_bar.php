<?php 
$unread_messages = 0;
$style = "";
if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
	include('php/connect.php');
	$ID = $_SESSION['ID'];
	$query = "SELECT COUNT(DISTINCT message_ID) as cnt from messages_to_admin where ID = '$ID' and seen = 0 and answer is not NULL";
	
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$unread_messages = $row['cnt'];
	if($unread_messages>0){
		$style = 'style = "border: 1px solid #41f47c; border-radius: 5px;"';
	}
	else{}
}
else {
	$unread_messages = 0;
}
?>

<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php"><img style="width: 25vh; height: 7vh" src="images/logo.png" /><em></em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="destination.php">About Us</a></li>
						<li class="has-dropdown">
							<a href="#">Courses</a>
							<ul class="dropdown">
								<li><a href="#">DTM</a></li>
								<li><a href="#">IELTS</a></li>
								<li><a href="#">SAT</a></li>
								<li><a href="#">ACT</a></li>
							</ul>
						</li>
						<li><a href="pricing.php">Pricing</a></li>
						<li <?php echo $style;?>><a  href="contact.php">Contact to Admin<p id = "messages_alert" style = "display: inline;"><span style="background:red; position:absolute;" class="badge badge-notify"><?php if($unread_messages!=0) echo $unread_messages; ?></span></p></a></li>
						<li><a href="php/admin_sign_in.php">Are you Admin?</a></li>
						<li>
							<?php
							echo "<br>";
							echo "<br>";
							if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
								include('php/connect.php');
								$ID = $_SESSION['ID'];
								$query = "SELECT photo FROM applicant_photo where ID = '$ID'";
								
								$result = $db->query($query);
								if($result->num_rows==0){
									echo '<a href="php/photo_upload.php"><img  src="images/user_avatar.png" style="padding: 10px;text-align: center; border: 3px dashed #ccc; border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/></a>';
								}
								else{
									$rows = $result->fetch_assoc();
									echo '<img  src="images/userImages/'.$rows['photo'].'" style=" padding: 10px;text-align: center; border: 3px dashed #ccc; border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/>';
								}
							}
							else{
								echo '<a href="php/photo_upload.php"><img  src="images/user_avatar.png" style="padding: 10px;text-align: center; border: 3px dashed #ccc; border-radius: 50%; width: 15vh; height: 15vh; display: inline-block;"/></a>';
							}

							if(isset($_SESSION['email']) AND !empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
								$email = $_SESSION['email'];
	                            $password = $_SESSION['password'];
	                            $ID = $_SESSION['ID'];
	                            include('php/connect.php');//connectiong into database

								//making appropriate query
								$query = "SELECT * FROM applicant WHERE email = '$email' AND pass = '$password' AND ID = '$ID'";
								//running query

								$results = $db->query($query) ;
								if($results->num_rows==0){
									$_SESSION['message'] = "No User Found";
									header("location: php/error.php");
								}
								$user = $results->fetch_assoc();

								echo '<h4 style=" margin: 5px 5px 5px 7px;display: inline-block; color: green;">'.$user['name'].'</h4>'."<br/>";
								echo '<a href="php/logout.php"><button style="margin: 5px 5px 5px 7px; display: inline-block;" id="" class="btn btn-primary">Log Out</button></a>';
						}
						else{
						echo 'not signed';
						echo '<a href="php/log_index.php"><button id="" class=" btn btn-primary">Log in</button></a>';
					}
							  ?>
						</li>
					</ul>	
				</div>
			</div>
			
		</div>
	</nav>