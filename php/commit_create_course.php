<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_SESSION['email']) AND! empty($_SESSION['email']) and isset($_SESSION['password']) AND !empty($_SESSION['password'])){//this block is executed if user has already signed up or signed in last time 
    if(isset($_POST['submit'])){
        $title = ($_POST['title']);
        $course_id = $_POST['course_id'];
        $cost = $_POST['cost'];
        $duration = $_POST['duration'];
        $teacher_id = $_POST['teacher_id'];
        include("connect.php");
        $query = "INSERT courses values('$course_id', '$title', '$cost', '$duration')";
        $result = $db->query($query);
        if($result){
            $query = "INSERT teaches values('$teacher_id','$course_id')";
            $result = $db->query($query);
            if($result){
                                
                //sending news feed to users


                require 'vendor/autoload.php';

                $email = $_POST['email'];


                include("connect.php");
                $query = "SELECT name FROM teachers where ID = '$teacher_id'";
                    //running query

                $results = $db->query($query);
                if(!$results){
                    $_SESSION['message'] = "DB Connection Error: Error occured while querying  teacher name!";
                    header("location: error.php");
                }
                else{
                    $row = $results->fetch_assoc();
                    $taught_by = $row['name'];
                }


                $query = "SELECT email FROM mailing_list";
                    //running query

                $results = $db->query($query);
                if(!$results){
                    $_SESSION['message'] = "DB Connection Error: Error occured while querying mailing list!";
                    header("location: error.php");
                }
                else{
                    $num_rows = $results->num_rows;
                    $mailing_list_array = array();
                    for($i = 0;$i<$num_rows;$i++){
                        $row = $results->fetch_assoc();
                        array_push($mailing_list_array, $row['email']);
                    }
                }


                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'zorro199696@gmail.com';                 // SMTP username
                    $mail->Password = '+1587455';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('zorro199696@gmail.com', 'DeenMuhammad');
                    
                    for($i=0;$i<$num_rows;$i++){
                        $mail->addAddress($mailing_list_array[$i]);     // Add a recipient            // Name is optional
                    }

                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');

                    // //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    $mail->addAttachment('logo.png', 'new.png');    // Optional name
                                        $body = "<center><h2>LSL News</h2>
                    <img src ='http://lsl.uztutor.com/images/logo.png'/>
                    <strong>Thank You for staying up with LSL</strong>
                    <strong>LSL has added a new Course!<br></strong>
                    <strong><br>Get to know it!</strong>
                    <br/>
                    <table style = 'border-bottom: 0px solid black;'>
                    <tr>
                    <td>Title:<td>
                    <td>".$title."<td>
                    </tr>
                    <tr>
                    <td>Course ID:<td>
                    <td>".$course_id."<td>
                    </tr>
                    <tr>
                    <td>Course Cost:<td>
                    <td>".$cost." Soums<td>
                    </tr>
                    <tr>
                    <td>Course Duration:<td>
                    <td>".$duration." Days<td>
                    </tr>
                    </table>
                    <strong><br>Please </strong>
                    <a href='http://lsl.uztutor.com/apply_for_course.php?course_id=".$course_id."&title=".$title."&duration=".$duration."&cost=".$cost."&taught_by=".$taught_by."&teacher_id=".$teacher_id."'>Click here to see more about course!</a>
                    </center>";
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'LSL Random Password Setting!';
                    $mail->Body    = $body;
                    $mail->AltBody = stripslashes($body);

                    $mail->send();
                } catch (Exception $e) {
                    $_SESSION['message'] = "Failed to Send Send Random Password Setting email: ".$mail->ErrorInfo;
                    header("location: error.php");
                }



                //sending news feed to users is done
            }
            else{
                $_SESSION['message'] = "Failed to query while querying to insert in teaches table!";
                header("location: error.php");
            }
        }
        else{
            $_SESSION['message'] = "Failed to query while querying to insert new course to courses!";
            header("location: error.php");
        }
    }
    else{
        header("location: ../show_admin_messages.php");
    }
}
else{
    $_SESSION['message'] = "Please Log in as admin";
    header("location: error.php");
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
    <h2>You have added new course!</h2>
    <h3>Taking you to create new course page in <h2 id = "tick"></h2></h3>
    </div>
    <script>
    var i = 8;
    function Function(){
        setInterval(function(){ window.location.assign("http://localhost:8888/lsl_application/create_course.php"); }, 7000);
        setInterval(function(){ document.getElementById("tick").innerHTML = i--; }, 1000);
    }
    </script>
</body>
</html>