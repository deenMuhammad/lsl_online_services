<?php
$ID = $_GET['ID'];
include("connect.php");

$result = $db->query("UPDATE messages_to_admin set seen = 1 where ID = '$ID' and answer is not NULL");
if($result){
    echo "Successful";
}
else{
    echo "Unsuccesful";
}