<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="php/logout.php"><img style="width: 25vh; height: 7vh" src="images/logo.png" /><em></em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
							<a href="application_requests.php"<li style = "display:inline-block;" ><i class="fas fa-hourglass-half"></i> Application Requests <p style="display: inline; background: #d4f142; color: black;border-radius:10% 40%; padding:3px; outline: none;border-color: #9ecaed;box-shadow: 0 0 10px #9ecaed;"><?php echo $pending_application_request;?></p></li></a>
                            <a href="show_admin_messages.php"<li style = "display:inline-block;"><i width="4px" height = "4px" class="far fa-envelope"></i> Messages <p style="display: inline; background: #d4f142; color: black;border-radius:10% 40%; padding:3px; outline: none;border-color: #9ecaed;box-shadow: 0 0 10px #9ecaed;"><?php echo $messages_to_admin;?></p></li></a>
							<a href="show_lsl_journal.php"<li style = "display:inline-block;"><i class="fas fa-address-book"></i> LSL Journal</li></a>
                            <a href="create_course.php"<li style = "display:inline-block;"><i class="fas fa-plus-circle"></i> Create Course</li></a>
						<li>
							<?php
							if(!isset($_SESSION["admin_state"])){
								header("location: php/logout.php");
							}
							else{ echo "";}
							echo "<br>";
							echo "<br>";
							if(isset($_SESSION['email']) AND !empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
								$email = $_SESSION['email'];
	                            $password = $_SESSION['password'];
	                            $ID = $_SESSION['ID'];
	                            include('php/connect.php');//connectiong into database

								//making appropriate query
								$query = "SELECT * FROM admin WHERE email = '$email' AND pass = '$password' AND ID = '$ID'";
								//running query

								$results = $db->query($query) ;
								if($results->num_rows==0){
									$_SESSION['message'] = "No User Found";
									header("location: php/error.php");
								}
								$user = $results->fetch_assoc();

								echo '<i class="fa fa-user-circle" style="font-size:24px"></i><h4 style=" margin: 5px 5px 5px 7px;display: inline-block; color: green;">'.$user['name'].'</h4>'."<br/>";
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