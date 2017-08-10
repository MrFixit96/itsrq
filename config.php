<?php
#####################################################################
#                                                                   #
#                     PHP CONFIGURATION FILE                        #
#
#         -list of functions/variables used to configure the
#     request system
#
#####################################################################

//CONNECTION INFO
$host="localhost";
$user="root";
$pw="mo29jo4s";
$database="service_requests";

//changes Department Name in logo and Email Form
$owner = "IT Services";


//fills the assigned to box
$srq_user= array("James Anderton", "Jason Miller");
//fills the error type box
$form_options_error_type = array("Power School Issue", "Network Outage", "Blocked Website", "Hardware Problem", "Banner Print Job", "Equipment Repair/Replace", "Software Installation", "Other");
//fills the windows version box
$form_options_windows_version = array("---SELECT ONE---", "Windows Vista", "Windows XP", "Windows 2000", "Not Applicable");
//fills the priority level box
$form_options_priority_level = array("---SELECT ONE---", "High (Requires immediate attention)", "Medium (Needs attention soon)", "Normal (Fix as Schedule Permits)");

//FUNCTION "REQUEST_EMAIL"
$admin_email_list ="janderton@peoriachristian.org, jmiller@peoriachristian.org";
$srq_user_email = array("jmiller", "janderton");//used to fill the email to field in the manual_mailer function... its only here in case its referenced accidentally.
$department = "The IT Services Department";

$admin_email_notification_subject = "IT Service Request Posted";
$external_email_notification_subject = "IT Service Request Confirmation";
$global_owner_email = "Peoria Christian IT Services <service_request@peoriachristian.org>";

$owner_email_beg_url = "http://". $_SERVER['HTTP_HOST'] . "/itsrq/IT_SRQ.php";

  ini_set("SMTP", "exchange.peoriachristian.org");
  ini_set("smtp_port", "25");

function email_from($assigned, &$email_from){
  //EMAIL FROM
  //  -chooses based on who the request was assigned to, which email address should be
  //      used as the sender or return address on the email to the user
  switch ($assigned){
    case $assigned == "James Anderton":  //send email from James Anderton
      $email_from = "janderton@peoriachristian.org";
      break;
    case $assigned == "Jason Miller":    //send email from Jason Miller
      $email_from = "jmiller@peoriachristian.org";
      break;
  }//end EMAIL_FROM switch
}//end function

function email_to($assigned, &$email_to){
  //EMAIL FROM
  //  -chooses based on who the request was assigned to, which email address should be
  //      used as the sender or return address on the email to the user
  switch ($assigned){
    case $assigned == "James Anderton":  //send email from James Anderton
      $email_to = "janderton@peoriachristian.org";
      break;
    case $assigned == "Jason Miller":    //send email from Jason Miller
      $email_to = "jmiller@peoriachristian.org";
      break;
  }//end EMAIL_TO switch
}//end function




?>