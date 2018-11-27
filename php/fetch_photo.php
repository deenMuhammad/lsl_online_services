<?php  

if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){
								include('connect.php');
								$ID = $_SESSION['ID'];
								$query = "SELECT photo FROM applicant_photo where ID = '$ID'";
								
								$result = $db->query($query);
								if($result->num_rows==0){
									echo 'images/user_avatar.png';
								}
								else{
									$rows = $result->fetch_assoc();
									header("content-type: image/jpeg");
									echo $rows['photo'];
								}
							}
							else{
								echo 'images/user_avatar.png';
							}


?>