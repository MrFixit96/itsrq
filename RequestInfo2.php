<html>
<head>
<title>PCS Admissions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
  <p align="center"><font size="5" face="Arial, Helvetica, sans-serif"><strong>Peoria Christian 
    School<br>
    Admissions Department</strong></font></p>

<?php 

/* Waste of time to type this all out - use array_walk() below
$ParentName = $_POST['ParentName'];
$Address1 = $_POST['Address1'];
$Address2 = $_POST['Address2'];
$City = $_POST['City'];
$State = $_POST['State'];
$Zip = $_POST['Zip'];
$DayPhone = $_POST['DayPhone'];
$Child1 = $_POST['Child1'];
$EnrollDate1 = $_POST['EnrollDate1'];
$EnrollGrade1 = $_POST['EnrollGrade1'];
$Child2 = $_POST['Child2'];
$EnrollDate2 = $_POST['EnrollDate2'];
$EnrollGrade2 = $_POST['EnrollGrade2'];
$Child3 = $_POST['Child3'];
$EnrollDate3 = $_POST['EnrollDate3'];
$EnrollGrade3 = $_POST['EnrollGrade3'];
$Comments = $_POST['Comments'];
$DateSubmitted = date("Y-m-d");
 */

$MailTo = 'dmcintyre@peoriachristian.org' . ', ' . 'john@themacleans.net' . ', ' . 'jmaclean@peoriachristian.org';
#$MailTo = 'jmaclean@peoriachristian.org';
$MailSubject = 'Admissions Information Request';
$MailHeader = 'From: webserver@peoriachristian.org';
$SuccessMsg = 'Your request for information has been forwarded to the PCS Admissions Office.';
$FailureMsg = 'There has been a problem forwarding your request to the PCS Admissions Office.
			Please call the school at 309.686.4500 to make your request.  We apologize for this 
			inconvenience.';
$IncompleteMsg = 'You left out some required data. <strong>Please click the Back button
			on your browser to return to the 
			Information Request Form.</strong> Then complete all required data and resubmit the form.
			It seems you did not complete the following: ';

$Data = 'Someone just requested admissions information on the PCS website.'.
		'Here is what the requester submitted:'."\n\n".
		'###############Start of Record##################'. "\n\n";
function ListAll($aVal, $aKey, &$List)
{
	global $Incomplete;
	if(($aVal == '') && (stristr($_POST['Required'],$aKey)))
	{
		$Incomplete = $Incomplete.$aKey.', ';
	}
	$List = $List.$aKey.' = '.$aVal."\n";
}

$Success = array_walk($_POST, 'ListAll', &$Data);
if($Success)
{
	if($Incomplete == '')
	{
		if(mail($MailTo,$MailSubject,$Data,$MailHeader))
		{
			echo "<p>$SuccessMsg</p>";
			echo $Incomplete;
		}
		else
		{
			echo "<p>$FailureMsg (mail failure)</p>";
		}
	}
	else
	{
		echo "<p>$IncompleteMsg <br><br> $Incomplete</p>";
	}
}
else
{	
	echo "<p>$FailureMsg (array_walk failure)</p>";
}
?>
<form method="post"> 
  <p align="center">
    <input type="button" value="Close Window" onclick="window.close()"> &nbsp;&nbsp;
  </p>
</form> 


</body>
</html>
