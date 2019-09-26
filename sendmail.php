<?php
global $USER;
global $COURSE;

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_title("Send Mail");
$PAGE->set_heading("Send Mail");
$PAGE->set_url($CFG->wwwroot .'/local/helpform/sendmail.php');

echo $OUTPUT->header();

if (isguestuser()) {
	echo $OUTPUT->notification('The Help Form requires you to be logged in before sending a message.');
				// $OUTPUT->confirm($message, $buttoncontinue, $buttoncancel).
	echo $OUTPUT->footer();
	die();
}

	//SEND MYCOURSE EMAIL
$timesent =  date('l jS \of F Y h:i:s A');
$Name = $USER->username; //senders name
$email = $USER->email; //senders e-mail adress
$refpage = $_POST['ref'];// Referer page
//print_object($refpage);
if (isset ($_POST['coursename'])){
	$coursename = $_POST['coursename'];//coursename
}
if (isset ($_POST['assignmentname'])){
	$assignmentname = $_POST['assignmentname'];//assignmentname
}
if (isset ($_POST['tutorname'])){
	$tutorname  = $_POST['tutorname'];//ownername
}
if (isset ($_POST['tutoremail'])){
	$tutoremail  = $_POST['tutoremail'];//owneremail
}else{
	$tutoremail ='';
}
$sendwho  = $_POST['sendto'];//ownername
//echo $_POST['sendto'];
if (isset ($_POST['studentid'])){
	$studentid  = $_POST['studentid'];//studentid
}
if (isset ($_POST['courseid'])){
	$courseid  = $_POST['courseid'];//courseid
}
$refturnitin = substr($refpage,0,51);
if (isset ($_POST['courseid'])){
	$activity = $CFG->wwwroot .'/course/user.php?id='.$courseid.'&user='.$studentid.'&mode=alllogs';
}else{
	$activity = '';
}
//  if ($refturnitin == "http://learn.solent.ac.uk/mod/turnitintool/view.php"){
if($sendwho == 'turnitin.help@solent.ac.uk'){
	$recipient = $sendwho;
	$recipient2 = $USER->email;
	$subject = "Turnitin Help Request"; //subject
	$message = $_REQUEST['message'];
	$mailbody = $message . "\r\n\n" .

	"Time Sent: ". $timesent . "\r\n" .
	"Unit: " . $coursename . "\r\n" .
	"Tutor: " . $tutorname . "\r\n" .
	"Assignment: " . $assignmentname . "\r\n" .
	"Last page viewed: " . $refpage . "\r\n" .
	"Name: ". $USER->firstname . " " . $USER->lastname . "\r\n" .
	"Username: " . $USER->username . "\r\n" .
	"Department: " . $USER->department . "\r\n" .
	"Email: " . $USER->email . "\r\n" .
	"Tel: " . $USER->phone1;
	$mailbody2 = "This is confirmation that the following email has been sent by you to $recipient \r\n\n" . $message;

	$Fullname = $USER->firstname . " " . $USER->lastname; //senders name
	$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
	$header2 = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
}elseif($sendwho == $tutoremail){
	$recipient = $sendwho;
	$recipient2 = $USER->email;
	$subject = "Request for tutor help from turnitin"; //subject
	$message = $_REQUEST['message'];
	$mailbody = $message . "\r\n\n" .

	"Information regarding request for help:\r\n" .
	"Time Sent: ". $timesent . "\r\n" .
	"Unit: " . $coursename . "\r\n" .
	"Tutor: " . $tutorname . "\r\n" .
	"Assignment: " . $assignmentname . "\r\n" .
	"Last page viewed: " . $refpage . "\r\n" .
	"Name: " . $USER->firstname . " " . $USER->lastname . "\r\n" .
	"Username: " . $USER->username . "\r\n" .
	"Department: " . $USER->department . "\r\n" .
	"Email: " . $USER->email . "\r\n" .
	"Tel: " . $USER->phone1;
	$mailbody2 = "This is confirmation that the following email has been sent by you to $recipient \r\n\n" . $message;
	$Fullname = $USER->firstname . " " . $USER->lastname; //senders name
	// Additional headers
	$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
	$header2 = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
	$header .= 'To: '.$tutorname.'<'.$tutoremail.'>' . "\r\n";
	$header .= 'Bcc: turnitin.help@solent.ac.uk' . "\r\n";

}elseif ($sendwho == "ltu@solent.ac.uk"){
	$recipient = $sendwho;
	$recipient2 = $USER->email;
	$subject = "Feedback Form Results " . $SITE->fullname; //subject
	$message = $_REQUEST['message'];
	$mailbody = $message . "\r\n\n" .

	"Time Sent: " . $timesent . "\r\n" .
	"Last page viewed: " . $refpage . "\r\n" .
	"Name: " . $USER->firstname . " " . $USER->lastname . "\r\n" .
	"Username: " . $USER->username . "\r\n" .
	"Department: " . $USER->department . "\r\n" .
	"Email: " . $USER->email . "\r\n" .
	"Tel: ". $USER->phone1;
	$mailbody2 = "This is confirmation that the following email has been sent by you to $recipient \r\n\n" . $message;

	$Fullname = $USER->firstname . " " . $USER->lastname; //senders name
	$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
	$header2 = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
}

//SEND MYCOURSE EMAIL

mail($recipient, $subject, $mailbody, $header);
mail($recipient2, $subject, $mailbody2, $header2);
//mail command :)

echo '<style> #page-content{padding-top:20px;}</style>';
echo '<div style = "width:300px; height:60px;margin-right: auto; margin-left:auto;" margin-top:100px;>Thank you for your message '. $Fullname .'.<br>
	  An email has been sent to '. $recipient .'</div>
	  <div style = "width:300px; height:60px;margin-right: auto; margin-left:auto;">';
	  if($refpage == $CFG->dirroot .'/local/helpform/helpform.php'){
		echo '<a href="' . $CFG->dirroot .'/my">Click here</a> to return to the homepage</div>';
	  }else{
		echo '<a href="' . $refpage . '">Click here</a> to return to the page you were viewing </div>';
	  }
  //put in your normal moodle footer:
echo $OUTPUT->footer();
?>
