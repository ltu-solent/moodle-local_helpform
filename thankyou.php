<?php

require_once("../../config.php") ;
require_login();
	
global $USER;
global $COURSE;
	//SEND MYCOURSE EMAIL
$Fullname = "$USER->firstname $USER->lastname"; //senders name
$email = "$USER->email"; //senders e-mail adress
$recipient = "ltu@solent.ac.uk"; //recipient
$subject = "Feedback Form Results"; //subject
$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields  
    
    //put in standard moodle header:
    print_header('Request Help', 'help form', 'Request Help',''  ,'' , false );
	
	echo '<div style = "width:300px; height:200px;margin-right: auto; margin-left:auto;">Thankyou for your message '.$Name.'.<br>
	      An email has been sent to ltu@solent.ac.uk</div>';
	    //put in your normal moodle footer:


	   print_footer();
	//header( 'refresh: 1; url='.$ref);

?>