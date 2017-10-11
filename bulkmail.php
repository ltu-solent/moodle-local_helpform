<?php
require_once("../../config.php") ;
require_login();	
global $USER;
global $COURSE;
	//SEND MYCOURSE EMAIL
$Name = "Learning Technology Unit (LTU)"; //senders name
$email = "LTU@Solent.ac.uk"; //senders e-mail adress
$recipient = "sarah.cotton@solent.ac.uk"; //recipient
//$mail_body = "VideoPlayer rejected a request for a video resource from a user outside of the UK.
//Video resource:$title.
//Name:$USER->firstname $USER->lastname.
//UserName:$USER->username.
//Department:$USER->department.
//Email:$USER->email.
//Tel:$USER->phone1.
//IP:$IPaddress.
//Location:$countryName."; //mail body
$Fullname = "Learning Technology Unit (LTU)"; //senders name
$subject = $SITE->fullname . " , Mahara, TurnItIn Support Contacts"; //subject
$header = "From: ". $Name . " <LTU@Solent.ac.uk>\r\n"; //optional headerfields  


//SEND MYCOURSE EMAIL
  $subject = "LTU MUNCH  (Luchtime training and awareness sessions)"; //subject
  $message = implode("|", $_SERVER);
 // $refpage = $_POST['ref'];
  $mailbody = $message;
mail($recipient, $subject, $mailbody, $header); 
//mail command :) 


    
 //print_header('Request Help', 'help form', 'Request Help',''  ,'' ,true );
					  // echo'<link rel="stylesheet" type="text/css" href="$thislink" />';
//thankyou////////////
//$thislink = $CFG->themewww .'/'. current_theme().'/style.php';
    // //put in standard moodle header:
	// echo '<div style = "width:300px; height:60px;margin-right: auto; margin-left:auto;"><h5>Thankyou for your message '.$Fullname.'.<br>
	      // An email has been sent to the recipient list</div></h5>
// <div style = "width:300px; height:60px;margin-right: auto; margin-left:auto;"><h5>
// <a href="'.$refpage.'">Click here</a> to return to the page you were viewing </div></h5>		  ';
    // //put in your normal moodle footer:
    // print_footer($course=NULL, $usercourse=NULL, $return=false);
?>