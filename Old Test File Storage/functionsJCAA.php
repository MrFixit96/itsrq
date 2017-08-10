<?php

##############################################################################################
#                                   HTML FUNCTIONS                                           #
#                                                                                            #
#      Purpose: To create functions that echo out html code inside of php                    #
#      EULA: Copying this or giving it to anyone without the express permission of           #
#                  Brian Farney or James Anderton will be punnished with a severe type of    #
#                  pummeling in which no restraint will be used on said pummelers. *insert   #
#                  four pages of legal code here*                                            #
#      Author:Brian Farney, James Anderton                                                   #
#    Date: 3-6-2006                                                                          #
#      Version: 2.1.3432.00012.21b.3                                                         #
#                                                                                            #
#                                                                                            #
##############################################################################################



##############################################################################################
#                                  HTML Comment tags                                         #
#                                                                                            #
#      //Insert text to be commented in html as a string in the function                     #
#                                                                                            #
##############################################################################################
function comment($comment_text = ""){
  echo "<!-- $comment_text -->\n";
}//end function
##############################################################################################
#                                      DOCTYPE TAG                                           #
#                                                                                            #
#      //This DOCTYPE TAG is for use at the very first line of any php document outputting   #
#      //      html.                                                                         #
#                                                                                            #
#           HTML 4.01                                       XHTML                            #
#    input             result                   input                   result               #
#  "4strict"  ----   strict.dtd                "xstrict"    ----    xhtml1-strict.dtd        #
#  "4loose"   ----   loose.dtd                 "xtrans"     ----    xhtml1-transitional.dtd  #
#  "4frame"   ----   frameset.dtd              "xframe"     ----    xhtml1-frameset.dtd      #
#                                                                                            #
#                                                                                            #
##############################################################################################
function doctype($type = "xtrans"){
  if ($type != ""){
    $sel = substr($type, 0, 1);
    $val = substr($type, 1, (strlen($type)-1));
    switch ($sel){
      case $sel == 4:
        switch ($val){
          case $val == "strict":
            echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">\n";
            break;
          case $val == "loose":
            echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
            break;
          case $val == "frame":
            echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Frameset//EN\" \"http://www.w3.org/TR/html4/frameset.dtd\">\n";
            break;
        }//end 4.01 attribute selection
      break;
      case $sel == "x":
        switch ($val){
          case $val == "strict":
            echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
            break;
          case $val == "trans":
            echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
            break;
          case $val == "frame":
            echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Frameset//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd\">\n";
            break;
        }//end xhtml attribut selection
      break;
      default:
        //do nothing
      break;
    }//end selection between 4.01 and xhtml
    }//end if $type is not equal to ""
    else {
      //do nothing because it didn't ask for anything
    }//end else
}//end doctype function
##############################################################################################
#                                   HTML BEGINNING TAG                                       #
##############################################################################################
function html_beg(){
  echo "<html>\n";
}
##############################################################################################
#                                   HTML ENDING TAG                                          #
##############################################################################################
function html_end(){
  echo "</html>\n";
}
##############################################################################################
#                                    HEAD BEGINNING TAG                                      #
##############################################################################################
function head_beg(){
  echo "<head>\n";
}
##############################################################################################
#                                     HEAD ENDING TAG                                        #
##############################################################################################
function head_end(){
  echo "</head>\n";
}
##############################################################################################
#                                       TITLE TAG                                            #
##############################################################################################
function title($title = "New Page"){
  echo "  <title>$title</title>\n";//spaces indent tags inside of html
}
##############################################################################################
#                           HTML HEADER WITH TITLE TAG AND DOCTYPE                           #
#                                                                                            #
#      //HTML_HEADER function outputs a general doctype, html, head, and                     #
#      //        title tags. it requires a $type variable for doctype and                    #
#      //        $title for the title tag                                                    #
#                                                                                            #
#                                                                                            #
##############################################################################################
function html_header($type, $title){
  doctype($type);
  html_beg();
  head_beg();
  title($title);
  //link($rel, $ltype, $href); //Uncomment to Add CSS Link Code
  head_end();
}
##############################################################################################
#                                     BEGINNING BODY TAG                                     #
##############################################################################################
function body_beg(){
  echo "<body>\n";
}
##############################################################################################
#                                     ENDING BODY TAG                                        #
##############################################################################################
function body_end(){
  echo "\n</body>\n";
}
##############################################################################################
#                          IDCLASS FUNCTION - CSS EMEMENT SELECTOR                           #
#                                                                                            #
#      //CSS ELEMENT SELECTOR - selects ID OR CLASS then echos out html code with            #
#      //      those attributes. To select the id attribute the first two characters of      #
#      //      the input must be exactly "id" without the quotes, and to select the class    #
#      //      attribute the input must be "cl", again without the quotes. the remaining     #
#      //      text in the string will be processed as the value for the attribute           #
#                                                                                            #
#                                                                                            #
##############################################################################################
function idclass($id = ""){
  if ($id != ""){
    $sel = substr($id, 0, 3);
    $val = substr($id, 3, (strlen($id)-3));
    switch($sel){
      case $sel == "id_":
        return "id=\"$val\"";
        break;
      case $sel == "cla":
        return "class=\"$val\"";
        break;
      default:
      //do nothing
      break;
    }//end switch
  }//end if
  else{
    //do nothing
  }//end else
}
##############################################################################################
#                                       ANCHOR TAG                                           #
#                                                                                            #
#      //anchor function for links, the first variable will go in                            #
#      //     href="$link" the second is for between the tags >$name</a>                     #
#      //     the third value has a default of null but if present will be                   #
#      //     sent to idclass css element function and will insert that                      #
#                                                                                            #
##############################################################################################
function anchor($link,$display,$css){
  if ($link != "" && $display != ""){
    echo "<a ", idclass($css), " href=\"$link\" >$display</a>";//spaces indent tags inside of html
  }//end if not nothing
  else{
    //do nothing
  }//end else
}//end function
##############################################################################################
#                                     ABBREVIATION Tag                                       #
##############################################################################################
function abbr($title = "",$abbr="", $css=""){
  echo "  <abbr ", idclass($css), "title=\"$title\">$abbr</abbr>\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                     ACRONYM Tag                                            #
##############################################################################################
function acron($title = "",$acron="", $css=""){
  echo "  <acronym ", idclass($css), "title=\"$title\">$acron</acronym>\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                     ADDRESS Tag                                            #
#                                                                                            #
#      //In the display of this html tag, the tag automatically breaks (<BR>) before and     #
#      //      after the address tag                                                         #
#                                                                                            #
##############################################################################################
function address($name = "",$street="",$city="",$state="",$zip=""){
  echo "  <address>$name <br />\n    $street <br />\n    $city, $state $zip</address>\n";
}//end function                 //above spaces are indenting inside html
##############################################################################################
#                                     AREA Tag                                               #
#                                                                                            #
#      //This tag is only used inside the map tag so we return the string instead of         #                                                                           #
#      //echoing it.                                                                         #
#                                                                                            #
##############################################################################################
function area($shape="", $coords="", $href="", $target="", $alt="area"){
  return "  <area shape=\"$shape\" coords=\"$coords\"  href=\"$href\" target=\"$target\"  alt=\"$alt\" />\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                     BOLD Tag                                               #
##############################################################################################
function bold($text, $css=""){
  echo "  <b ", idclass($css), ">$text</b>";
}//end function
##############################################################################################
#                                     B Start Tag                                            #
#  //used for bolding, but you shouldnt use it. Use CSS styling instead                      #
##############################################################################################
function b_beg($css=""){
  echo "  <b ", idclass($css), ">";
}//end function
##############################################################################################
#                                     B End Tag                                              #
#  //used for bolding, but you shouldnt use it. Use CSS styling instead                      #
##############################################################################################
function b_end(){
  echo "  </b>";
}//end function
##############################################################################################
#                                     BASE Tag                                               #
##############################################################################################
function base($href){
  echo "<base href=\"$href\" />\n";
}//end function
##############################################################################################
#                                     BDO Tag                                                #
##############################################################################################
function bdo($dir="", $text=""){
  echo "  <bdo dir=\"$dir\">$text</bdo>\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                     BIG Tag                                                #
##############################################################################################
function big($text, $css=""){
  echo "<big ", idclass($css), ">$text</big>";
}//end function
##############################################################################################
#                                     BIG Start Tag                                          #
#  //used for bolding, but you shouldnt use it. Use CSS styling instead                      #
##############################################################################################
function big_beg($css=""){
  echo "  <big ", idclass($css), ">";
}//end function
##############################################################################################
#                                     BIG End Tag                                            #
#  //used for bolding, but you shouldnt use it. Use CSS styling instead                      #
##############################################################################################
function big_end(){
  echo "  </big>";
}//end function
##############################################################################################
#                                     BLOCKQUOTE Tag                                         #
##############################################################################################
function blockquote($text, $css = ""){
  echo "  <blockquote ", idclass($css), ">\n    $text\n  </blockquote>\n";
}//end function
##############################################################################################
#                                     BLOCKQUOTE Start Tag                                   #
##############################################################################################
function block_beg($css = ""){
  echo "  <blockquote ", idclass($css), ">\n";
}//end function
##############################################################################################
#                                     BLOCKQUOTE End Tag                                     #
##############################################################################################
function block_end(){
  echo "  </blockquote>\n";
}//end function
##############################################################################################
#                                       BREAK TAG                                            #
#                                                                                            #
#        //break tag function for html, $num is specifies                                    #
#        //      how many break tags you want to echo out                                    #
#        //   limited to 20 for sanity                                                     #
#                                                                                            #
##############################################################################################
function br($num = 1){
  $index = 0;
  if ($num >= 1 or $num <= 20){
    echo "\n";
    while ($index < $num){
      echo "<br />";
      $index += 1;
    }//end while
    echo "\n";
  }//end if
  else{
    //do nothing
  }//end else
}//end function
##############################################################################################
#                                     CAPTION Tag                                            #
##############################################################################################
function caption($text="", $css=""){
  echo "  <caption ", idclass($css), ">$text</caption>\n";
}//end function
##############################################################################################
#                                     CITE Tag                                               #
#                                                                                            #
#      //not deprecated but you should use styles instead                                    #
#                                                                                            #
##############################################################################################
function cite($text="", $css=""){
  echo "  <cite ", idclass($css), ">$text</cite>\n";
}//end function
##############################################################################################
#                                     CODE Tag                                               #
#                                                                                            #
#      //not deprecated but you should use styles instead                                    #
#                                                                                            #
##############################################################################################
function code($text="", $css=""){
  echo "  <code ", idclass($css), ">$text</cite>\n";
}//end function
##############################################################################################
#                                     DEL Tag                                                #
#  //Use it together with the <ins> tag to describe updates                                  #
#   and modifications in a document                                                          #
##############################################################################################
function del($text="", $css=""){
  echo "  <del ", idclass($css), ">$text</del>\n";
}//end function
##############################################################################################
#                                 <DIV> DIVISION BEGINNING TAG                               #
##############################################################################################
function div_beg($css){
  echo "  <div ", idclass($css), ">\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                 </DIV> DIVISION ENDING TAG                                 #
##############################################################################################
function div_end(){
  echo "\n  </div>\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                     DL Beginning Tag                                       #
#                                                                                            #
#      //Defines a definition list -  beginning tag                                          #
#                                                                                            #
##############################################################################################
function dl_beg($css=""){
  echo "  <dl ", idclass($css), ">\n";
}//end function
##############################################################################################
#                                     DL Ending Tag                                          #
#                                                                                            #
#      //Defines a definition list -  ending tag                                             #
#                                                                                            #
##############################################################################################
function dl_end(){
  echo "</dl>\n";
}//end function
##############################################################################################
#                                     DD Tag                                                 #
#                                                                                            #
#      //Defines a definition description                                                    #
#                                                                                            #
##############################################################################################
function dd($text="", $css=""){
  echo "  <dd ", idclass($css), ">$text</dd>\n";
}//end function
##############################################################################################
#                                DFN Tag                                                     #
#                                     -defines a definition term                             #                          #
#                                                                                            #
#      //its not deprecated but should use style sheets instead                              #
#                                                                                            #
##############################################################################################
function dfn($text="", $css=""){
  echo "  <dfn ", idclass($css), ">$text</dfn>\n";
}//end function
##############################################################################################
#                                     DT Tag                                                 #
#                                                                                            #
#      //defines the start of a term in the definition list, also indents under dl tag       #
#                                                                                            #
##############################################################################################
function dt($text="", $css=""){
  echo "  <dt ", idclass($css), ">$text</dt>\n";
}//end function

##############################################################################################
#                                     EM  Tag                                                #
##############################################################################################
function em($text, $css = ""){
  echo "  <em ", idclass($css), ">$text</em>";
}//end function
##############################################################################################
#                                     EM Begining Tag                                        #
#  //not deprecated but you should use Style Sheets instead                                  #
##############################################################################################
function em_beg($css=""){
  echo "  <em ", idclass($css), ">";
}//end function
##############################################################################################
#                                     EM Ending Tag                                          #
##############################################################################################
function em_end(){
  echo "</em>";
}//end function
##############################################################################################
#                                     FIELDSET Begining Tag                                  #
##############################################################################################
function fieldset_beg($css=""){
  echo "  <fieldset ", idclass($css), ">\n";
}//end function
##############################################################################################
#                                     FIELDSET Ending Tag                                    #
##############################################################################################
function fieldset_end(){
  echo "</fieldset>\n";
}//end function
##############################################################################################
#                                     FONT Begining Tag                                      #
# // Even though its DEPRECATED we are including this because of volume of use.              #
# //The font element was deprecated in HTML 4.01.                                            #
# //The font element is not supported in XHTML 1.0 Strict DTD.                               #
#                                                                                            #
##############################################################################################
function font_beg($color="", $face="", $size="", $css=""){
  echo "  <font ", idclass($css), " color=\"$color\" face=\"$face\" size=\"$size\">";
}//end function
##############################################################################################
#                                     FONT Ending Tag                                        #
##############################################################################################
function font_end(){
  echo "</font>\n";
}//end function



//**************************************************************************************************************************************************************
############################################################################################################################################################################################
#
#                                            FORM FUNCTIONS
#
############################################################################################################################################################################################
//**************************************************************************************************************************************************************


##############################################################################################
#                                     FORM Begining Tag                                      #
##############################################################################################
function form_beg(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <form", form_attr($attributes) ,">\n";
  }//end if
  else{
    echo "  <form>\n";
  }//end else
}//end function
function form_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_form_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_form_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "act":    //-Note: A URL that defines where to send the data when the submit button is pushed
      return " action=\"$value\""; //DTD - STF
      break;
    case $key == "acc":    //-Note: A comma separated list of content types that the server that processes this form will handle correctly
      return " accept=\"$value\"";  //DTD - STF
      break;
    case $key == "chr":    //-Note: A comma separated list of possible character sets for the form data. The default value is "unknown"
      return " accept-charset=\"$value\""; //DTD - STF
      break;
    case $key == "enc":    //-Note: The mime type used to encode the content of the form
      return " enctype=\"$value\""; //DTD - STF
      break;
    case $key == "mtd":    //-Note: The HTTP method for sending data to the action URL. Default is get.
      return " method=\"$value\""; //DTD - STF   ######  FOR MORE INFORMATION GO TO: "http://www.w3schools.com/tags/tag_form.asp"  ######
      break;
    case $key == "nam":    //-Note: Defines a unique name for the form
      return " name=\"$value\"";  //DTD - TF
      break;
    case $key == "tar":    //-Note: Where to open the target URL.
      return " target=\"$value\""; //DTD - TF    ######  FOR MORE INFORMATION GO TO: "http://www.w3schools.com/tags/tag_form.asp"  ######
      break;
    default:
      return "<!-- default error from args_switch_form_attributes() function. Check inputs -->";
      break;
    }//end switch
}//end function
##############################################################################################
#                                    INPUT TAG                                               #
##############################################################################################
function frm_input(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <input", input_attr($attributes) ," />\n";
  }//end if
  else{
    echo "  <input>\n";
  }//end else
}//end function
function input_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_input_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_input_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "key":    //-Note: Sets a keyboard shortcut to access an element, ## ONE LETTER ##
      return " acceskey=\"$value\"";
      break;
    case $key == "tab":    //-Note: Sets the tab order of an element, "0" is first, "1" second, "2" third, ...
      return " tabindex=\"$value\"";
      break;
    case $key == "acc":    //-Note: Only used with type="file"
      return " accept=\"$value\"";  //DTD - STF
      break;
    case $key == "aln":    //-Note: Only used with type="image"
      return " align=\"$value\""; //DTD - TF
      break;
    case $key == "alt":    //-Note: Only used with type="image"
      return " alt=\"$value\""; //DTD - STF
      break;
    case $key == "chk":    //-Note: Used with type="checkbox" and type="radio"
      return " checked=\"$value\""; //DTD - STF
      break;
    case $key == "dis":    //-Note: Cannot be used with type="hidden"
      return " disabled=\"$value\""; //DTD - STF
      break;
    case $key == "max":    //-Note: Only used with type="text"
      return " maxlength=\"$value\""; //DTD - STF
      break;
    case $key == "nam":                          //NAME ATTRIBUTE is REQUIRED WITH
      return " name=\"$value\"";  //DTD - STF    //       type=  button, checkbox, file, hidden, image,
      break;                                     //              password, text, and radio
    case $key == "rdo":
      return " readonly=\"$value\""; //DTD - STF
      break;
    case $key == "siz":    //-Note: Only used with type="text"
      return " size=\"$value\""; //DTD - STF
      break;
    case $key == "src":    //-Note: Cannot be used with type="hidden"
      return " src=\"$value\""; //DTD - STF
      break;
    case $key == "typ":    //-Note: REQUIRED, if ommitted default is "text" - it is NOT advised to let it default
      return " type=\"$value\""; //DTD - STF
      break;
    case $key == "val":    //-Note: Cannot be used with type="file" BUT is REQUIRED with checkbox and radio
      return " value=\"$value\""; //DTD - STF
      break;
    default:
      return "<!-- default error from args_switch_input_attributes() function. Check inputs -->";
      break;
    }//end switch
}//end function
##############################################################################################
#                                    TEXTAREA TAG                                            #
##############################################################################################
function frm_textarea(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <textarea", textarea_attr($attributes) ,">\n";
  }//end if
  else{
    echo "  <textarea>\n";
  }//end else
}//end function
function textarea_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_textarea_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_textarea_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "key":    //-Note: Sets a keyboard shortcut to access an element, ## ONE LETTER ##
      return " acceskey=\"$value\"";
      break;
    case $key == "tab":    //-Note: Sets the tab order of an element, "0" is first, "1" second, "2" third, ...
      return " tabindex=\"$value\"";
      break;
    case $key == "col":    //-Note: Specifies the number of columns visible in the text-area
      return " cols=\"$value\""; //DTD - STF
      break;
    case $key == "row":    //-Note: Specifies the number of rows visible in the text-area
      return " rows=\"$value\""; //DTD - STF
      break;
    case $key == "dis":    //-Note: Disables the text-area when it is first displayed
      return " disabled=\"$value\""; //DTD - STF
      break;
    case $key == "nam":    //-Note: Specifies a name for the text-area
      return " name=\"$value\"";  //DTD - STF
      break;
    case $key == "rdo":    //-Note: Indicates that the user cannot modify the content in the text-area
      return " readonly=\"$value\""; //DTD - STF
      break;
    default:
      return "<!-- default error from args_switch_textarea_attributes() function. Check inputs -->";
      break;
    }//end switch
}//end function
##############################################################################################
#                                    TEXTAREA ENDING TAG                                     #
##############################################################################################
function frm_textarea_end(){
  echo "  </textarea>\n";
}//end function  
##############################################################################################
#                                      BUTTON TAG                                            #
##############################################################################################
function frm_button(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <button", button_attr($attributes) ,">\n";
  }//end if
  else{
    echo "  <button>\n";
  }//end else
}//end function
function button_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_button_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_button_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "key":    //-Note: Sets a keyboard shortcut to access an element, ## ONE LETTER ##
      return " acceskey=\"$value\"";
      break;
    case $key == "tab":    //-Note: Sets the tab order of an element, "0" is first, "1" second, "2" third, ...
      return " tabindex=\"$value\"";
      break;
    case $key == "dis":    //-Note: Disables the button
      return " disabled=\"$value\""; //DTD - STF
      break;
    case $key == "nam":    //-Note: Specifies a unique name for the button
      return " name=\"$value\"";  //DTD - STF
      break;
    case $key == "typ":    //-Note: Defines the type of button either "button", "reset", or "submit"
      return " type=\"$value\""; //DTD - STF
      break;
    case $key == "val":    //-Note: Specifies an initial value for the button. The value can be changed by a script
      return " value=\"$value\""; //DTD - STF
      break;
    default:
      return "<!-- default error from args_switch_button_attributes() function. Check inputs -->";
      break;
  }//end switch
}//end function
##############################################################################################
#                                    BUTTON ENDING TAG                                       #
##############################################################################################
function frm_button_end(){
  echo "  </button>\n";
}//end function  
##############################################################################################
#                                    SELECT TAG                                              #
##############################################################################################
function frm_select(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <select", select_attr($attributes) ,">\n";
  }//end if
  else{
    echo "  <select>\n";
  }//end else
}//end function
function select_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_select_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_select_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "key":    //-Note: Sets a keyboard shortcut to access an element, ## ONE LETTER ##
      return " acceskey=\"$value\"";
      break;
    case $key == "tab":    //-Note: Sets the tab order of an element, "0" is first, "1" second, "2" third, ...
      return " tabindex=\"$value\"";
      break;
    case $key == "dis":    //-Note: When set, it disables the drop-down list
      return " disabled=\"$value\""; //DTD - STF
      break;
    case $key == "mul":    //-Note: When set, it specifies that multiple items can be selected at a time
      return " multiple=\"$value\""; //DTD - STF
      break;
    case $key == "nam":    //-Note: Defines a unique name for the drop-down list
      return " name=\"$value\"";  //DTD - STF
      break;
    case $key == "siz":    //-Note: Defines the number of visible items in the drop-down list
      return " size=\"$value\""; //DTD - STF
      break;
    default:
      return "<!-- default error from args_switch_switch_attributes() function. Check inputs -->";
      break;
  }//end switch
}//end function
##############################################################################################
#                                    SELECT ENDING TAG                                       #
##############################################################################################
function frm_select_end(){
  echo "  </select>\n";
}//end function  
##############################################################################################
#                                    OPTGROUP TAG                                            #
##############################################################################################
function frm_optgroup(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <optgroup", optgroup_attr($attributes) ,">\n";
  }//end if
  else{
    echo "  <optgroup>\n";
  }//end else
}//end function
function optgroup_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_optgroup_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_optgroup_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "dis":    //-Note: When set, it disables the drop-down list
      return " disabled=\"$value\""; //DTD - STF
      break;
    case $key == "lbl":    //-Note: Defines the label for the option group
      return " label=\"$value\""; //DTD - STF
      break;
    default:
      return "<!-- default error from args_switch_optgroup_attributes() function. Check inputs -->";
      break;
  }//end switch
}//end function
##############################################################################################
#                             OPTGROUP ENDING TAG                                            #
##############################################################################################
function frm_optgroup_end(){
  echo "  </optgroup>\n";
}//end function  
##############################################################################################
#                                    OPTION TAG                                              #
##############################################################################################
function frm_option(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "    <option", option_attr($attributes) ,">\n";
  }//end if
  else{
    echo "    <option>\n";
  }//end else
}//end function
function option_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_option_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_option_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "tab":    //-Note: Sets the tab order of an element, "0" is first, "1" second, "2" third, ...
      return " tabindex=\"$value\"";
      break;
    case $key == "dis":    //-Note: Specifies that the option should be disabled when it first loads
      return " disabled=\"$value\""; //DTD - STF
      break;
    case $key == "lbl":    //-Note: Defines a label to use when using <optgroup>
      return " label=\"$value\""; //DTD - STF
      break;
    case $key == "sel":    //-Note: Specifies that the option should appear selected (will be displayed first in the list)
      return " selected=\"$value\""; //DTD - STF
      break;
    case $key == "val":    //-Note: Defines the value of the option to be sent to the server
      return " value=\"$value\""; //DTD - STF
      break;
    default:
      return " <!-- default error from args_switch_option_attributes() function. Check inputs -->";
      break;
  }//end switch
}//end function
##############################################################################################
#                                    OPTION ENDING TAG                                       #
##############################################################################################
function frm_option_end(){
  echo "  </option>\n";
}//end function  
##############################################################################################
#                                     LABEL TAG                                              #
##############################################################################################
function frm_label(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <label", label_attr($attributes) ,">\n";
  }//end if
  else{
    echo "  <label>\n";
  }//end else
}//end function
function label_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    echo args_switch_label_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_label_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "for":    //-Note: Defines which form element the label is for. Set to an ID of a form element. NOTE - If not set it will be associated with its contents
      return " for=\"$value\""; //DTD - STF
      break;
    default:
      return " <!-- default error from args_switch_label_attributes() function. Check inputs -->";
      break;
  }//end switch
}//end function
##############################################################################################
#                                    LABEL ENDING TAG                                        #
##############################################################################################
function frm_label_end(){
  echo "  </label>\n";
}//end function




##############################################################################################
#                                    LEGEND TAG                                              #
##############################################################################################
function frm_legend(){
  $attributes = func_get_args();
  if ($attributes != ""){
    echo "  <legend", legend_attr($attributes), ">", legend_text($attributes), "</legened>\n";
  }//end if
  else{
    echo "<!-- The legend function needs to have input. txt*...* is required input -->";
  }//end else
}//end function
function legend_text($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    if ($sel == "txt"){
      return $val;
    }//end if
    else{
      //if else do nothing
    }//end else
  }//end foreach
}//end function
function legend_attr($attributes){
  foreach ($attributes as $value){
    $sel = substr($value, 0, 3);
    $val = substr($value, 3, (strlen($value)-3));
    return args_switch_legend_attributes($sel, $val);
  }//end foreach
}//end function
function args_switch_legend_attributes($key, $value){
  switch ($key){
    case $key == "id_":    //-Note: The class of the element
      return " id=\"$value\""; //DTD - STF
      break;
    case $key == "cla":    //-Note: A unique id for the element
      return " class=\"$value\""; //DTD - STF
      break;
    case $key == "txt":    //-Note: This is taken care of later
      //do nothing
      break;
    case $key == "aln":    //-Note: Defines the alignment for contents in the fieldset. Top is default
      return " align=\"$value\""; //DTD - TF
      break;
    default:
      return "<!-- default error from args_switch_legend_attributes() function. Check inputs -->";
      break;
  }//end switch
}//end function








##############################################################################################
#                                     FORM Ending Tag                                        #
##############################################################################################
function form_end(){
  echo "</form>\n";
}//end function
##############################################################################################
#                                     FRAME Begining Tag                                     #
##############################################################################################
function frame_beg($frameborder="", $longdesc="", $marginheight="", $marginwidth="",
     $name="", $noresize="", $scrolling="", $src="", $css=""){
  echo "  <frame ", idclass($css), " frameborder=\"$frameborder\" longdesc=\"$longdesc\" marginheight=\"$marginheight\" marginwidth=\"$marginwidth\" name=\"$name\" noresize=\"$noresize\" scrolling=\"$scrolling\" src=\"$src\">\n";
}//end function
##############################################################################################
#                                     FRAME Ending Tag                                       #
##############################################################################################
function frame_end(){
  echo "</frame>\n";
}//end function
##############################################################################################
#                                     FRAMESET Begining Tag                                  #
##############################################################################################
function frameset_beg($cols="", $rows="", $css=""){
  echo "  <frameset ", idclass($css), " cols=\"$cols\" rows=\"$rows\">\n";
}//end function
##############################################################################################
#                                     FRAMESET Ending Tag                                    #
##############################################################################################
function frameset_end(){
  echo "</frameset>\n";
}//end function
##############################################################################################
#                                     H1 to H6 Begining Tag                                  #
##############################################################################################
function heading_beg($number="", $css=""){
  if ($number >=1 && $number <=6){
    echo "  <h$number ", idclass($css), ">";
  }else{
     //do nothing
 } //end if
}//end function
##############################################################################################
#                                     H1 to H6 Ending Tag                                    #
##############################################################################################
function heading_end($number=""){
    if ($number >=1 && $number <=6){
    echo "  </h$number>\n";
  }
  else{
     //do nothing
 } //end if
}//end function
##############################################################################################
#                                     HR Tag                                                 #
##############################################################################################
function hr($css=""){
  echo "  <hr ", idclass($css), " />\n";
}//end function
##############################################################################################
#                                     I begining Tag                                         #
#  //used for italicisizing, but you shouldnt use it. Use CSS styling instead                #
##############################################################################################
function i_beg($css=""){
  echo "  <i ", idclass($css), ">\n";
}//end function
##############################################################################################
#                                     I End Tag                                              #
#  //used for italicisizing, but you shouldnt use it. Use CSS styling instead                #
##############################################################################################
function i_end(){
  echo "  </i>\n";
}//end function
##############################################################################################
#                                     IFRAME Begining Tag                                    #
##############################################################################################
function iframe_beg($frameborder="", $height="", $longdesc="", $marginheight="", $marginwidth="",
     $name="", $width="", $scrolling="", $src="", $css=""){
  echo "  <iframe ", idclass($css), " frameborder=\"$frameborder\" height=\"$height\" longdesc=\"$longdesc\" marginheight=\"$marginheight\" marginwidth=\"$marginwidth\" name=\"$name\" width=\"$width\" scrolling=\"$scrolling\" src=\"$src\">\n";
}//end function
##############################################################################################
#                                     IFRAME Ending Tag                                      #
##############################################################################################
function iframe_end(){
  echo "</iframe>\n";
}//end function
##############################################################################################
#                                     IMAGE Tag                                              #
##############################################################################################
function img($alt="", $src="", $height="", $ismap="", $longdesc="",
     $usemap="", $width="", $css=""){
  echo "  <img ", idclass($css), " frameborder=\"$frameborder\" height=\"$height\" longdesc=\"$longdesc\" marginheight=\"$marginheight\" marginwidth=\"$marginwidth\" name=\"$name\" width=\"$width\" scrolling=\"$scrolling\" src=\"$src\" />\n";
}//end function
##############################################################################################
#                                    INS TAG                                                 #
#      //Defines inserted text.                                                              #
#                                                                                            #
#      //Tip: Use it together with the <del> tag to describe                                 #
#      //            updates and modifications to a document.                                #
#                                                                                            #
##############################################################################################
function ins(){
 //TODO INS TAG CODE HERE

}//end function
##############################################################################################
#                                 LINK TAG                                                   #
#                                                                                            #
#      //for linking to other documents including CSS files                                  #
#                                                                                            #
##############################################################################################
 function html_link($rel, $type, $href){
  if ($rel != "" && $href != ""){
     echo "  <link rel=\"$rel\" type=\"$type\" href=\"$href\" />\n";//spaces indent tags inside of html
   }//end if not nothing
   else{
    //do nothing
   }//end else
 }//end function
##############################################################################################
#                                 UNORDERED LIST BEGINNING TAG                               #
#                                                                                            #
#      //Input is for css elements, it calls IDCLASS function. reference IDCLASS             #
#                                                                                            #
##############################################################################################
function ul_beg($css){
  echo "  <ul ", idclass($css), ">\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                  UNORDERED LIST ENDING TAG                                 #
##############################################################################################
function ul_end(){
  echo "  </ul>\n";//spaces indent tags inside of html
}
##############################################################################################
#                               ORDERED LIST BEGINNING TAG                                   #
#                                                                                            #
#      //Input is for css elements, it calls IDCLASS function. reference IDCLASS             #
#                                                                                            #
##############################################################################################
function ol_beg($css){
  echo "  <ol ", idclass($css), ">\n";//spaces indent tags inside of html
}
##############################################################################################
#                                ORDERED LIST ENDING TAG                                     #
##############################################################################################
function ol_end(){
  echo "  </ol>\n";//spaces indent tags inside of html
}
##############################################################################################
#                                    LI - LIST ITEM TAG                                      #
#                                              -used with arrays only                        #
#                                                                                            #
#      //LI_ARRAY TAG - echos out a list of the items iside the array.                       #
#                                                                                            #
##############################################################################################
function li_array($array_in = ""){
  if ($array_in != ""){
    foreach ($array_in as $value){
      echo "    <li>$value</li>\n";//spaces indent tags inside of html
    }//end foreach echoing out the array in a list
  }//end if array is not nothing
  else{
    //do nothing
  }//end else
}//end function
##############################################################################################
#                                    LI - LIST ITEM TAG                                      #
#                                                                                            #
#      //INSERT TAG WITH UNLIMIITED FUNCTION INPUTS FOR LIST ITEMS - LI HERE                 #
#                                                                                            #
##############################################################################################
function li_variable(){
  $attributes = func_get_args();
  foreach ($attributes as $value){
    echo "    <li>$value</li>\n";//spaces indent tags inside of html
  }//end foreach
}//end function

##############################################################################################
#                                 <SPAN> SPAN BEGINNING TAG                                  #
##############################################################################################
function span_beg($css){
  echo "  <span ", idclass($css), ">\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                 </SPAN> SPAN ENDING TAG                                    #
##############################################################################################
function span_end(){
  echo "  </span>\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                                 <P> PARAGRAPH  W/TEXT TAG                                  #
##############################################################################################
function p($text = "", $css = ""){
  echo "  <p", idclass($css), ">$text</p>\n"; //spaces indent tags inside of html
}//end function
##############################################################################################
#                                  <P> PARAGRAPH BEGINNING TAG                               #
##############################################################################################
function p_beg(){
  echo "<p>";
}//end function
##############################################################################################
#                                  <P> PARAGRAPH ENDING TAG                                  #
##############################################################################################
function p_end(){
  echo "</p>\n";
}//end function


///**************************************************************************************************************************************************************
############################################################################################################################################################################################
#
#                                            TABLE FUNCTIONS
#
############################################################################################################################################################################################
///**************************************************************************************************************************************************************

##############################################################################################
#                                  TABLE Tag                                                 #
#                                                                                            #
#      //Start comments here                                                                 #
#                                                                                            #
##############################################################################################

##############################################################################################
#                                  <TABLE> TABLE BEGINING TAG                                  #
##############################################################################################
function table_beg(){
  echo "<table>\n";
}//end function



##############################################################################################
#                                  </TABLE> TABLE ENDING TAG                                  #
##############################################################################################
function table_end(){
  echo "</table>\n";
}//end function
##############################################################################################
#                                    COL TAG                                                 #
#                                                                                            #
#      //Used only inside a colgroup or table, and contains only attributes                  #
#                                                                                            #
##############################################################################################
function col($css="", $align="", $char="", $charoff="", $span="", $valign="", $width=""){
  echo "  <col ", idclass($css), " $align $char $charoff $span $valign $width></col>\n";//spaces indent tags inside of html
}//end function
##############################################################################################
#                            COLGROUP Beginning Tag                                          #
#                                                                                            #
#      //This element is only valid inside the <table> tag.                                  #
##############################################################################################
function colgroup_beg($css="", $align="", $char="", $charoff="", $span="", $valign="", $width=""){
  echo "  <colgroup ", idclass($css), " $align $char $charoff $span $valign $width>";
}//end function
##############################################################################################
#                                COLGROUP Ending Tag                                         #
##############################################################################################
function colgroup_end(){
  echo "  </colgroup>\n";
}//end function



##############################################################################################
#                                  Sample Header                                             #
#                                                                                            #
#      //Start comments here                                                                 #
#                                                                                            #
##############################################################################################


//echo "If you can read this, there are no parse errors.";


//*********************************************************************************************
//##############################################################################################*
//#         END HTML FUNCTIONS PACKAGE                                                         #*
//##############################################################################################*
//*********************************************************************************************
?>