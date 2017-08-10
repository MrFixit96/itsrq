<?php

#####################################################################
#                                                                   #
#                           EMAIL_ACTION                            #
#                                                                   #
#         -email_action function will create and send an email      #
#     with the desired information to the desired party             #
#                                                                   #
#     VARIABLES
#       $email_action - passed: contains information to determine
#    what needs to be emailed and to whom.
#
#       $post_ID - passed: contains the post ID number: the RegID
#    to be able to get information from the database.
#
#####################################################################

function request_email($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner){

/*  //debug variables being passed
  echo " \$email_action: " . $email_action . "    \$post_ID: " . $post_ID
    . "    \$admin_email_notification_subject: " . $admin_email_notification_subject
    . "    \$global_owner_email: " . $global_owner_email;
	br(3);
*/
  
  
  //set the php.ini file to be able to send emails
  //      -to do this you HAVE to change the SMTP setting
  //           the smtp_port's default is "25"
  //
  //ini_set("SMTP", "exchange.peoriachristian.org");
  //ini_set("smtp_port", "25");

  switch ($email_action){
    case $email_action == "esubmit":    //EMAIL BOTH US AND THEM
      email_action_esubmit($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner);
      break;
    case $email_action == "echange":
      email_action_echange($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner);
      break;
    case $email_action == "eresolve":
      email_action_eresolve($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner);
      break;
    case $email_action == "eclose":
      email_action_eclose($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner);
      break;
    case $email_action == "isubmit":
      email_action_isubmit($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url);
      break;
    case $email_action == "ichange":
      email_action_ichange($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url);
      break;
    case $email_action == "iresolve":
      email_action_iresolve($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url);
      break;
  }//end switch($email_action)

}//end function request_email($email_action, $post_ID)


#########################################################
#                                                       #
#            EMAIL_ACTION_ESUBMIT                       #
#                 -Sends 2 emails                       #
#                   >one to the user                    #
#                   >one to the admins                  #
#                                                       #
#########################################################
function email_action_esubmit($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner){
  #########################################################
  #                   ADMIN EMAIL CODE                    #
  #########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the admins
  $script = "SELECT Name, Priority, Description FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
  //Content of email
  $body = "<html>
           <head>
           <title>Request Posted</title>
           </head>
           <body>
           <center><h1>$owner Request Posted</h1></center>
           <hr/>
           <h3>This is an automatic email alerting to a request being posted.</h3>
           <br />
           <h4>Name: </h4>" . $row["Name"] /* Insert the name of submitter */ . "<br />
           <h4>Priority: </h4>" . $row["Priority"] /* Insert the priority */ . "<br />
           <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
           <br />
           To view the request on the IT request system Click Here<a href=\"" . $owner_email_beg_url . "?action=view_request&post_ID=\n" . $post_ID . "\"> request number $post_ID</a>.
           </body>
           </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

//debugging############################################################	
	echo " <br /> $admin_email_notification_subject <br />";
 
 }//end while

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ESUBMIT - TO ADMIN EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject($admin_email_notification_subject);
  #$mail->setSubject('IT Service Request Posted');
  $mail->setPriority('high');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.'); //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($admin_email_list));

  #########################################################
  #                   USER EMAIL CODE                     #
  #########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the users
  $script = "SELECT Name, Email, Description FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //Content of email to the user
    $body = "<html>
             <head>
             <title>Request Posted</title>
             </head>
             <body>
             <center><h1>$owner Request Posted</h1></center>
             <hr />
             <h3>Thank you " . $row["Name"] . " for submitting your request.</h3>
             <p>This is an automatic email confirming your request has been submitted. An email has also been sent to the IT Services Department. We thank you in andvance for your patience while we work to quickly remedy the situation. For your reference we have included the description of the problem that you submitted.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <br /><br />
             You can view your request on the request system by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             <br />
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the html output[if you look at it pre-email in debug on the web browser]) ***MIME MAIL only allows 70char width.JCAA***

    $email_to = $row["Email"]; //stores who to email the automatic email to
  }//end while
  mysqli_close($db_connection); //close connection

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ESUBMIT - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject('IT Service Request Posted');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.'); //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
}//end email_action_esubmit function

#########################################################
#                                                       #
#            EMAIL_ACTION_ECHANGE                       #
#                 -Sends 2 emails                       #
#                   >one to the user                    #
#                   >one to the assignee                #
#########################################################
function email_action_echange($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner){
  #########################################################
  #                   USER EMAIL CODE                     #
  #########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the users after the status have been changed
  $script = "SELECT Name, Email, Resolution, Assigned, `Status`, Description FROM error_tracking WHERE RegID='$post_ID'";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //EMAIL BODY
    $body = "<html>
             <head>
             <title>Request Status Changed</title>
             </head>
             <body>
             <center><h1>$owner Request Status Changed</h1></center>
             <hr/>
             <h3>" . $row["Name"] . ", your request status has been changed.</h3>
             <p>This is an automatic email notifying you of the changes made.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Status: </h4>" . $row["Status"] /* Insert the status */ . "<br />
             <h4>Resolution: </h4>" . $row["Resolution"] /* Insert the resolution */ . "<br />
             <br /><br />
             You can view your request's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             <br />
			 </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

    //EMAIL TO AND FROM
    $email_to = $row["Email"];
    $assigned = $row["Assigned"]; 
  }//end while
  //mysqli_close($db_connection); //close connection

  //GET Admin EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  //email_from($assigned, &$email_from);//NOT USED changed to $global_owner_email


  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECHANGE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject('IT Service Request Changed');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.'); //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
 #########################################################
 #			Admin Email Code
 ######################################################### 
//Purpose: To send Assignee an email about status changes in case the task was reassigned to him by someone else.
  $script = "SELECT * FROM error_tracking WHERE RegID='$post_ID'";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //EMAIL BODY         
		 $body = "<html>
                <head>
                <title>Request Assigned</title>
                </head>
                <body>
                <center><h1>$owner Request Changed</h1></center>
                <hr/>
                <h3>$assigned, a service request has been submitted and assigned to you.</h3>
                <br />
                <h4>Name: </h4>" . $row["Name"] /* Insert the name of submitter */ . "<br />
                <h4>Priority: </h4>" . $row["Priority"] /* Insert the priority */ . "<br />
                <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br /><br />
                <p>This service request has been assigned to you. Please take the actions needed to complete this in the appropriate time frame. Thank you.</p>
                <br /><br />
                You can view your task's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
                </body>
                </html>";

      $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

  }//end while
  mysqli_close($db_connection); //close connection

  //GET EMAIL TO - CONTAINED INSIDE OF CONFIG.PHP
 // email_from($assigned, &$email_from);
  email_to($assigned, &$email_to);

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECLOSE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject('IT Service Request Changed');
  $mail->setPriority('high');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.');  //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
  
  
}//end email_action_echange function


#########################################################
#                                                       #
#            EMAIL_ACTION_RESOLVE                       #
#                 -Sends 1 email                        #
#                   >one to the user                    #
#                                                       #
#########################################################
function email_action_eresolve($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner){
  #########################################################
  #                   USER EMAIL CODE                     #
  #########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the users after the request has been closed
  $script = "SELECT Name, Email, Resolution, Assigned, `Status`, Description FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //Content of email
    $body = "<html>
             <head>
             <title>Request Status Completed</title>
             </head>
             <body>
             <center><h1>$owner Request Status Completed</h1></center>
             <hr/>
             <h3>" . $row["Name"] . ", your service request has been completed.</h3>
             <p>This is an automatic email notifying you of the changes made.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Status: </h4>" . $row["Status"] /* Insert the status */ . "<br />
             <h4>Resolution: </h4>" . $row["Resolution"] /* Insert the resolution */ . "<br />
             <br /><br />
             You can view your request's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             <br />
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

    //EMAIL TO AND FROM
    $email_to = $row["Email"];
    $assigned = $row["Assigned"]; 

  }//end while
  mysqli_close($db_connection); //close connection

  //GET EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  //email_from($assigned, &$email_from);//NOT USED changed to $global_owner_email

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECLOSE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject('IT Service Request Completed');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.');  //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
}//end email_action_eresolve function

#########################################################
#                                                       #
#            EMAIL_ACTION_CLOSE                         #
#                 -Sends 1 email                        #
#                   >one to the user                    #
#                                                       #
#########################################################
function email_action_eclose($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url, $owner){
  #########################################################
  #                   USER EMAIL CODE                     #
  #########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the users after the request has been closed
  $script = "SELECT Name, Email, Resolution, Assigned, `Status`, Description FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //Content of email
    $body = "<html>
             <head>
             <title>Request Status Closed</title>
             </head>
             <body>
             <center><h1>$owner Request Status Closed</h1></center>
             <hr/>
             <h3>" . $row["Name"] . ", your service request has been Closed or Denied by an Administrator.</h3>
             <p>This is an automatic email notifying you of the changes made and a possible reason in the Resolution field.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Status: </h4>" . $row["Status"] /* Insert the status */ . "<br />
             <h4>Resolution: </h4>" . $row["Resolution"] /* Insert the resolution */ . "<br />
             <br /><br />
			 If you feel this was a mistake please contact your Network Administrator. <br />
             You can view your request's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             <br />
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

    //EMAIL TO AND FROM
    $email_to = $row["Email"];
    $assigned = $row["Assigned"]; 

  }//end while
  mysqli_close($db_connection); //close connection

  //GET EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  //email_from($assigned, &$email_from);//NOT USED changed to $global_owner_email

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECLOSE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject('IT Service Request Closed');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.');  //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
}//end email_action_eclose function


############################################################
#                                                          #
#        BEGIN INTERNAL TASKS                              #
#                                                          #
############################################################

#########################################################
#   !INTERNAL!                                          #
#            EMAIL_ACTION_ISUBMIT                       #
#                 -Sends dynamic number of emails       #
#                  ->if(assigned is assigned)           #
#                    !>send to assignee                 #
#                  ->if(not assigned to anyone)         #
#                    !>send to department               #
#                                                       #
#########################################################
function email_action_isubmit($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url){
  #########################################################
  #              "ADMIN" (SUBMITTER) EMAIL CODE           #
  #########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the submitter/admin after the internal request has been submitted
  $script = "SELECT Name, Email, Assigned, Description FROM error_tracking WHERE RegID=$post_ID";
  $results = mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //EMAIL TO AND FROM
    $email_to = $row["Email"];
    $assigned = $row["Assigned"];

    //Content of email
    $body = "<html>
             <head>
             <title>Internal Request Submitted</title>
             </head>
             <body>
             <center><h1>$owner Internal Request Submitted</h1></center>
             <hr/>
             <h3>" . $row["Name"] . ", your Internal Service Request has been submitted.</h3>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Assigned To: </h4>";

    //if $assigned has nothing in it, outupt that it has not been assigned to otherwise output assigned
    if ($assigned == ""){
       $body .= "This Internal task has not been assigned to anyone. An email has been sent to the rest of the
                 department alerting them of this internal task being posted.";
    }
    else{
       $body .= $row["Assigned"]; /* Insert who it is assigned to */
    }

    $body .= "<br /><br />
             <p>An email has been sent to " . $row["Assigned"] /* Insert who it is assigned to */ . " reguarding this submission.</p>
             <br /><br />
             You can view your task's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

  }//end while
  //mysqli_close($db_connection); //close connection

  //GET EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  email_from($assigned, &$email_from);

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECLOSE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$email_from");
  $mail->setSubject('IT Service Request Submitted');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.');  //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));

#########################################################
#  DYNAMIC! -> restofdepartmet || assingedto EMAIL CODE #
#########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the rest of the department after the internal request has been submitted
  $script = "SELECT Name, Email, Assigned, `Status`, Description FROM error_tracking WHERE RegID=$post_ID";
  $results = mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //EMAIL TO AND FROM
    //$email_to = $row["Email"];
    $assigned = $row["Assigned"];

    //Content of email
    if ($assigned == ""){
       $body = "<html>
                <head>
                <title>Internal Request Submitted</title>
                </head>
                <body>
                <center><h1>$owner Internal Request Submitted</h1></center>
                <hr />
                <h3>This is an automatic email alerting you to an INTERNAL request being posted.</h3>
                <br />
                <h4>Name: </h4>" . $row["Name"] /* Insert the name of submitter */ . "<br />
                <h4>Priority: </h4>" . $row["Priority"] /* Insert the priority */ . "<br />
                <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
                <p>This Internal task has not been assigned to anyone. If the description of this task fits your duties, please assign it to yourself. Thank you.</p>
                <br /><br />
                You can view the task's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
                </body>
                </html>";
    }
    else{
       $body = "<html>
                <head>
                <title>Internal Request Submitted</title>
                </head>
                <body>
                <center><h1>$owner Internal Request Submitted</h1></center>
                <hr/>
                <h3>$assigned, an Internal task has been submitted and assigned to you.</h3>
                <br />
                <h4>Name: </h4>" . $row["Name"] /* Insert the name of submitter */ . "<br />
                <h4>Priority: </h4>" . $row["Priority"] /* Insert the priority */ . "<br />
                <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br /><br />
                <p>This Internal task has been assigned to you. Please take the actions needed to complete this in the appropriate time frame. Thank you.</p>
                <br /><br />
                You can view your task's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
                </body>
                </html>";

     } $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

  }//end while
  mysqli_close($db_connection); //close connection

  //GET EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  email_from($assigned, &$email_from);
  email_to($assigned, &$email_to);

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECLOSE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$email_from");
  $mail->setSubject('IT Service Request Submitted');
  $mail->setPriority('high');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.');  //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
}//end email_action_isubmit function

#########################################################
#   !INTERNAL!                                          #
#            EMAIL_ACTION_ICHANGE                       #
#                 -Sends dynamic number of emails       #
#                  ->if(assigned is assigned)           #
#                    !>send to assignee                 #
#                  ->if(not assigned to anyone)         #
#                    !>send to department               #
#                                                       #
#########################################################
function email_action_ichange($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url){
#########################################################
#  DYNAMIC! -> restofdepartmet || assingedto EMAIL CODE #
#########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the admin/submitter when the status has changed on an internal task
  $script = "SELECT Name, Email, Resolution, Status, Assigned, Description FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //EMAIL BODY
    $body = "<html>
             <head>
             <title>Internal Request Status Changed</title>
             </head>
             <body>
             <center><h1>$owner Internal Request Status Changed</h1></center>
             <hr/>
             <h3>" . $row["Name"] . ", your internal request status has been changed.</h3>
             <p>This is an automatic email notifying you of the changes made.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Status: </h4>" . $row["Status"] /* Insert the status */ . "<br />
             <h4>Resolution: </h4>" . $row["Resolution"] /* Insert the resolution */ . "<br />
             <br /><br />
             You can view your task's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

    //EMAIL TO AND FROM
    $email_to = $row["Email"];
    $assigned = $row["Assigned"];
  }//end while
  //mysqli_close($db_connection); //close connection

  //GET EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  email_from($assigned, &$email_from);

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECHANGE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$email_from");
  $mail->setSubject('Internal IT Service Request Changed');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.'); //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
########################################################
#               ASSIGNEE EMAIL CODE                    #
########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the person that changed the status on the internal task
  $script = "SELECT Name, Email, Description, Status, Resolution FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);
  while ($row = mysqli_fetch_array($results)){
    //Content of email to the user
    $body = "<html>
             <head>
             <title>Internal Request Changed</title>
             </head>
             <body>
             <center><h1>$owner Internal Request Changed</h1></center>
             <hr />
             <h3>The Internal task has been updated</h3>
             <p>This is an automatic email confirming that your internal request has been changed. An email has also been sent to the Admin. For your reference we have included the description, status, and resolution of the problem that you submitted.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Status: </h4>" . $row["Status"] /* Insert the status */ . "<br />
             <h4>Resolution: </h4>" . $row["Resolution"] /* Insert the resolution */ . "<br />
             <br /><br />
             You can view your tasks's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

    $email_to = $row["Email"]; //stores who to email the automatic email to
  }//end while
  mysqli_close($db_connection); //close connection

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ICHANGE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$global_owner_email");
  $mail->setSubject('Internal Request Status Changed');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.'); //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));
}//end function email_action_ichange

#########################################################
#   !INTERNAL!                                          #
#            EMAIL_ACTION_IRESOVLE                      #
#                 -Sends 1 email                        #
#                  ->if(assigned is assigned)           #
#                    !>send to assignee                 #
#                  ->if(not assigned to anyone)         #
#                    !>send to department               #
#                                                       #
#########################################################
function email_action_iresolve($db_connection, $email_action, $post_ID, $admin_email_notification_subject, $admin_email_list, $global_owner_email, $owner_email_beg_url){
#########################################################
#                EMAILS ADMIN/SUBMITTER                 #
#########################################################
  //selects the fields from the database that are going to be included in the email
  //  to the admin/submitter when the status has been closed on an internal task
  $script = "SELECT Name, Email, Resolution, Status, Assigned, Description FROM error_tracking WHERE RegID=$post_ID";
  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    //EMAIL BODY
    $body = "<html>
             <head>
             <title>Internal Request Status Closed</title>
             </head>
             <body>
             <center><h1>$owner Internal Request Status Closed</h1></center>
             <hr/>
             <h3>" . $row["Name"] . ", your internal request status has been closed.</h3>
             <p>This is an automatic email notifying you of the changes made.</p>
             <br />
             <h4>Description: </h4>" . $row["Description"] /* Insert the Description */ . "<br />
             <h4>Status: </h4>" . $row["Status"] /* Insert the status */ . "<br />
             <h4>Resolution: </h4>" . $row["Resolution"] /* Insert the resolution */ . "<br />
             <br /><br />
             You can view your task's status by following this link to <a href=\"$owner_email_beg_url?action=view_request&post_ID=\n$post_ID\">request number $post_ID</a>.
             </body>
             </html>"; $body = wordwrap($body, 70, "\n", true); //without this "=" characters appear (in the email not the output[if you look at it pre-email in debug on the web browser])***MIME MAIL only allows 70char width. JCAA***

    //EMAIL TO AND FROM
    $email_to = $row["Email"];
    $assigned = $row["Assigned"];
  }//end while
  //mysqli_close($db_connection); //close connection

  //GET EMAIL FROM - CONTAINED INSIDE OF CONFIG.PHP
  email_from($assigned, &$email_from);

  //!!!!!!!!!! - ACTUAL EMAIL SENDING - !!!!!!!!!!
  //ECHANGE - TO USER EMAIL
  $mail = new htmlMimeMail5();
  $mail->setFrom("$email_from");
  $mail->setSubject('Internal IT Service Request Closed');
  $mail->setPriority('normal');// low, normal, or high
  $mail->setText('If you are reading this, something has gone wrong.'); //error message if the recipeint cannot view mime encoded email
  $mail->setHTML($body);
  $mail->send(array($email_to));

}//end function email_action_iresolve

?>