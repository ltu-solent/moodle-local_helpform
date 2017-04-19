<?php
//Check user has logged in
require_once('../../config.php');

require_login();

$mymoodlestr = get_string('mymoodle','VideoResource');
$header_string = 'Video Resources';

if (isguest()) {
	$wwwroot = $CFG->wwwroot.'/login/index.php';
	if (!empty($CFG->loginhttps)) {
		$wwwroot = str_replace('http:','https:', $wwwroot);
	}

	print_header($header_string);
	notice_yesno('This Video Resource requires you to login.<br /><br />'.get_string('liketologin'),
				 $wwwroot, $CFG->wwwroot);
	print_footer();
	die();
require_once('../../config.php');
//SEND MYCOURSE EMAIL
$Name = "$USER->username"; //senders name
$email = "$USER->email"; //senders e-mail adress
$recipient = "ltu@solent.ac.uk"; //recipient
//$mail_body = "VideoPlayer rejected a request for a video resource from a user outside of the UK.
//Video resource:$title.
//Name:$USER->firstname $USER->lastname.
//UserName:$USER->username.
//Department:$USER->department.
//Email:$USER->email.
//Tel:$USER->phone1.
//IP:$IPaddress.
//Location:$countryName."; //mail body
$subject = "Feedback Form Results"; //subject
$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields    
	}
	print_header();

echo'	
<form method="post" action="sendmail.php">
  Message:<br />
  <textarea name="message" rows="15" cols="40">
  </textarea><br />
  <input type="submit" />
</form>';
print_footer();

?>