<?php
global $USER;
global $COURSE;

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_title("Request Help");
$PAGE->set_heading("Request Help");
$PAGE->set_url($CFG->wwwroot .'/local/helpform/helpform.php');

echo $OUTPUT->header();

$header_string = 'Helpform';

if (isguestuser()) {
	echo $OUTPUT->notification('The Help Form requires you to login');
				// $OUTPUT->confirm($message, $buttoncontinue, $buttoncancel).
	echo $OUTPUT->footer();
	die();
}


//Pick up some variables ent through hyperlinks in turnitin_view_amended.php
if (isset($_GET['link'])){
	$linker = $_GET['link'];
}else{
	$linker = '';
}

 // What page did they come from?
$ref = $_SERVER['HTTP_REFERER'];
$refturnitin = substr($ref,0,43);
if (($linker == "turnitin")or ($linker == 'tutor')or($refturnitin == $CFG->wwwroot ."/mod/turnitintool/") or ($refturnitin == $CFG->wwwroot ."/mod/turnitintool")){
	//Pick up some session variable sent from turnitin_view_amended.php
	$assignmentname = $_SESSION['assignname'];
	$coursename = $_SESSION['coursename'];
	$courseid = $_SESSION['courseid'];
	$tutorname = $_SESSION['ownername'];
	$tutoremail = $_SESSION['owneremail'];
}

echo '<style> #page-content{padding-top:20px;} .helpform{ width:100%; max-width: 800px; margin:auto;padding-right:10px; padding-left:10px;} textarea {width:95%;}</style>';
echo '<div class="helpform">';
// If the link from the help box is a turnitin.help request do this...
if ($linker == "turnitin") {
	echo'	<div style="width: 100%; margin-right: auto; margin-left:auto; font-size: 13px; "><h4>Request Technical help with turnitin</h4>
			</div>
			<div style="margin-right: auto; margin-left:auto; font-size: 13px;  ">
			Have you checked the <a  href="'. $CFG->wwwroot .'/turnitin-faq" target = "_blank"><strong>Frequently asked questions</strong></a> page for answers to your query?
			If you are having a technical problem with Turnitin please let us know.<br/>
			<a href = '.$ref.'>...back to the assignment page</a><br/><br/>
			Your Name: '.$USER->firstname.' '.$USER->lastname.'<br/>
			Assignment name: '.$assignmentname.'<br/>
			Unit Name:'.$coursename.'<br/>
			Tutor Name:'.$tutorname.'<br/> <br/>
			<form method="post" action="sendmail.php">
				Message:<br />
				<textarea cols="50" rows="10" name="message">
				</textarea ><br />
				<input type="hidden" name="ref" value="'.$ref.'"/>
				<input type="hidden" name="assignmentname" value="'.$assignmentname.'"/>
				<input type="hidden" name="coursename" value="'.$coursename.'"/>
				<input type="hidden" name="tutorname" value="'.$tutorname.'"/>
				<input type="hidden" name="sendto" value="turnitin.help@solent.ac.uk"/>
				<input type="hidden" name="studentid" value="'.$USER->id.'"/>
				<input type="hidden" name="courseid" value="'.$courseid.'"/>
				<input type="submit" Value="Request Help" />
			</form><br/>
			<font style= "font-size: 13px;"><a href = '.$ref.'><strong>(Click here to go back to the assignment page)</a></font>
			</div>';
// If the link from turnitin helpbox is a tutor request do this...
} elseif ($linker == 'tutor'){
  	echo'	<div style="margin-right: auto; margin-left:auto; font-size: 13px; "><h4>Contact your tutor for assignment support</h4>
			</div>
			<div style="margin-right: auto; margin-left:auto; font-size: 13px;  ">
			Have you checked the <a href="' . $CFG->dirroot . '/mod/resource/view.php?inpopup=true&id=175337" target = "_blank"><strong>Frequently asked questions</strong></a> page for answers to your query?<br/>
			<a href = '.$ref.'>...back to the assignment page</a><br/><br/>
			Your Name: '.$USER->firstname.' '.$USER->lastname.'<br/>
			Assignment name: '.$assignmentname.'<br/>
			Unit Name:'.$coursename.'<br/>
			Tutor Name:'.$tutorname.'<br/> <br/>
			<form method="post" action="sendmail.php">
				<strong>Message:</strong><br />
				<textarea cols="50" rows="10" name="message">
				</textarea><br />
				<input type="hidden" name="ref" value="'.$ref.'"/>
				<input type="hidden" name="assignmentname" value="'.$assignmentname.'"/>
				<input type="hidden" name="coursename" value="'.$coursename.'"/>
				<input type="hidden" name="tutorname" value="'.$tutorname.'"/>
				   <input type="hidden" name="tutoremail" value="'.$tutoremail.'"/>
				<input type="hidden" name="sendto" value="'.$tutoremail.'"/>
				<input type="hidden" name="studentid" value="'.$USER->id.'"/>
				<input type="hidden" name="courseid" value="'.$courseid.'"/>
				<input type="submit" Value="Request Help" />
			</form><br />
			<font style= "font-size: 13px;"><a href = '.$ref.'><strong>(Click here to go back to the assignment page)</a></font>
			</div>';

// If the request help link in the footer is clicked from a turnitin page do this...
}elseif (($refturnitin == "http://learn.solent.ac.uk/mod/turnitintool/") or ($refturnitin == $CFG->wwwroot ."/mod/turnitintool")){
	echo'	<div style=" margin-right: auto; margin-left:auto; font-size: 13px;"><h4>Request Technical help with turnitin</h4></div>
			<div style="margin-right: auto; margin-left:auto; font-size: 13px;">
			Have you checked the <a  href="' . $CFG->dirroot . '/mod/resource/view.php?inpopup=true&id=175337" target = "_blank"><strong>Frequently asked questions</strong></a> page for answers to your query? If you are having a technical problem with Turnitin please let us know. <br/>
			<a href = '.$ref.'>...back to the assignment page</a><br/><br/>
			Your Name: '.$USER->firstname.' '.$USER->lastname.'<br/>
			Assignment name: '.$assignmentname.'<br/>
			Unit Name:'.$coursename.'<br/>
			Tutor Name: '.$tutorname.'<br/><br/>
			<form method="post" action="sendmail.php">
				Message:<br />
				<textarea cols="50" rows="10" name="message">
				</textarea><br />
				<input type="hidden" name="ref" value="'.$ref.'"/>
				<input type="hidden" name="assignmentname" value="'.$assignmentname.'"/>
				<input type="hidden" name="coursename" value="'.$coursename.'"/>
				<input type="hidden" name="tutorname" value="'.$tutorname.'"/>
				<input type="hidden" name="studentid" value="'.$USER->id.'"/>
				<input type="hidden" name="sendto" value="turnitin.help@solent.ac.uk"/>
				<input type="hidden" name="courseid" value="'.$courseid.'"/>
				<input type="submit" Value="Request Help" />
			</form><br/>
			<font style= "font-size: 13px;"><a href = '.$ref.'><strong>(Click here to go back to the assignment page)</a></font>
			</div>';
//If it is any other page do this...
}else{
	echo'<div style=" margin-right: auto; margin-left:auto "><h4> Request Help Form</h4><br /></div>
		<div style="margin-right: auto; margin-left:auto; font-size: 13pxem;  ">
			If you are having a problem with ' . $SITE->fullname . ' let us know.
			We will receive an email with your details and try to respond within 1 working day.<br /><br />
			<form method="post" action="sendmail.php">
				Message:<br />
				<textarea cols="50" rows="10" name="message"></textarea><br />
				<input type="hidden" name="sendto" value="ltu@solent.ac.uk"/>
				<input type="hidden" name="ref" value="'.$ref.'"/>
				<input type="submit" Value="Request Help" />
			</form>
		</div>';
}

echo '</div>';
//put in your normal moodle footer:
echo $OUTPUT->footer();

?>
