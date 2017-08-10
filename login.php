<?php
session_start();
include 'functions.php'; //include html output function.
include 'config.php';// includes itsrq config information.

if (isset($_POST["submit"])) {
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  $auth = false;
  $admin = false;
  $pwdb = mysql_connect("localhost", "root", "mo29jo4s");
  mysql_select_db("service_requests", $pwdb);
  $rows = mysql_query("SELECT Name, Password, ITServices FROM security", $pwdb);
  while ($row = mysql_fetch_array($rows)) {
    if ($user == $row["Name"] && $pass == $row["Password"]) {
      $auth = true;
	  	if ($row["ITServices"] == '1'){
			$admin = true;
			break;
		}
      break;
    }
  }

  if ($auth) {
    $_SESSION["username"] = $user;
	if ($admin){
		$_SESSION["admin"] = $user;
	}
    if (isset($_REQUEST["action"])) {
      $action = $_REQUEST["action"];
    }
    if (isset($_REQUEST["post_ID"])) {
      $postid = "&post_ID=" . $_REQUEST["post_ID"];
    }
    else{
      $postid = "";
    }  
    if (isset($_GET["url"])) {
      $url = $_GET["url"] . $action . $postid;
    } else {
      $url = "index.php";
    }
    
    if (!isset($_COOKIE[session_name()])) {
      if (strstr($url, "?")) {
        header("Location: " . $url . "&" . session_name() . "=" . session_id());
      } else {
        header("Location: " . $url . "?" . session_name() . "=" . session_id());
      }
    } else {
      header("Location: " . $url);
    }
  }
}
	doctype("xtrans");
	html_beg();
	head_beg();
	title("User Authentication for $owner&#39;s Request System");
	html_link("stylesheet", "text/css", "stylesheet1.css");
	head_end();
	body_beg();
	div_beg("id_logo");
		echo "$owner&#39;s Request System";
	div_end();
	br();
	div_beg("id_menu");
    anchor("http://pcsfamily.org", "Back to PCS Family Home", "clamenuitem");
    anchor("http://pcsfamily.org/index.php?section=160", "Back To $owner&#39;s Request System Home", "clamenuitem");
    div_end();
	hr(); 

	
echo "<form method=\"post\">";
echo "<input type=\"text\" name=\"user\" /><br />";
echo "<input type=\"password\" name=\"pass\" /><br />";
echo "<input type=\"submit\" name=\"submit\" value=\"Login\" />";
echo "</form>";
	body_end();
	html_end();

?>