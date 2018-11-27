<?php
							include("connect.php");
							$ID = $_GET['ID'];
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
                                echo '<h5 class = "alert alert-danger">Connection Error: Database Connection Error</h5>';
							}
	?>