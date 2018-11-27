<?php
$db=new mysqli("localhost","root","root","lsl_application");
// Check connection
if (!$db)
  {
  die("Connection error: " . mysqli_connect_error());
  }
?>