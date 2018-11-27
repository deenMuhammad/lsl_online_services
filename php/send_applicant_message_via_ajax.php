<?php
$ID = $_GET['ID'];
$subject = $_GET['about'];
$message = $_GET['message'];
include("connect.php");

$result = $db->query("INSERT messages_to_admin values('NULL', '$ID', '$message', NULL, '$subject', 0)");
if($result){
    echo "Successful";
}
else{
    echo "Unsuccesful";
}