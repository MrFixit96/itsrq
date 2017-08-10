<?php

#Include Modules used
include '../functions_class.php';   #imports a library of functions for echoing html code
include 'connections.php'; #imports connections settings for database usage

#########################################################################################
#	Variables	                                                                #
#########################################################################################
//Purpose: To declare variable at the program level scope

  # Create a new database connection and make $database the current db
$db_connection = mysqli_connect($host,$user,$pw,$database);
$db_connection = new mysqli($host,$user,$pw,$database);

# Create instance of HTML_Functions
$request = new HTML_Functions();

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
#$user = null;
#$pass = $_REQUEST['pass'];
#$loginID= $_REQUEST['loginID'];
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
//echo "Connected successfully";//for debugging
/* check database connected */
if ($result = mysqli_query($db_connection, "SELECT DATABASE()")) {
    $row = mysqli_fetch_row($result);
    printf("Default database is %s.\n", $row[0]);//for debugging
    mysqli_free_result($result);} else{
    die ("Can't use $database : " . mysql_error());
}//endif

#####################################################

//if ($loggedIN = "1"){
//    #print $request->header(-cookie=>[$cookie1,$cookie2]);
//     set_cookie();
//}else{
//html_header("xtrans", "$owner's Request System");
$request->doctype("xtrans");
$request->html_beg();
$request->title("$owner&#39;s Request System");
$request->html_link("stylesheet", "text/css", "stylesheet1.css");
$request->html_end();

$request->div_beg("id_logo");
echo "IT Services&#39;s Request System";
$request->div_end();
$request->br();
if (!isset($_REQUEST['action'])){//checks action variable and kicks it to the post_entry function if its empty
post_entry($request, $owner);
}else{
  switch ($_REQUEST['action']){   //checks action variable and kicks it to the correct function
    case ($_REQUEST['action']=="Post"):
         post_entry($request, $owner);
         break;
    case ($_REQUEST['action']=="Submit"):
         echo "\nSubmit Entries To Database \n"; //for debugging
         submit_entry($db_connection, $request, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         break;
    case ($_REQUEST['action']=="View"):
         echo "\nDisplay Entries in Database \n"; //for debugging
         display_entry($db_connection, $request, $owner, $view="display", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         break;
    case ($_REQUEST['action']=="Kbase"):
         echo "\nDisplay Resolved Entries in Database \n"; //for debugging
         display_entry($db_connection, $request, $owner, $view="kbase", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         break;
    case ($_REQUEST['action']=="Admin"):
         login($db_connection, $request, $owner);
         break;
    case ($_REQUEST['action']=="Login"):
         authenticate($db_connection, $request, $owner, $loginID, $pass);
         break;
    default:    //if none of the choices fits the action variable, it goes to the display function
         echo "\nDisplay Entries in Database \n"; //for debugging
         display_entry($db_connection, $request, $owner, $view="display", $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);
         break;
  }//endswitch
}//endif


#########################################################################################
#	post_entry									#
#########################################################################################
#Purpose: Takes info, from html form and stores it to variables
function post_entry($request, $owner){
    # Show the form
    $request->div_beg("id_menu");
    $request->anchor("it_srq_class.php?action=View", "View Service Requests", "clamenuitem");
    $request->anchor("../../index.php?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    $request->div_end();

    $request->hr();
    $request->form_beg("actit_srq_class.php", "encmultipart/form-data", "mtdPOST");
    $request->b_beg();
    echo "Enter Your Information:";
    $request->b_end();
    $request->p_beg();

       $request->frm_label("forname"); echo "Name: \n";
       $request->frm_input("typtext", "namname", "siz50", "max50", "tab1");
       $request->frm_label_end();
       $request->br();
       $request->frm_label("foremail"); echo "Email: \n";
       $request->frm_input("typtext", "namemail", "siz50", "max50", "tab2");
       $request->frm_label_end();
       $request->br();
       $request->frm_label("forassetNumber"); echo "Asset/Barcode Number: \n";
       $request->frm_input("typtext", "namassetNumber", "siz9", "max10", "val99999", "tab3");
       $request->frm_label_end();
       $request->br();
       $request->frm_label("fortimeStart"); echo "Time Submitted(In yyyy-mm-dd format): \n";
       $request->frm_input("typtext", "namtimeStart", "siz20", "max20", "valyyyy-mm-dd", "tab4");
       $request->frm_label_end();
       $request->br();
       $request->frm_label("forOS"); echo "Windows Version: \n";
       $request->frm_select( "namOS", "tab5");
       $request->frm_option("val---SELECT ONE---","txt---SELECT ONE---"); $request->frm_option_end();
       $request->frm_option("valWindows XP","txtWindows XP"); $request->frm_option_end();
       $request->frm_option("valWindows 2000", "txtWindows 2000"); $request->frm_option_end();
       $request->frm_option("valWindows 98", "txtWindows 98"); $request->frm_option_end();
       $request->frm_select_end();
       $request->frm_label_end();
       $request->br();
       $request->frm_label("forerrorType"); echo "Error Type: \n";
       $request->frm_select( "namerrorType", "tab6");
       $request->frm_option("val---SELECT ONE---", "txt---SELECT ONE---"); $request->frm_option_end();
       $request->frm_option("valNetwork Outage","txtNetwork Outage"); $request->frm_option_end();
       $request->frm_option("valBlocked Website","txtBlocked Website"); $request->frm_option_end();
       $request->frm_option("valPC Problem/Question", "txtPC Problem/Question"); $request->frm_option_end();
       $request->frm_option("valEquipment Repair/Replace", "txtEquipment Repair/Replace"); $request->frm_option_end();
       $request->frm_option("valOther", "txtOther"); $request->frm_option_end();
       $request->frm_select_end();
       $request->frm_label_end();
       $request->br();
       $request->frm_label("fordescription"); echo "Description: \n";
       $request->frm_textarea("namdescription", "row5", "col50", "tab7"); $request->frm_textarea_end();
       $request->frm_label_end();
       $request->br();
       $request->frm_label("forpriorityLevel"); echo "Priority Level: \n";
       $request->frm_select( "nampriorityLevel", "tab8");
       $request->frm_option("val---SELECT ONE---", "txt---SELECT ONE---"); $request->frm_option_end();
       $request->frm_option("valHigh (Requires immediate attention", "txtHigh (Requires immediate attention)"); $request->frm_option_end();
       $request->frm_option("valMedium (Needs attention soon)", "txtMedium (Needs attention soon)"); $request->frm_option_end();
       $request->frm_option("valNormal (Fix as Schedule Permits)", "txtNormal (Fix as Schedule Permits)"); $request->frm_option_end();
       $request->frm_select_end();
       $request->frm_label_end();
       $request->br();
//     echo $request->end_table();
       $request->p_end();
// ########Post Data to variables
       $request->frm_input($nam="namaction", $typ="typsubmit", $val="valSubmit");
       $request->frm_input($nam="nam.reset", $typ="typreset", $val="valReset");
    $request->form_end();
}//endfunction
#########################################################################################
#	submit_entry									#
#########################################################################################
#Purpose: Takes data from variables and formats it for entry to mySQL database via sql statements
function submit_entry($db_connection, $request, $owner, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS){

########Parse form for errors or missing data
   // error_checker();    //Need to code error_checker code
########Submit data to the database via sql

    $status="Open"; //setting record status to Open

    # Add this entry to the database using placeholders(?'s)
    $script = "INSERT INTO error_tracking ( Name, Email, AssetTag, Priority, Status, TimeStart, ErrorType, Description, OS) VALUES ( \"$name\", \"$email\", \"$assetNumber\", \"$priorityLevel\", \"$status\", \"$timeStart\", \"$errorType\", \"$description\", \"$OS\")";

    $stmt = mysqli_prepare($db_connection, $script);
    mysqli_stmt_bind_param($stmt, 'sssssssss', $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS);

    /* execute prepared statement */
    $results=mysqli_execute($stmt) or die('Query failed: ' . mysql_error());;

    # Display confirmation that the entry was accepted.
    $request->div_beg("id_menu");
    $request->anchor("it_srq_class.php?action=Post", "Post a Request", "clamenuitem");
    $request->anchor("../../?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    $request->div_end();
    $request->br();
    printf("%d Row inserted.\n", $results);
    $request->br();
    /* close statement and connection */
    mysqli_close($db_connection);

    print_r($_REQUEST); //for debugging
    echo "Thank you for your $owner&#39;s Request.\n";
}//endfunction
#########################################################################################
#	display_entry         ********PUBLIC VIEW                                       #
#########################################################################################
#Purpose:Displays only open records for public viewing
function display_entry($fb_connection, $request, $owner, $view, $name, $email, $assetNumber, $priorityLevel, $status, $timeStart, $errorType, $description, $OS){

     //prepare sql statement to grab contents of error_tracking table thats not either a closed or resolved request.
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

############################# Fetch the contents of the requests
    //test $view for kbase or display to decide which SQL statement to use.

    if ($view=="display"){
      $script=$scriptORecords;
    }elseif ($view=="kbase"){
      $script=$scriptCRecords;
    }//endif

    /* execute prepared statement */
    $results=mysqli_query($db_connection,$script);


############################## Display the requests
    $request->div_beg("id_menu");
    $request->anchor("it_srq_class.php?action=Post", "Post a Request", "clamenuitem");
    $request->anchor("../../?section=51", "Back To $owner&#39;s Request System Home", "clamenuitem");
    $request->div_end();
    $request->br();
    $request->hr();
    $request->p_beg();
    $request->table_beg();
/*         $request->colgroup_beg();     //colgroup can be used to format columns
           $request->col("id_request");
           $request->col("id_name");
           $request->col("id_email");
           $request->col("id_assetNumber");
           $request->col("id_status");
           $request->col("id_priorityLevel");
           $request->col("id_errorType");
           $request->col("id_description");
           $request->col("id_os");
           $request->col("id_assigned");
           $request->col("id_timeStart");
           $request->col("id_timeStop");
           $request->col("id_resolution");
        $request->colgroup_end(); */
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
    $request->table_end();
    $request->p_end();
    # Stop processing our statement
    mysqli_close($db_connection);
}//endfunction


########################################################################################################################################
#                                  ************ ADMIN VIEW SECTIONS ******************************************                         #
########################################################################################################################################
####################################################################################################
#        login                                                                                     #
####################################################################################################
#purpose: To Login to Admin view
function login($db_connection, $request, $owner)
{
###############Recall cookies if any
//if ($recall1 !==""){   //re-enable for cookie testing
    // $recall1=$request->cookie('user_name');
    // $recall2=$request->cookie('password');
//authenticate();
//}else{  //re-enable for cookie testing
     # Show the form
    echo '<div id="menu">';
    echo "<A class=menuitem href=\"it_srq_class.php?action=post\">Post a Request</a>";
    echo "<A class=menuitem href=\"../../?section=51\">Back To IT Request System Home</a></div>";
    echo "</div>";
    #echo "<a href=\"", $request->url(), "?action=View\">Public View</a>"," <a href=../../services/index.php?Department=25>Back To IT Request System Home</a>";
    $request->hr();
    $request->form_beg("actit_srq_class.php", "encmultipart/form-data", "mtdPOST");
    $request->bold("Enter Your Information:");
    $request->p_beg();
    echo "<table class=\"login\">\n";
//    $request->table_beg("clalogin"); //table tag not working properly yet
    echo "<tr><td style=\"text-align:left; width: 7%;\">\n";
    $request->frm_label(); echo "User Name: \n  <td style=\"text-align:left; width: 40%;\">";
       $request->frm_input("typtext", "namloginID", "siz50", "max50", "tab1"); echo "\n<br />\n";
    $request->frm_label_end();
    echo "</td></td></tr>";
    echo "<tr><td style=\"text-align:left; width: 7%;\">";
    $request->frm_label(); echo "Password: \n  <td style=\"text-align:left; width: 40%;\">";
       $request->frm_input("typpassword", "nampass", "siz50", "max10", "tab2"); echo "\n<br />\n";
    $request->frm_label_end();
    echo "</td></td></tr>";
    $request->table_end();
    $request->p_end();
#########################################**********************SET COOKIE HERE
//TODO:COOKIE CODE

########Post Data to variables
       $request->frm_input($nam="namaction", $typ="typsubmit", $val="valLogin");
       $request->frm_input($nam="nam.reset", $typ="typreset", $val="valReset");

    $request->form_end();


//}//endif //re-enable if statement for cookie testing
}//endfunction
####################################################################################################
#        authenticate                                                                              #
####################################################################################################
#purpose: to evaluate user/pass combinations
function authenticate($db_connection, $request, $loginID, $pass)
{

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

       //admin_panel(); ####Bring up AdminView after Auth.
   echo "ACCESS GRANTED";
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
function admin_panel($request){
    $request->form_beg("actit_srq_class.php", "encmultipart/form-data", "mtdPOST");
    $request->strong("Administrative Task Panel");
    $request->p_start();
    $request->div_beg("id_menu");
    $request->anchor("it_srq_class.php?action=post", "Post a Request",  "clamenuitem");
    $request->anchor("../../?section=51", "Back To IT Request System Home", "class=menuitem");
    $request->div_end();
    $request->p_end();
    $request->hr;
    $request->p_start();
############################*****************INSERT COOKIE CALL HERE
########Post Data to variables
   print $request->table_beg();
    #print $request->Tr([
    echo "<tr>";
    #$request->td([
    echo "<td>";
    $request->input("typsubmit", "namaction", "valRecall");  #Edit previous request
    echo "Edit a previous request";
    echo "</td>";
    echo "<td>";
    $request->input("typsubmit", "namaction", "valRequest");  #Post a Intra-Dept Task
    echo "Post an Intra-Dept Task";
    echo "</td>";
    echo "<td>";
    $request->input("typsubmit", "namaction", "valView Open");  #View Open Public request
    echo "View Open Public Requests";
    echo "</td>";
    echo "<td>";
    $request->input("typsubmit", "namaction", "valView Closed");  #View Closed Public request
    echo "View Closed Public Requests";
    echo "</td>";
    echo "<td>";
    $request->input("typsubmit", "namaction", "valView Tasks");  #View Intra-Dept Requests
    echo "View Intra-Dept Tasks";
    echo "</td>";
    echo "<td>";
    $request->input("typsubmit", "namaction", "valReports");  #Built-In Report Generator
    echo "Run Built-in Reports";
    echo "</td>";
#    print $request->submit(  #***** Use this when cookies work right
#	-name  => "action",
#	-value => "Log Out");
    $request->form_end;
    $request->p_end();
}









?>