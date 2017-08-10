<?php 
include('../functions.php');
if (!isset($_REQUEST['action'])){//checks action variable and kicks it to the post_entry function if its empty
Email_panel($owner="");
}else{
Manual_Mailer($owner="");	
	
}
####################################################################################################
#        Email_Panel                                                                               #
####################################################################################################
#purpose: A control panel for built-in reports
function Email_panel($owner)
{
    div_beg("id_menu");
    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    anchor("../../?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
    print "Page Under Construction";
    #######**************ADD Manual Email Function HERE
    
    p_end();

form_beg("actEmailAlert.php", "encmultipart/form-data", "mtdPOST");
    b_beg();
    echo "Enter Your Information:";
    b_end();
    p_beg();
       frm_label("forMailTo"); echo "To: \n";
       frm_input("typtext", "namMailTo", "siz50", "max50", "tab1");
       frm_label_end();
       br();
       frm_label("forMailSubject"); echo "Subject: \n";
       frm_input("typtext", "namMailSubject", "siz50", "max50", "tab2");
       frm_label_end();
       br();
	   frm_label("forMailBody"); echo "Body: \n";	
       frm_textarea("namMailBody", "row5", "col50", "tab12");frm_textarea_end();
       frm_label_end();
       br();
       
           
// ########Post Data to variables
       frm_input($nam="namaction", $typ="typsubmit", $val="valManualMail");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");       
       
	   form_end();    
}//endfunction
####################################################################################################
#        Manual Emailer                                                                            #
####################################################################################################
#purpose: Takes input from form and creates an email
function Manual_Mailer($owner)
{   
ini_set("smtp", "mail.peoriachristian.org");
ini_set("smtp_port", "25");
$MailTo = $_REQUEST['MailTo'];
$MailSubject = $_REQUEST['MailSubject'];
$MailHeader = 'From: webserver@peoriachristian.org';
$SuccessMsg = 'Your request for information has been forwarded to the Service Department.';
$FailureMsg = 'There has been a problem forwarding your request to the Service Department.
			Please resend your message.  We apologize for this 
			inconvenience.';
$IncompleteMsg = 'You left out some required data. <strong>Please click the Back button
			on your browser to return to the 
			Information Request Form.</strong> Then complete all required data and resubmit the form.
			It seems you did not complete the following: ';

$Data = 'Someone just posted a service request.'.
		'Here is what the requester submitted:'."\r\n\r\n".
		'###############Start of Record##################'. "\r\n\r\n";
function ListAll($aVal, $aKey, &$List)
{
	global $Incomplete;
	if(($aVal == '') && (stristr($_POST['Required'],$aKey)))
	{
		$Incomplete = $Incomplete.$aKey.', ';
	}
	$List = $List.$aKey.' = '.$aVal."\r\n";
}//endfunction

$Success = array_walk($_POST, 'ListAll', &$Data);
if($Success)
{
	if($Incomplete == '')
	{
		
		echo "$MailTo , $MailSubject , $Data , $MailHeader";
//		if(mail($MailTo,$MailSubject,$Data,$MailHeader))
//		{
//			echo "<p>$SuccessMsg</p>";
//			echo $Incomplete;
//		}
//		else
//		{
//			echo "<p>$FailureMsg (mail failure)</p>";
//		}//endif
	}
	else
	{
		echo "<p>$IncompleteMsg <br><br> $Incomplete</p>";
	}//endif
}
else
{	
	echo "<p>$FailureMsg (array_walk failure)</p>";
}//endif

    
    
}//endfunction


?>