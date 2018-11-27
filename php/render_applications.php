<?php
session_start();
if(isset($_SESSION['email']) AND !empty($_SESSION['email']) AND isset($_SESSION['password']) AND !empty($_SESSION['password'])){
$num_applicants = $_POST['num_applicants'];
$results_array = array();
$course_id = $_POST['course_id'];
include("connect.php");
$result=$db->query("Select cost from courses where course_id = '$course_id'");
if($result){
    $row = $result->fetch_assoc();
    $cost_course = $row['cost'];
}
else{
    $_SESSION['message'] = 'Failed to query about the cost of the course';
    header('location: error.php');
}
for($i=0;$i<$num_applicants;$i++){
    array_push($results_array, explode("@", $_POST['result'.$i]));
}
for($i=0;$i<$num_applicants;$i++){
    $application_ID = $results_array[$i][0];
    $result=$db->query("DELETE from applied where ID = '$application_ID' and course_id = '$course_id'");//delete application from applied
    if($result){
        if($results_array[$i][1]=='accept'){//inserting application into enrolled if application is accepted
            $result=$db->query("INSERT into enrolled values('$application_ID', '$course_id')");
            if($result){ //if inserting into enrolled table is successful we have to calculate spent amount of the applicant 
                //first check if applicant has already enrolled in some courses
                $result=$db->query("Select total_spent_amount from spent where ID = '$application_ID'");
                if($result->num_rows>0){//applicant has enrolled some other courses before
                    $row = $result->fetch_assoc();
                    $new_total_amount = $row['total_spent_amount']+$cost_course;
                    $result=$db->query("update spent set total_spent_amount = '$new_total_amount' where ID = '$application_ID'");//updating the spent of an applicant who is accepted to the course
                    if($result){
                        echo "";
                    }
                    else{
                        $_SESSION['message'] = 'Failed to query about updating into spent applications';
                        header('location: error.php');
                    }
                }
                else{//applicant is getting first acceptance to enrolled
                    $result=$db->query("INSERT into spent values('$application_ID', '$cost_course')");
                    if($result){  echo "";}
                    else{
                        $_SESSION['message'] = 'Failed to query about inserting into spent applications';
                        header('location: error.php');
                    }
                }
            }
            else{
                $_SESSION['message'] = 'Failed to query about inserting into accepted applications';
                header('location: error.php');
            }
        }
        else{//inserting application into cancelled_application table if application is cancelled by administrator
            $result=$db->query("INSERT into cancelled_applications values('$application_ID', '$course_id')");
            if($result){ echo "";}
            else{
                $_SESSION['message'] = 'Failed to query about inserting into canelled applications';
                header('location: error.php');
            }
        }
    }
    else{
        $_SESSION['message'] = 'Failed to query about deleting from applied';
        header('location: error.php');
    }
}
}
else{
    $_SESSION['message'] = 'Please Log in as Administrator!';
    header('location: error.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Application Rendering...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body onload="Function()">
    <div class="jumbotron">
    <h2>All application for <b><?php echo $course_id?> has been rendered!</b></h2>
    <h3>Taking you to main Admin Page in <h2 id = "tick"></h2></h3>
    </div>
    <script>
    var i = 8;
    function Function(){
        setInterval(function(){ window.location.assign("http://localhost:8888/lsl_application/admin_index.php"); }, 7000);
        setInterval(function(){ document.getElementById("tick").innerHTML = i--; }, 1000);
    }
    </script>
</body>
</html>