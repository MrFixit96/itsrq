
<?php
                  //`Status`!='Resolved (Completed)' AND `Status`!='Closed (Denied)' AND ErrorType!='Internal Task'";


function view_request($db_connection, $owner, $post_ID){

  srqheader($owner);

  if($post_ID == '-2'){
    echo "there has been an error, not all information is correct. You are probably getting this error from a broken link";
  }
  else{

  //output table header
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

  $script = "SELECT * FROM error_tracking WHERE RegID='$post_ID'";

  $results=mysqli_query($db_connection,$script);

  while ($row = mysqli_fetch_array($results)){
    echo "<tr class=\"request\">\n";
    echo "<td>", $post_ID, "</td>\n";
    echo "<td>", $row["Name"], "</td>\n";
    echo "<td><a href=\"mailto:",  $row["Email"],"\">", $row["Email"], "</a></td>\n";
    echo "<td>", $row["AssetTag"], "</td>\n";
    echo "<td class\"status\">", $row["Status"], "</td>\n";
    echo "<td>", $row["Priority"], "</td>\n";
    echo "<td>", $row["ErrorType"], "</td>\n";
    echo "<td>", $row["Description"], "</td>\n";
    echo "<td>", $row["OS"], "</td>\n";
    echo "<td class=\"assigned\">", $row["Assigned"], "</td>\n";
    echo "<td>", $row["TimeStart"], "</td>\n";
    echo "<td>", $row["TimeStop"], "</td>\n";
    echo "<td class=\"resolution\">", $row["Resolution"], "</td>\n";
    echo "</tr>\n";
    echo "<tr></tr>\n";
  }//endwhile
    table_end();
    p_end();
    # Stop processing our statement
    mysqli_close($db_connection);



  }//end else from checking whether or not there has been a post_id past to the function
  
  }//end function view_request




?>







