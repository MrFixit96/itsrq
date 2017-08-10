<?php

#Include Modules used
include '../functionsjcaa.php';   #imports a library of functions for echoing html code
include 'connections.php'; #imports connections settings for database usage

#########################################################################################
#	Variables	                                                                #
#########################################################################################
//Purpose: To declare variable at the program level scope

  # Create a new database connection
$db_connection = mysql_connect($host, $user, $pw);

 # make $database the current db
$db_selected = mysql_select_db($database, $db_connection);


# Get the list of parameters passed by html form
$action = $_REQUEST['action'];
$name = $_REQUEST['name'];
$assetNumber = $_REQUEST['assetNumber'];
$errorType = $_REQUEST['errorType'];
$email = $_REQUEST['email'];
$description = $_REQUEST['description'];
$priorityLevel = $_REQUEST['priorityLevel'];
$OS = $_REQUEST['OS'];
#$record = $_REQUEST['record'];
#$status= $request->param("status");
#$RegID= $request->param("RegID");
#$assigned= $request->param("assigned");
$timeStart= $_REQUEST['timeStart'];
#$timeStop= $request->param("timeStop");
#$resolution= $request->param("resolution");
$owner = "IT Services";
#$user= $request->param("pass");
#$pass= $request->param("pass");
#$loginID= $request->param("loginID");
#$loggedIN = "0";
#$cookie1;
#$cookie2;

#########################################################################################
#	MAIN										#
#########################################################################################
#Purpose: Starts program

####################################################
#           Test SQL Connection
/* check connection */
if (!$db_connection) {
    die("Could not connect: " . mysql_error());
}//endif
echo "Connected successfully";
/* check database connected */
if (!$db_selected) {
    die ("Can't use $database : " . mysql_error());
}//endif

#####################################################

//if ($loggedIN = "1"){
//    #print $request->header(-cookie=>[$cookie1,$cookie2]);
//     set_cookie();
//}else{
//html_header("xtrans", "$owner's Request System");
doctype("xtrans");
html_beg();
title("$owner&#39;s Request System");
html_link("stylesheet", "text/css", "stylesheet2.css");
html_end();

div_beg("id_logo");
echo "IT Services&#39;s Request System";
div_end();
//printf("Host information: %s\n", $mysqli->host_info); //for debugging
br();
if (!isset($_REQUEST['action'])){//checks action variable and kicks it to the post_entry function if its empty
post_entry($owner);
}else{
  switch ($_REQUEST['action']){   //checks action variable and kicks it to the correct function
    case ($_REQUEST['action']=="Post"):
         post_entry($owner);
         break;
    case ($_REQUEST['action']=="Submit"):
         submit_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         echo "\nSubmit Entries To Database \n"; //for debugging
         break;
    case ($_REQUEST['action']=="View"):
         display_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         echo "\nDisplay Entries in Database \n"; //for debugging
         break;
    default:    //if none of the choices fits the action variable, it goes to the display function
         display_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         echo "\nDisplay Entries in Database \n"; //for debugging
         break;
  }//endswitch
}//endif


#########################################################################################
#	post_entry									#
#########################################################################################
#Purpose: Takes info, from html form and stores it to variables
function post_entry($owner){
    # Show the form
    div_beg("id_menu");
    anchor("it_srq.php?action=View", "View Service Requests", "clamenuitem");
    anchor("../../index.php?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();

    hr();
    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    b_beg();
    echo "Enter Your Information:";
    b_end();
    p_beg();


       frm_label("forname"); echo "Name: \n";
       frm_input("typtext", "namname", "siz50", "max50", "tab1");
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
       frm_label("fortimeStart"); echo "Time Submitted(In yyyy-mm-dd format): \n";
       frm_input("typtext", "namtimeStart", "siz20", "max20", "valyyyy-mm-dd", "tab4");
       frm_label_end();
       br();
       frm_label("forOS"); echo "Windows Version: \n";
       frm_select( "namOS", "tab5");
       frm_option("val---SELECT ONE---"); echo "---SELECT ONE---"; frm_option_end();
       frm_option("valWindows XP"); echo "Windows XP"; frm_option_end();
       frm_option("valWindows 2000"); echo "Windows 2000"; frm_option_end();
       frm_option("valWindows 98"); echo "Windows 98"; frm_option_end();
       frm_select_end();
       frm_label_end();
       br();
       frm_label("forerrorType"); echo "Error Type: \n";
       frm_select( "namerrorType", "tab6");
       frm_option("val---SELECT ONE---"); echo "---SELECT ONE---"; frm_option_end();
       frm_option("valNetwork Outage"); echo "Network Outage"; frm_option_end();
       frm_option("valBlocked Website"); echo "Blocked Website"; frm_option_end();
       frm_option("valPC Problem/Question"); echo "PC Problem/Question"; frm_option_end();
       frm_option("valEquipment Repair/Replace"); echo "Equipment Repair/Replace"; frm_option_end();
       frm_option("valOther"); echo "Other"; frm_option_end();
       frm_select_end();
       frm_label_end();
       br();
       frm_label("fordescription"); echo "Description: \n";
       frm_textarea("namdescription", "row5", "col50", "tab7"); frm_textarea_end();
       frm_label_end();
       br();
       frm_label("forpriorityLevel"); echo "Priority Level: \n";
       frm_select( "nampriorityLevel", "tab8");
       frm_option("val---SELECT ONE---"); echo "---SELECT ONE---"; frm_option_end();
       frm_option("valHigh (Requires immediate attention)"); echo "High (Requires immediate attention)"; frm_option_end();
       frm_option("valMedium (Needs attention soon)"); echo "Medium (Needs attention soon)"; frm_option_end();
       frm_option("valNormal (Fix as Schedule Permits)"); echo "Normal (Fix as Schedule Permits)"; frm_option_end();
       frm_select_end();
       frm_label_end();
       br();
//     echo $request->end_table();
       p_end();
// ########Post Data to variables
       frm_input($nam="namaction", $typ="typsubmit", $val="valSubmit");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");
    form_end();
}//endfunction
#########################################################################################
#	submit_entry									#
#########################################################################################
#Purpose: Takes data from variables and formats it for entry to mySQL database via sql statements
function submit_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS){

########Parse form for errors or missing data
   // error_checker();    //Need to code error_checker code
########Submit data to the database via sql

    $status="Open"; //setting record status to Open

    # Add this entry to the database using placeholders(?'s)
    $script = "INSERT INTO error_tracking ( Name, Email, AssetTag, Priority, Status, TimeStart, ErrorType, Description, OS) VALUES ( $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS)";

    //$stmt = mysqli_prepare($mysqli, $script);
    //mysqli_stmt_bind_param($stmt, 'sssssssss', $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);

    /* execute prepared statement */
    $results=mysql_query($script);

    # Display confirmation that the entry was accepted.
    div_beg("id_menu");
    anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
    anchor("../../?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    printf("%d Row inserted.\n", $results);
    br();
    /* close statement and connection */
    mysql_close($db_connection);

    print_r($_REQUEST); //for debugging
    echo "Thank you for your $owner&#39;s Request.\n";
}//endfunction
#########################################################################################
#	display_entry         ********PUBLIC VIEW                                       #
#########################################################################################
#Purpose:Displays only open records for public viewing
function display_entry($db_connection, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS){
#prepare sql statement to grab contents of error_tracking table thats not either a closed or resolved request.
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
                 "  WHERE `Status`!='Resolved (Completed)' AND `Status`!='Closed (Denied)' AND ErrorType!='Internal Task'";
# Fetch the contents of the requests

    /* execute prepared statement */
        /* execute prepared statement */
    $results=mysql_query($script);


    # Display the requests
    div_beg("id_menu");
    anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
    anchor("../../?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
    br();
    hr();
    p_beg();
    //print $request->start_table();
    table_beg();
    #cycles through each record printing the corresponding fields to an html table
    
        /* bind result variables */
    //mysqli_stmt_bind_result($stmt, $RegID, $name, $email, $assetNumber, $priorityLevel, $status, $errorType, $description, $OS, $assigned, $timeStart, $timeStop, $resolution);

    /* fetch values */
    while ($row = mysql_fetch_array($results)){

	echo "<tr class=\"request\">\n";
          echo "<tr><th><strong>Request Number: </strong></th><td class=\"data\">", $row["RegID"], "</td></tr>\n";
          echo "<tr><th><strong>Name: </strong></th><td class=\"data\">", $row["Name"], "</td>\n";
          echo "<tr><th><strong>Email: </strong></th><td><a href=\"mailto:",  $row["Email"],"\">", $row["Email"], "</a></td></tr>\n";
          echo "<tr><th><strong>Asset Number: </strong></th><td>", $row["AssetTag"], "</td></tr>\n";
          echo "<tr><th><strong>Status: </strong></th><td>", $row["Status"], "</td></tr>\n";
          echo "<tr><th><strong>Priority: </strong></th><td>", $row["Priority"], "</td></tr>\n";
          echo "<tr><th><strong>Error Type: </strong></th><td>", $row["ErrorType"], "</td></tr>\n";
          echo "<tr><th><strong>Description: </strong></th><td>", $row["Description"], "</td></tr>\n";
          echo "<tr><th><strong>Windows Version </strong></th><td>", $row["OS"], "</td></tr>\n";
          echo "<tr><th><strong>Assigned To: </strong></th><td>", $row["Assigned"], "</td></tr>\n";
          echo "<tr><th><strong>Time Submitted: </strong></th><td>", $row["TimeStart"], "</td></tr>\n";
          echo "<tr><th><strong>Time Completed: </strong></th><td>", $row["TimeStop"], "</td></tr>\n";
          echo "<tr><th><strong>Resolution: </strong></th><td>", $row["Resolution"], "</td></tr>\n";
          echo "<tr><td>"; br(2); echo "</th><td>", br(2), "</td></tr>\n";
        echo "</tr>\n";
    }//endwhile
    table_end();
    p_end();
    # Stop processing our statement
    mysql_close($db_connection);
}//endfunction













?>