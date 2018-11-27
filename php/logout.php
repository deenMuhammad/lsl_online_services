<?php 
session_start();
unset($_SESSION['email']);
 unset($_SESSION['password']);
 unset($_SESSION['messsage']);
 unset($_SESSION['ID']);
 unset($_SESSION['name']);
 unset($_SESSION['admin_state']);
if(session_destroy()){
	header("location: ../index.php");
}
else{
	echo "could not destroy the session!";
}
 ?>}
}
