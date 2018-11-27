<?php
$course_id = $_GET['course_id'];
$course_title = $_GET['title'];

include("connect.php");

$result = $db->query("SELECT name, email from applicant_photo natural join (select ID , name, email from applicant NATURAL join (SELECT * from enrolled where course_id = '".$course_id."') as T) as TT");
if($result){
    $row_application_array = array();
	for($num_of_application=0;$num_of_application<$result->num_rows;$num_of_application++){
		$row = $result->fetch_assoc();
		array_push($row_application_array,$row);
}
}
else{
    $_SESSION['messeage'] = "Query failed to query about pending application requests to course: ".$course_title;
    header("location: error.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<style>
#direction{
    display: block;
}
#motto{
    display:none;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

@media print {
    #direction{
        display: none;
    }
    #motto{
    display:block;
}
}
</style>
</head>
<body>
<h6  id="motto" style="float:right;">LSL Edu. "O'qish va Uqish Labaratoriyasi"</h6>
<br/>
<br/>
<br/>
<center><h2>Erolled student of<i> "<?php echo $course_title?>"</i></h2></center>

<table>
  <tr>
    <th>Name</th>
    <th>Contact Email</th>
  </tr>
  <?php
  for($i=0;$i<sizeof($row_application_array);$i++){
  echo '<tr>
    <td>'.$row_application_array[$i]['name'].'</td>
    <td>'.$row_application_array[$i]['email'].'</td>
    </tr>';
  }
  ?>
  
</table>

<center><h5 id = "direction">To Print Current Page Press keys: "CTRL+P" for Windows or "Command+P" for Mac OS/Linux OS </h5></center>
</body>
</html>
