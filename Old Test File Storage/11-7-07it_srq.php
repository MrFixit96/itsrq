<?php

#Include Modules used

//CREATE CONFIG.PHP FILE FOR USERS/OWNERS AND OTHER STUFF
session_start();
if (!isset($_SESSION["username"])) {
  if (isset($_REQUEST['post_ID'])){
    $postid = "&post_ID=" . urlencode($_REQUEST['post_ID']);
  }
  else{
    $postid = "";
  }
  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . $postid);
}


include 'functions.php';     #imports a library of functions for echoing html code
include 'config.php';        #CONFIGURATION FILE FOR SERVICE REQUEST SYSTEM
include 'htmlMimeMail5.php'; #contains the functions, objects, and classes to be able to send mime encoded emails
include 'email_action.php';  #contains the email_action function to email users and admins
include 'view_request.php';  #contains the view_request function so that a link can be emailed to the user directly to the request.

/*
CONFIG.PHP NOW CONTAINS ALL THE INFORMATION THAT WAS ONCE STORED IN THESE FILES, EVEN THOUGH THEY REMAIN IN EXISTANCE

include 'connections.php';   #imports connections settings for database usage
include 'users.php';         #imports array of names for "Assigned To:" list - CREATES srq_user ARRAY
include 'notify.php';        #imports array of users to send email alerts on new requests
*/



#########################################################################################
#	Variables	                                                                #
#########################################################################################
//Purpose: To declare variable at the program level scope


//PUT THE BELOW CONNECTION STUFF IN CONFIG.PHP?????????????????????????????????????????????????????????????????????????????
  # Create a new database connection and make $database the current db
$db_connection = mysqli_connect($host,$user,$pw,$database);
$db_connection = new mysqli($host,$user,$pw,$database);

/*if(!isset($_REQUEST["formloaded"])){
  $action = "";
  $name = "";
  $assetNumber = "";
  $errorType = "";
  $email = "";
  $description = "";
  $priorityLevel = "";
  $OS = "";
  $record = "";
  $status = "";
  $RegID = "";
  $assigned = "";
  $timeStart= "";
  $timeStop = "";
  $resolution = "";
  $iTask = "";
} */

# Get the list of parameters passed by html form
$action = $_REQUEST['action'];
$name = $_REQUEST['name'];
$assetNumber = $_REQUEST['assetNumber'];
$errorType = $_REQUEST['errorType'];
$email = $_REQUEST['email'];
$description = $_REQUEST['description'];
$priorityLevel = $_REQUEST['priorityLevel'];
$OS = $_REQUEST['OS'];
$record = $_REQUEST['record'];
$status= $_REQUEST["status"];
$RegID= $_REQUEST["RegID"];
$assigned= $_REQUEST["assigned"];
$timeStart= $_REQUEST['timeStart'];
$timeStop= $_REQUEST["timeStop"];
$resolution= $_REQUEST["resolution"];
$iTask= $_REQUEST["Post Task"];
#$user = null;
#$pass = $_REQUEST['pass'];
#$loginID= $_REQUEST['loginID'];
#$loggedIN = "0";
#$cookie1;
#$cookie2;

#########################################################################################
#	                                  MAIN                                                #
#########################################################################################
#Purpose: Starts program

####################################################
#           Test SQL Connection
#####################################################

/* check connection */
if (!$db_connection) {
    die("Could not connect: " . mysql_error());
}//endif
//echo "Connected successfully";//for debugging
/* check database connected */
if ($result = mysqli_query($db_connection, "SELECT DATABASE()")) {
    $row = mysqli_fetch_row($result);
    //printf("Default database is %s.\n", $row[0]);//for debugging
    mysqli_free_result($result);} else{
    die ("Can't use $database : " . mysql_error());
}//endif
########################################################

  if (!isset($_REQUEST['action'])){//checks action variable and kicks it to the post_entry function if its empty
    post_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null);
  }
  else{
    switch ($_REQUEST['action']){   //checks action variable and kicks it to the correct function
      case ($_REQUEST['action']=="Post"):       //EXTERNAL/PUBLIC TASK
           post_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null);
           break;
      case ($_REQUEST['action']=="Post Task"):  //INTERNAL TASK
           post_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null);
           break;
      case ($_REQUEST['action']=="Submit"):
           submit_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_list, $global_owner_email, $owner_email_beg_url, $admin_email_notification_subject);
           break;
      case ($_REQUEST['action']=="View" || $_REQUEST['action']=="View Open"): //View External/Public Tasks
           display_entry($db_connection, $owner, $view="display", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $post_ID);
           break;
      case ($_REQUEST['action']=="View Tasks"): //View Internal Tasks
           display_entry($db_connection, $owner, $view="task", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $post_ID);
           break;
      case ($_REQUEST['action']=="Kbase" || $_REQUEST['action']=="View Closed"):
           display_entry($db_connection, $owner, $view="kbase", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $post_I);
           break;
      case ($_REQUEST['action']=="Reports"):
           report_panel($owner);
           break;
      case ($_REQUEST['action']=="Send Email"): //for sending manual emails 
           Email_panel($owner, $srq_user);
           break;
      case ($_REQUEST['action']=="Manual Mail"): //receives email to,subject,body from Email_Panel and sends it
           Manual_Mailer($owner, $srq_user, $srq_user_email);
           break;
      case ($_REQUEST['action']=="Admin"):
           //login($db_connection, $owner);
           admin_panel($owner);
           break;
           /*case ($_REQUEST['action']=="Login"):
           authenticate($db_connection, $owner, $loginID, $pass);
           break;*/
      case ($_REQUEST['action']=="Recall")://lists requests and takes userinput to recall specified request
           recall_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
           break;
      case ($_REQUEST['action']=="Change")://pulls up request specified in recall_entry and passes changes to update_entry
           change_entry($db_connection, $owner, $srq_user, $name, $record, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS,$assigned, $timeStop, $resolution, $RegID );
           break;
      case ($_REQUEST['action']=="Update"): //takes changes from change_entry and posts them to the database
           update_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $assigned, $timeStop, $resolution, $RegID, $email_action, $post_ID, $admin_email_list, $global_owner_email, $owner_email_beg_url, $admin_email_notification_subject);
           break;
      case ($_REQUEST['action']=="view_request"): //pulls up all open and public requests for viewing
           //if post_ID is not set then set a bad value to post_ID
           if(!isset($_REQUEST['post_ID'])){
             $post_ID = '-2';
           }
           //otherwise, send post_ID to request as the real post_ID
           else{
             $post_ID = $_REQUEST['post_ID'];
           }
           display_entry($db_connection, $owner, $view="email_link", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $post_ID);
           //view_request($db_connection, $owner, $post_ID);
           break;
      default:    //if none of the choices fits the action variable, it goes to the display function
           display_entry($db_connection, $owner, $view="display", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $post_ID);
           break;
  }//endswitch
}//endif


#########################################################################################
#                                   post_entry                                          #
#########################################################################################
#Purpose: Takes info, from html form and stores it to variables
function post_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null){
  //echo "begin debug";
  //print_r($errors);
  
  $errors = array();
  //$debug = count($errors);
  //echo "error count:  $debug <br /><br />";

  if(isset($_REQUEST["formloaded"])){
    $valid = validate_post_data($name, &$email, $assetNumber, $status, $priorityLevel, $errorType, $description, $OS, $assigned, $timeStart, $timeStop);
    //echo "<br /><br />valid:  ";
    //print_r($valid);
	//echo "end debug";
    if(count($valid) != 0){
      display_post_form($name, $email, $assetNumber, $timeStart, $status, $priorityLevel, $errorType, $description, $OS, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null);
    } else {
      submit_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_list, $global_owner_email, $owner_email_beg_url, $admin_email_notification_subject);
    }
  } else {
    display_post_form($name, $email, $assetNumber, $timeStart, $status, $priorityLevel, $errorType, $description, $OS, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null);
  }


}//endfunction

#################################################################################################
#
#				Validate_Post_Data																#
#
#################################################################################################

function validate_post_data($name, &$email, $assetNumber, $timeStart, $status, $priorityLevel, $errorType, $description, $OS, $assigned, $timeStop){

  //echo "begin debug";

  global $errors;

  // ; ` &
  $InvalidChars = array(";", "`", "&");
  $domain = "@peoriachristian.org";

  //strip out invalid characters from user entered data
  $name = str_replace($InvalidChars, "", $name);
  $email = str_replace($InvalidChars, "", $email);
  $assetNumber = str_replace($InvalidChars, "", $assetNumber);
  $description = str_replace($InvalidChars, "", $description);
  
  if($name == ""){
    $errors[] = "<span class=\"errors\">Please enter your name, thanks.</span>";
  }
  if($email == ""){
    $errors[] = "<span class=\"errors\">Please enter a valid peoriachristian.org email address, thanks.</span>";
  }
  elseif($domain != strstr($email, '@')){
    $errors[] = "<span class=\"errors\">Please enter a valid peoriachristian.org email address, thanks.</span>";
    $email = "";
  }
  if($OS == "---SELECT ONE---"){
    $errors[] = "<span class=\"errors\">Please select a version of windows, thanks.</span>";
  }
  if($errorType == "---SELECT ONE---"){
    $errors[] = "<span class=\"errors\">Please select an error type, thanks.</span>";
  }
  if($description == ""){
    $errors[] =  "<span class=\"errors\">Please enter a description of the problem, thanks.</span>";
  }
  if($priorityLevel == "---SELECT ONE---"){
    $errors[] = "<span class=\"errors\">Please select a priority level, thanks.</span>";
  }
  //echo "end debug <br /><br />";
  //print_r($errors);

  return $errors;
}//endFunction

#######################################################################################################
#
#			Display_Post_Errors																		  #
#
#######################################################################################################
function display_post_errors(){
  
  global $errors;
  
  foreach($errors as $err){
    echo $err, "<br />";
  }
}//endFunction


#######################################################################################################
#
#			Display_Post_Form																		  #
#
#######################################################################################################
function  display_post_form($name, $email, $assetNumber, $timeStart, $status, $priorityLevel, $errorType, $description, $OS, $owner, $form_options_windows_version, $form_options_error_type, $form_options_priority_level, $iTask=null){
    
	srqheader($owner);//prints logo banner at top of page

    # print menu under banner
    div_beg("id_menu");
    if (isset($iTask)){
      anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    }else {
    	anchor("it_srq.php?action=View", "View Service Requests", "clamenuitem");
    }
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();

    hr();
	
	//Show form
    if(isset($_REQUEST["formloaded"])){
      display_post_errors();

    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    b_beg();
    echo "Enter Your Information:";
    b_end();
    p_beg();

       frm_label("forname"); echo "Name: \n";
       frm_input("typtext", "namname", "siz50", "max50", "tab1", "val$name");                                          //!!!!!!!!!!!! - IS TAB VALUE CORRECT OR DOES IT START AT TAB VALUE OF 0??? - !!!!!!!!!!!!!!!!!//
       frm_label_end();
       br();
       frm_label("foremail"); echo "Email: \n";
       frm_input("typtext", "namemail", "siz50", "max50", "tab2", "val$email");
       frm_label_end();
       br();
       frm_label("forassetNumber"); echo "Asset/Barcode Number: \n";
       frm_input("typtext", "namassetNumber", "siz9", "max10", "val99999", "tab3", "val$assetNumber");
       frm_label_end();
       br();
       frm_label("fortimeStart"); echo "Time Submitted(In yyyy-mm-dd format): \n";
       frm_input("typtext", "namtimeStart", "siz20", "max20", "val" . date('Y-m-d'), "tab4");//fills in date automatically
       frm_label_end();
       br();
	   
       frm_label("forOS"); echo "Windows Version: \n";
       frm_select( "namOS", "tab5"); //!!!!!!!!!!!! - change values to values with now spaces???? - !!!!!!!!!!!!!//
       foreach ($form_options_windows_version as $value){
         if($value == $OS){
           frm_option("val$value", "txt$value", "selselected");
         } else {
           frm_option("val$value","txt$value");
         }
       }
       frm_select_end();
       frm_label_end();
       br();
	   
       frm_label("forerrorType"); echo "Error Type: \n";
       frm_select( "namerrorType", "tab6");

       if (isset ($iTask)){ //receives iTask from the Post Task Button on AdminPanel Form
         frm_option("valInternal Task", "txtInternal Task");
       }
       else{
         frm_option("val---SELECT ONE---", "txt---SELECT ONE---");
       }

       foreach ($form_options_error_type as $value){
         if($value == $errorType){
           frm_option("val$value", "txt$value", "selselected");
         } else {
           frm_option("val$value","txt$value");
         }
       }
       frm_select_end();
       frm_label_end();
       br();
       
	   frm_label("fordescription"); echo "Description: \n";
       frm_textarea("namdescription", "row5", "col50", "tab7");
       echo $description;
       frm_textarea_end();
       frm_label_end();
       br();
       
	   frm_label("forpriorityLevel"); echo "Priority Level: \n";
       frm_select("nampriorityLevel", "tab8");

       foreach ($form_options_priority_level as $value){
         if($value == $priorityLevel){
           frm_option("val$value", "txt$value", "selselected");
         } else {
           frm_option("val$value","txt$value");
         }
       }
       frm_select_end();
       frm_label_end();
       br();
       
	   frm_input("typhidden", "namformloaded", "valtrue");
       br();
       p_end();
// ########Post Data to variables
       frm_input($nam="namaction", $typ="typsubmit", $val="valPost");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");
    form_end();

}else {

    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    b_beg();
    echo "Enter Your Information:";
    b_end();
    p_beg();

       frm_label("forname"); echo "Name: \n";
       frm_input("typtext", "namname", "siz50", "max50", "tab1");                                          //!!!!!!!!!!!! - IS TAB VALUE CORRECT OR DOES IT START AT TAB VALUE OF 0??? - !!!!!!!!!!!!!!!!!//
       frm_label_end();
       br();
	   
       frm_label("foremail"); echo "Email: \n";
       frm_input("typtext", "namemail", "siz50", "max50", "tab2");
       frm_label_end();
       br();
       
	   frm_label("forassetNumber"); echo "Asset/Barcode Number: \n";
       frm_input("typtext", "namassetNumber", "siz9", "max10", "val99999", "tab3");
       frm_label_end();
       br();
       
	   frm_label("fortimeStart"); echo "Time Submitted(In yyyy-mm-dd format): \n"; //fills in date automatically
       frm_input("typtext", "namtimeStart", "siz20", "max20", "val" . date('Y-m-d'), "tab4");
       frm_label_end();
       br();
	   /*########## TRY THIS FOR AUTO TimeStamp
	   $timeStart = date('Y-m-d');
	   frm_input("typhidden", "namtimeStart", "val$timeStart");
       br();
       */
	   
       frm_label("forOS"); echo "Windows Version: \n";
       frm_select( "namOS", "tab5");//!!!!!!!!!!!! - change values to values with now spaces???? - !!!!!!!!!!!!!//

       foreach ($form_options_windows_version as $value){
         frm_option("val$value","txt$value");
       }
       frm_select_end();
       frm_label_end();
       br();
	   
       frm_label("forerrorType"); echo "Error Type: \n";
       frm_select( "namerrorType", "tab6");

       if (isset ($iTask)){ //receives iTask from the Post Task Button on AdminPanel Form
         frm_option("valInternal Task", "txtInternal Task");
       }
       else{
         frm_option("val---SELECT ONE---", "txt---SELECT ONE---");
       }

       foreach ($form_options_error_type as $value){
         frm_option("val$value","txt$value");
       }

       frm_select_end();
       frm_label_end();
       br();
       
	   frm_label("fordescription"); echo "Description: \n";
       frm_textarea("namdescription", "row5", "col50", "tab7");
       frm_textarea_end();
       frm_label_end();
       br();
       
	   frm_label("forpriorityLevel"); echo "Priority Level: \n";
       frm_select("nampriorityLevel", "tab8");

       foreach ($form_options_priority_level as $value){
         frm_option("val$value","txt$value");
       }
       frm_select_end();
       frm_label_end();
       br();
       
	   frm_input("typhidden", "namformloaded", "valtrue");
       br();
       p_end();
// ########Post Data to variables
       frm_input($nam="namaction", $typ="typsubmit", $val="valPost");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");
    form_end();
    }

}//end function display_post_form


#########################################################################################
#	submit_entry         #
#########################################################################################
#Purpose: Takes data from variables and formats it for entry to mySQL database via sql statements
function submit_entry($db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $admin_email_list, $global_owner_email, $owner_email_beg_url, $admin_email_notification_subject){

########Submit data to the database via sql                                
	srqheader($owner);//creates logo banner at top of page

    $status="Open"; //setting record status to Open

    # Add this entry to the database using placeholders(?'s)
    $script = "INSERT INTO error_tracking ( Name, Email, AssetTag, Priority, Status, TimeStart, ErrorType, Description, OS) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt = mysqli_prepare($db_connection, $script);
    //echo $stmt;
    mysqli_stmt_bind_param($stmt, 'sssssssss', $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);

	//echo "debug: ";
    //echo $db_connection, $owner, $srq_user, $srq_user_email, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $email_action, $admin_email_list, $global_owner_email;

    /* execute prepared statement */
    $results=mysqli_execute($stmt) or die('Query failed: ' . mysql_error());

    //setup menu under logo banner
    div_beg("id_menu");
    if ($errorType=="Internal Task"){
    	anchor("it_srq.php?action=Admin", "Back to Admin Panel", "clamenuitem");
    	$email_action = "isubmit";
    }else{
      $email_action = "esubmit";
    	anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
    	anchor("it_srq.php?action=View", "View Open Requests", "clamenuitem");
    }
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
	
	# Display confirmation that the entry was accepted.
    printf("%d Row inserted.\n", $results);
    br();

    //getting RegID where the previous submitted variables match exactly
    $script = "SELECT `RegID` FROM `error_tracking` WHERE `Name` = '$name' AND `Email`='$email' AND `AssetTag`='$assetNumber' AND `Priority`='$priorityLevel' AND `Status`='$status' AND `ErrorType`='$errorType' AND `Description`='$description' AND `OS` ='$OS' AND `TimeStart`='$timeStart'";

    #echo "debug: $script";

    /* execute prepared statement */
    $results=mysqli_query($db_connection,$script) or die('Query failed: ' . mysql_error());
    while ($row = mysqli_fetch_array($results)){
      $post_ID = $row["RegID"];
    }
	
#####Debug print#######
    #echo "$email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url <br />";
######################	
	
	//send email to request poster and to $owner's department
    request_email($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url);

    echo "Thank you for your $owner&#39;s Request.\n";

}//endfunction
#########################################################################################
#	update_entry									#
#########################################################################################
#Purpose: Takes data from variables and formats it for entry to mySQL database via sql statements
function update_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $assigned, $timeStop, $resolution, $RegID, $owner_email_beg_url, $admin_email_notification_subject)
{


	srqheader($owner);//prints logo banner across the top of page

########Submit data to the database via sql
    $script = "UPDATE error_tracking SET Name='$name', Email='$email', AssetTag='$assetNumber', Priority='$priorityLevel',`Status`='$status', TimeStart='$timeStart', ErrorType='$errorType', Description='$description', OS='$OS', Assigned='$assigned', TimeStop='$timeStop', Resolution='$resolution' WHERE RegID=$RegID";
    $stmt = mysqli_prepare($db_connection, $script);
   

    /* execute prepared statement */
    $results=mysqli_execute($stmt) or die('Query failed: ' . mysql_error());
	
    //create menu under logo banner
    div_beg("id_menu");
	if (isset($_SESSION["admin"])) {
	   anchor("it_srq.php?action=Admin", "Back to Admin Panel", "clamenuitem");
	}else{
	   anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
       anchor("it_srq.php?action=View", "View Open Requests", "clamenuitem");
	}//endif
	
    if ($errorType=="Internal Task"){
      anchor("it_srq.php?action=Admin", "Back to Admin Panel", "clamenuitem");
      if ($status == "In Progress (See Resolution Comments)"){
        $email_action = "ichange";
      }elseif ($status == "Resolved (Completed)"){
        $email_action = "iresolve";
      }//endif
    }//endif
    if ($errorType!="Internal Task"){
      if ($status == "In Progress (See Resolution Comments)"){
        $email_action = "echange";
      }elseif ($status == "Resolved (Completed)"){
        $email_action = "eresolve";
      }//endif
	}//endif

    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
	
	# Display confirmation that the entry was accepted.
	printf("%d Row inserted.\n", $results);
    br();
    echo "Thank you for your $owner&#39;s Request.\n";
	p_end();
	
	$post_ID = $RegID;//set post_ID for emailer equal to the RegID from record being updated
	
	//send email to request poster and to $owner's department
	request_email($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url);

}
#########################################################################################
#	display_entry         ********PUBLIC VIEW                                       #
#########################################################################################
#Purpose:Displays only open records for public viewing
function display_entry($db_connection, $owner, $view, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $post_ID){
     //prepare sql statement to grab contents of error_tracking table thats not either a closed or resolved request.

	srqheader($owner); //create logo banner at top of page

        $scriptORecords = "SELECT RegID,         " .
                               "  Name,	        " .
		                           "  Email,		" .
		                           "  AssetTag,		" .
                               "  Priority,		" .
		                           "  Status,		" .
		                           "  ErrorType,		" .
		                           "  Description,	" .
		                           "  OS,             	" .
                               "  Assigned,           " .
                               "  TimeStart,          " .
                               "  TimeStop,           " .
                               "  Resolution          " .
		                           "  FROM error_tracking " .
                               "  WHERE `Status`!='Resolved (Completed)' AND `Status`!='Closed (Denied)' AND ErrorType!='Internal Task'";

     // Create SQL statement to pull all closed or Resolved records

       $scriptCRecords = "SELECT RegID,         " .
                              "  Name,	        " .
		                          "  Email,		" .
		                          "  AssetTag,		" .
		                          "  Priority,		" .
		                          "  Status,		" .
		                          "  ErrorType,		" .
		                          "  Description,	" .
		                          "  OS,             	" .
                              "  Assigned,           " .
                              "  TimeStart,          " .
                              "  TimeStop,           " .
                              "  Resolution          " .
		                          "  FROM error_tracking " .
                              "  WHERE `Status`='Resolved (Completed)' OR `Status`='Closed (Denied)'";

     // Create SQL statement to pull all Intra-Dept Task records

       $scriptTRecords = "SELECT RegID,         " .
                              "  Name,	        " .
		                          "  Email,		" .
		                          "  AssetTag,		" .
		                          "  Priority,		" .
		                          "  Status,		" .
		                          "  ErrorType,		" .
		                          "  Description,	" .
		                          "  OS,             	" .
                              "  Assigned,           " .
                              "  TimeStart,          " .
                              "  TimeStop,           " .
                              "  Resolution          " .
		                          "  FROM error_tracking " .
                              "  WHERE ErrorType ='Internal Task'";

     // Create SQL statement to pull specific record from an email

       $scriptERecords = "SELECT * FROM error_tracking WHERE RegID='$post_ID'";

############################# Fetch the contents of the requests
    //test $view for kbase or display to decide which SQL statement to use.

    if ($view=="display"){ //set by default, "O" is for Open
      $script=$scriptORecords;
      $emaillink = true;
    }elseif ($view=="kbase"){ //set by all "view closed records" links, "C" is for Closed
      $script=$scriptCRecords;
      $emaillink = true;
    }elseif ($view=="task"){ //set by "View Tasks" button on AdminPanel Form, "T" is for Task - Internal Task
      $script=$scriptTRecords;
      $emaillink = true;
    }elseif ($view=="record"){ //don't know what it is set by, "S" stands for Specific record
      $script=$scriptSRecords;
      $emaillink = true;
    }elseif ($view=="email_link"){
      $script=$scriptERecords;
      //error reporting, if the post_id has not been passed post_id will contain '-2' and an error message needs to be printed out
      if($post_ID == '-2'){
        $emaillink = false;
      }else{
        $emaillink = true;
      }
    }//endif

    /* execute prepared statement */
    $results=mysqli_query($db_connection,$script);


############################## Display the requests
    div_beg("id_menu");
    if ($view=="task"){
    	    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    }else {
    anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
    }    
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
    table_beg();
/*         colgroup_beg();     //trying to use colgroup to format columns
           col("id_request");
           col("id_name");
           col("id_email");
           col("id_assetNumber");
           col("id_status");
           col("id_priorityLevel");
           col("id_errorType");
           col("id_description");
           col("id_os");
           col("id_assigned");
           col("id_timeStart");
           col("id_timeStop");
           col("id_resolution");
        colgroup_end(); */
    	echo "<tr class=\"header\">\n";
          echo "<th><strong>Request #: </strong></th>\n";
          echo "<th><strong>Name: </strong></th>\n";
          echo "<th><strong>Email: </strong></th>\n";
          echo "<th><strong>Asset Number: </strong></th>\n";
          echo "<th><strong>Status: </strong></th>\n";
          echo "<th><strong>Priority: </strong></th>\n";
          echo "<th><strong>Error Type: </strong></th>\n";
          echo "<th><strong>Description: </strong></th>\n";
          echo "<th><strong>Windows Version </strong></th>\n";
          echo "<th><strong>Assigned To: </strong></th>\n";
          echo "<th><strong>Time Submitted: </strong></th>\n";
          echo "<th><strong>Time Completed: </strong></th>\n";
          echo "<th><strong>Resolution: </strong></th>\n";
        echo "</tr>\n";

    /* fetch values */
#cycles through each record printing the corresponding fields to an html table
    while ($row = mysqli_fetch_array($results)){

	echo "<tr class=\"request\">\n";
          echo "<td>", $row["RegID"], "</td>\n";
          echo "<td>", $row["Name"], "</td>\n";
          echo "<td><a href=\"mailto:",  $row["Email"],"\">", $row["Email"], "</a></td>\n";
          echo "<td>", $row["AssetTag"], "</td>\n";
          echo "<td>", $row["Status"], "</td>\n";
          echo "<td>", $row["Priority"], "</td>\n";
          echo "<td>", $row["ErrorType"], "</td>\n";
          echo "<td>", $row["Description"], "</td>\n";
          echo "<td>", $row["OS"], "</td>\n";
          echo "<td>", $row["Assigned"], "</td>\n";
          echo "<td>", $row["TimeStart"], "</td>\n";
          echo "<td>", $row["TimeStop"], "</td>\n";
          echo "<td>", $row["Resolution"], "</td>\n";
        echo "</tr>\n";
        echo "<tr></tr>\n";
    }//endwhile
    table_end();
    p_end();
    # Stop processing our statement
    mysqli_close($db_connection);

    //if the email link is broken, nothing will be outputted for the view email link part of this function, so output error message.
    if(!$emaillink){
      echo "there has been an error, not all information is correct. You are probably getting this error from a broken link";
    }
}//endfunction "display_entry"



########################################################################################################################################
#                                  ************ ADMIN VIEW SECTIONS *****************************************                      #
########################################################################################################################################



####################################################################################################
#        authenticate                                                                              #
####################################################################################################
#purpose: to evaluate user/pass combinations
function authenticate($db_connection, $loginID, $pass){

$loginID=$_REQUEST["loginID"];
$pass=$_REQUEST["pass"];
$stored_pass=null;
$user=null;

######################## grab records from database for display
#prepare sql statement to grab contents of error_tracking table
$script = "SELECT * FROM security WHERE Name=\"". $_REQUEST["loginID"]. "\"";

######################### Fetch the contents of the requests
$results=mysqli_query($db_connection,$script);

while ($row = mysqli_fetch_array($results)){
    $user= $row["Name"];
    $stored_pass = $row["Password"];
}

if ($user == $_REQUEST["loginID"] and $stored_pass == $_REQUEST["pass"]){

       admin_panel(); ####Bring up AdminView after Auth.
   //echo "ACCESS GRANTED"; //For Debugging
}else{
      echo "Access Denied";
}//endif

    # Stop processing our statement
    mysqli_close($db_connection);
}//endfunction
####################################################################################################
#        admin_panel                                                                               #
####################################################################################################
#purpose: A control panel for administrative tasks
function admin_panel($owner){

	session_start();
	if (!isset($_SESSION["admin"])) {
	  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . "&post_ID=" . urlencode($_REQUEST['post_ID']));
	}
	srqheader($owner);

    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    strong("Administrative Task Panel");
    p_beg();
    div_beg("id_menu");
    anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
    anchor("it_srq.php?action=View", "View Open Requests", "clamenuitem");
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    p_end();
    hr;
    p_beg();
############################*****************INSERT COOKIE CALL HERE
########Post Data to variables
   table_beg("wid350px");
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valRecall");  #Edit previous request
    echo "</td>";
    echo "<td class=\"adminpanel\">";    
   echo "Edit a previous request";
    echo "</td></tr>";
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valPost Task");  #Post a Intra-Dept Task
    echo "</td>";
    echo "<td class=\"adminpanel\">";
    echo "Post an Intra-Dept Task";
    echo "</td></tr>";
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valView Open");  #View Open Public request
    echo "</td>";
    echo "<td class=\"adminpanel\">";    
    echo "View Open Public Requests";
    echo "</td></tr>";
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valView Closed");  #View Closed Public request
    echo "</td>";
    echo "<td class=\"adminpanel\">";    
    echo "View Closed Public Requests";
    echo "</td></tr>";
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valView Tasks");  #View Intra-Dept Requests
    echo "</td>";
    echo "<td class=\"adminpanel\">";    
    echo "View Intra-Dept Tasks";
    echo "</td></tr>";
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valReports");  #Built-In Report Generator
    echo "</td>";
    echo "<td class=\"adminpanel\">";    
    echo "Run Built-in Reports";
    echo "</td></tr>";
    echo "<tr><td class=\"adminpanel\">";
   frm_input("typsubmit", "namaction", "valSend Email");  #Manual Email Generator
    echo "</td>";
    echo "<td class=\"adminpanel\">";    
    echo "Send an Admin Email";
    echo "</td></tr>";    
#    print $request->submit(  //***** Use this when cookies work right
#	-name  => "action",
#	-value => "Log Out");
   table_end();
   form_end();
   p_end();
}//endfunction
####################################################################################################
#        report_panel                                                                               #
####################################################################################################
#purpose: A control panel for built-in reports
function report_panel($owner){

	session_start();
	if (!isset($_SESSION["admin"])) {
	  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . "&post_ID=" . urlencode($_REQUEST['post_ID']));
	}
	srqheader($owner);
    div_beg("id_menu");
    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
    print "Page Under Construction";
    #######**************ADD BUILTIN REPORTS HERE
    
    p_end();
}//endfunction
####################################################################################################
#        Email_Panel                                                                               #
####################################################################################################
#purpose: A control panel for built-in reports
function Email_panel($owner, $srq_user){

	session_start();
	if (!isset($_SESSION["admin"])) {
	  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . "&post_ID=" . urlencode($_REQUEST['post_ID']));
	}
	srqheader($owner);
    div_beg("id_menu");
    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
	
//begin email form
form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
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
       frm_input($nam="namaction", $typ="typsubmit", $val="valManual Mail");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");       
       
	   form_end();    
}//endfunction

####################################################################################################
#        Manual Emailer                                                                            #
####################################################################################################
#purpose: Takes input from form and creates an email
function Manual_Mailer($owner, $srq_user, $srq_user_email){
	session_start();
	if (!isset($_SESSION["admin"])) {
	  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . "&post_ID=" . urlencode($_REQUEST['post_ID']));
	}
	srqheader($owner);
	div_beg("id_menu");
    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
//set the php.ini file to be able to send emails
//      -to do this you HAVE to change the SMTP setting
//           the smtp_port's default is "25"
ini_set("SMTP", "exchange.peoriachristian.org");
ini_set("smtp_port", "25");

//Creates the list of people to send the email to as designated in users.php
// !!! - WILL EVENTUALLY CHANGE TO CONFIG.PHP, BE SURE TO CHANGE THIS - !!!
//foreach ($srq_user_email as $key => $value) {
//   $MailTo .= "$value@peoriachristian.org, ";
//}


$MailTo = $_REQUEST['MailTo'];
//debug...
echo $MailTo;

$MailSubject = $_REQUEST['MailSubject'];
$MailBody =  $_REQUEST['MailBody'];
$MailHeader = 'From: service_request@peoriachristian.org';
$SuccessMsg = 'Your message has been forwarded to the requested party.';
$FailureMsg = 'There has been a problem forwarding your message to the requested party.
			Please resend your message.  We apologize for this
			inconvenience.';
$IncompleteMsg = 'You left out some required data. <strong>Please click the Back button
			on your browser to return to the 
			Information Request Form.</strong> Then complete all required data and resubmit the form.
			It seems you did not complete the following: ';

$Data = '###############Start of Record##################'. "\n\n";

##############This small function tests to make sure data is ok and returns errors where appropriate.
function ListAll($aVal, $aKey, &$List)
{
	global $Incomplete;	if(($aVal == '') && (stristr($_POST['Required'],$aKey)))
	{
		$Incomplete = $Incomplete.$aKey.', ';
	}
	$List = $List.$aKey.' = '.$aVal."\n";
}//endfunction
##############
$Success = array_walk($_POST, 'ListAll', &$Data);
if($Success)
{
	if($Incomplete == '')
	{
		//#####This actually sends the message after it passes all the tests.
		if(mail($MailTo,$MailSubject,$MailBody,$MailHeader))
		{
			echo "<p>$SuccessMsg</p>";
			echo $Incomplete;
		}
		else
		{
			echo "<p>$FailureMsg (mail failure)</p>";
		}//endif
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

####################################################################################################
#        recall_entry                                                                              #
####################################################################################################
#purpose: to choose which record to recall
function recall_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS){
	session_start();
	if (!isset($_SESSION["admin"])) {
	  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . "&post_ID=" . urlencode($_REQUEST['post_ID']));
	}
	srqheader($owner);
	############################## Display the requests
    div_beg("id_menu");
    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    anchor("pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
    

########################REQUEST A RECORD
    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    p_beg();
    table_beg();
    echo "<tr>";
	echo "<td> Which record Do you want to recall?";
	frm_input("typtextarea", "namrecord", "siz50", "max255");
    table_end();
    p_end();
    frm_input("typsubmit", "namaction", "valChange");
    frm_input($nam="nam.reset", $typ="typreset", $val="valReset");

    form_end();
        
    table_beg();
    
######################## grab records from database for display
      #prepare sql statement to grab contents of error_tracking table
    $script = "SELECT RegID,         " .
         "  Name, " .
		 "  Email, " .
		 "  AssetTag, " .
		 "  Priority, " .
		 "  Status,	" .
		 "  ErrorType, " .
		 "  Description, " .
		 "  OS, " .
         "  Assigned, " .
         "  TimeStart, " .
         "  TimeStop, " .
         "  Resolution " .
		 "  FROM error_tracking " .
         "  WHERE `Status`!='Resolved (Completed)' AND `Status`!='Closed (Denied)'";

##########################Display requests to choose from
    	echo "<tr class=\"header\">\n";
          echo "<th><strong>Request #: </strong></th>\n";
          echo "<th><strong>Name: </strong></th>\n";
          echo "<th><strong>Email: </strong></th>\n";
          echo "<th><strong>Asset Number: </strong></th>\n";
          echo "<th><strong>Status: </strong></th>\n";
          echo "<th><strong>Priority: </strong></th>\n";
          echo "<th><strong>Error Type: </strong></th>\n";
          echo "<th><strong>Description: </strong></th>\n";
          echo "<th><strong>Windows Version </strong></th>\n";
          echo "<th><strong>Assigned To: </strong></th>\n";
          echo "<th><strong>Time Submitted: </strong></th>\n";
          echo "<th><strong>Time Completed: </strong></th>\n";
          echo "<th><strong>Resolution: </strong></th>\n";
        echo "</tr>\n";


    /* fetch values */
#cycles through each record printing the corresponding fields to an html table
    $results=mysqli_query($db_connection,$script);
    while ($row = mysqli_fetch_array($results)){

	echo "<tr class=\"request\">\n";
          echo "<td>", $row["RegID"], "</td>\n";
          echo "<td>", $row["Name"], "</td>\n";
          echo "<td><a href=\"mailto:",  $row["Email"],"\">", $row["Email"], "</a></td>\n";
          echo "<td>", $row["AssetTag"], "</td>\n";
          echo "<td>", $row["Status"], "</td>\n";
          echo "<td>", $row["Priority"], "</td>\n";
          echo "<td>", $row["ErrorType"], "</td>\n";
          echo "<td>", $row["Description"], "</td>\n";
          echo "<td>", $row["OS"], "</td>\n";
          echo "<td>", $row["Assigned"], "</td>\n";
          echo "<td>", $row["TimeStart"], "</td>\n";
          echo "<td>", $row["TimeStop"], "</td>\n";
          echo "<td>", $row["Resolution"], "</td>\n";
        echo "</tr>\n";
        echo "<tr></tr>\n";
    }//endwhile
    table_end();
    p_end();
    # Stop processing our statement
    mysqli_close($db_connection);         

}//endfunction


####################################################################################################
#        change_entry                                                                              #
####################################################################################################
#purpose: to allow administrative editing of records
function change_entry($db_connection, $owner, $srq_user, $name, $record, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS, $assigned, $timeStop, $resolution, $RegID)
{
	session_start();
	if (!isset($_SESSION["admin"])) {
	  header("Location: /itsrq/login.php?url=" . urlencode($_SERVER["SCRIPT_NAME"]) . "?action=" . urlencode($_REQUEST['action']) . "&post_ID=" . urlencode($_REQUEST['post_ID']));
	}
	srqheader($owner);
#########################PULL UP RECORD VALUES TO VARIABLES
 	#prepare sql statement to grab contents of error_tracking table
    $script = "SELECT RegID,         " .
         "  Name,	        " .
		 "  Email,		" .
		 "  AssetTag,		" .
		 "  Priority,		" .
		 "  Status,		" .
		 "  ErrorType,		" .
		 "  Description,	" .
		 "  OS,             	" .
         "  Assigned,           " .
         "  TimeStart,          " .
         "  TimeStop,           " .
         "  Resolution          " .
		 "  FROM error_tracking " .
         "  WHERE RegID = $record";
# Fetch the contents of the requests

    //$stmt = mysqli_prepare($db_connection, $script);
    //mysqli_stmt_bind_param($stmt, 'sssssssssssss', $RegID, $name, $email, $assetNumber, $priorityLevel, $status, $errorType, $description, $OS, $assigned, $timeStart, $timeStop, $resolution);

    /* execute prepared statement */
    //$results=mysqli_execute($stmt) or die('Query failed: ' . mysql_error());;
    
    $results=mysqli_query($db_connection,$script);

    # Display the requests
	############################## Display the requests
    div_beg("id_menu");
    anchor("it_srq.php?action=Admin", "Back To Admin Panel", "clamenuitem");
    anchor("it_srq.php?action=Recall", "Recall a different record", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
    //table_beg();

    /* fetch values */
#cycles through each record printing the corresponding fields to an html table
    while ($row = mysqli_fetch_array($results)){
	 $RegID=$row["RegID"];
	 $name=$row["Name"];
	 $email=$row["Email"];
	 $assetNumber=$row["AssetTag"];
	 $priorityLevel=$row["Priority"];
	 $status=$row["Status"];
	 $errorType=$row["ErrorType"];
	 $description=$row["Description"];
	 $OS=$row["OS"];
	 $assigned=$row["Assigned"];
	 $timeStart=$row["TimeStart"];
	 $timeStop=$row["TimeStop"];
	 $resolution=$row["Resolution"];
	 
#######################################################
    #Prints a form with all the original values of requested record from variables.
    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    b_beg();
    echo "Enter Your Information:";
    b_end();
    p_beg();
       frm_label("forRegID"); echo "RegID: \n";
       frm_input("typtext", "namRegID", "siz50", "max50", "tab1", "val$RegID");
       frm_label_end();
       br();
       frm_label("forname"); echo "Name: \n";
       frm_input("typtext", "namname", "siz50", "max50", "tab1", "val$name");
       frm_label_end();
       br();
       frm_label("foremail"); echo "Email: \n";
       frm_input("typtext", "namemail", "siz50", "max50", "tab2", "val$email");
       frm_label_end();
       br();
       frm_label("forassetNumber"); echo "Asset/Barcode Number: \n";
       frm_input("typtext", "namassetNumber", "siz9", "max10", "val$assetNumber", "tab3");
       frm_label_end();
       br();
       frm_label("forpriorityLevel"); echo "Priority Level: \n";
       frm_select("nampriorityLevel", "tab9");
       frm_option("selselected", "val$priorityLevel", "txt$priorityLevel");
       frm_option("valHigh (Requires immediate attention", "txtHigh (Requires immediate attention)"); 
       frm_option("valMedium (Needs attention soon)", "txtMedium (Needs attention soon)"); 
       frm_option("valNormal (Fix as Schedule Permits)", "txtNormal (Fix as Schedule Permits)"); 
       frm_select_end();
       frm_label_end();
       br();
       frm_label("forstatus"); echo "Status: \n";
       frm_select("namstatus", "tab8");
       frm_option("selselected", "val$status", "txt$status"); 
       frm_option("valOpen", "txtOpen");
       frm_option("valClosed (Denied)", "txtClosed (Denied)");
       frm_option("valIn Progress (See Resolution Comments)", "txtIn Progress (See Resolution Comments)");
       frm_option("valResolved (Completed)", "txtResolved (Completed)"); 
	   frm_select_end();
	   frm_label_end();
	   br();
	   frm_label("forerrorType"); echo "Error Type: \n";
       frm_select( "namerrorType", "tab6");
       frm_option("selselected", "val$errorType", "txt$errorType"); 
       frm_option("valNetwork Outage","txtNetwork Outage"); 
       frm_option("valBlocked Website","txtBlocked Website"); 
       frm_option("valPC Problem/Question", "txtPC Problem/Question"); 
       frm_option("valEquipment Repair/Replace", "txtEquipment Repair/Replace"); 
       frm_option("valOther", "txtOther"); 
       frm_select_end();
       frm_label_end();
       br();
       frm_label("fordescription"); echo "Description: \n";
       frm_textarea("namdescription", "row5", "col50", "tab7"); echo $description; frm_textarea_end();
       frm_label_end();
       br();
       frm_label("forOS"); echo "Windows Version: \n";
       frm_select( "namOS", "tab5");
       frm_option("selselected", "val$OS","txt$OS"); 
       frm_option("valWindows XP","txtWindows XP"); 
       frm_option("valWindows 2000", "txtWindows 2000"); 
       frm_option("valWindows 98", "txtWindows 98"); 
       frm_select_end();
       frm_label_end();
       br();
	   frm_label("forassigned"); echo "Assigned To: \n";
       frm_select("namassigned", "tab10");
       frm_option("selselected", "val$assigned", "txt$assigned");        
       foreach ($srq_user as $key => $value) {
       frm_option("val$value", "txt$value"); 
       }
       frm_select_end();
       frm_label_end();
       br();
	   frm_label("fortimeStart"); echo "Time Submitted: \n";
	   frm_input("typtext", "namtimeStart", "siz20", "max20", "val$timeStart", "tab11");       
       frm_label_end();
       br();
	   frm_label("forresolution"); echo "Resolution Comments: \n";	
       frm_textarea("namresolution", "row5", "col50", "tab12"); echo $resolution; frm_textarea_end();
       frm_label_end();
       br();
       frm_label("fortimeStop"); echo "Time Finished: \n";
       frm_input("typtext", "namtimeStop", "siz20", "max20", "val$timeStop", "tab13");       
       frm_label_end();
       p_end();
       
// ########Post Data to variables
       frm_input($nam="namaction", $typ="typsubmit", $val="valUpdate");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");
    form_end();
    }//endwhile
    # Stop processing our statement
    mysqli_close($db_connection);         
    $record=$RegID;
 }//endfunction
#########################################################################
#
#		FUNCTION srqheader
#
#########################################################################
#Purpose: setup html header and print logo banner at top of page.
function srqheader($owner){

	doctype("xtrans");
	html_beg();
	title("$owner&#39;s Request System");
	html_link("stylesheet", "text/css", "stylesheet1.css");
	html_end();

	div_beg("id_logo");
	echo "$owner&#39;s Request System";
	div_end();
	br();

}


?>