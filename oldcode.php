doctype("xtrans");
html_beg();
title("$owner&#39;s Request System");
html_link("stylesheet", "text/css", "stylesheet1.css");
html_end();

div_beg("id_logo");
echo "$owner&#39;s Request System";
div_end();
br();


####################################################################################################
#        login                                                                                     #
####################################################################################################
#purpose: To Login to Admin view
function login($owner)
{
###############Recall cookies if any
//if ($recall1 !==""){   //re-enable for cookie testing
    // $recall1=$request->cookie('user_name');
    // $recall2=$request->cookie('password');
//authenticate();
//}else{  //re-enable for cookie testing
     # Show the form
    echo '<div id="menu">';
    anchor("it_srq.php?action=Post", "Post a Request", "clamenuitem");
    anchor("it_srq.php?action=View", "View Open Requests", "clamenuitem");
    echo "<A class=menuitem href=\"../../?section=51\">Back To IT Request System Home</a></div>";
    echo "</div>";
    #echo "<a href=\"", $request->url(), "?action=View\">Public View</a>"," <a href=../../services/index.php?Department=25>Back To IT Request System Home</a>";
    hr();
    form_beg("actit_srq.php", "encmultipart/form-data", "mtdPOST");
    bold("Enter Your Information:");
    p_beg();
    //echo "<table class=\"login\">\n";
    table_beg("clalogin"); //table tag wasnt working properly yet
    echo "<tr><td style=\"text-align:left; width: 7%;\">\n";
    frm_label(); echo "User Name: \n  <td style=\"text-align:left; width: 40%;\">";
       frm_input("typtext", "namloginID", "siz50", "max50", "tab1"); echo "\n<br />\n";
    frm_label_end();
    echo "</td></td></tr>";
    echo "<tr><td style=\"text-align:left; width: 7%;\">";
    frm_label(); echo "Password: \n  <td style=\"text-align:left; width: 40%;\">";
       frm_input("typpassword", "nampass", "siz50", "max10", "tab2"); echo "\n<br />\n";
    frm_label_end();
    echo "</td></td></tr>";
    table_end();
    p_end();
#########################################**********************SET COOKIE HERE
//TODO:COOKIE CODE

########Post Data to variables
       frm_input($nam="namaction", $typ="typsubmit", $val="valLogin");
       frm_input($nam="nam.reset", $typ="typreset", $val="valReset");

    form_end();


//}//endif //re-enable if statement for cookie testing
}//endfunction
