<?php
	require_once("MIMEContainer.class.php");
	require_once("MIMESubcontainer.class.php");
	require_once("MIMEAttachment.class.php");
	require_once("MIMEContent.class.php");
    require_once("MIMEMessage.class.php");
    
	$email = new MIMEContainer();
	$email->set_content_type("multipart/mixed");	
	$message = new MIMEMessage();
	$message->set_content("Hey, here's that file you wanted.\n\n--John");

	$attachment = new MIMEattachment("MIMEContainer.class.php");

	$email->add_subcontainer($message);
	$email->add_subcontainer($attachment);
	//$email->sendmail("john@php.net", "angiesue@example.com", "Here's the file");
	echo $email->get_message();
	
?>