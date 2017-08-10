<?php
include 'functions.php';
$test[] = "item one";
$test[] = "item two";
$test[] = "item three";
$test[] = "item four";

html_header("xstrict","this should be a xhtml strict document");
body_beg();
heading_beg("1");
echo "this should be in the body";
heading_end("1");
br(2);
div_beg(idDIVTEST);
span_beg(idSPANTEST);
ul_beg(idtest_list);
li_array($test);
ul_end();
span_end();
div_end();
br(2);
anchor("http://webdev.peoriachristian.org/bf/", "bf index", "idhomelink");
br();
abbr("United Nations", "UN");
br();
acron("World Wide Web", "WWW");

address("Peoria Christian School", "3506 N. California Ave.", "Peoria", "IL", "61603");//self breaks at beg and end

b_beg();
bdo("rtl","Changing Text Direction");
b_end();
br();

form_beg();
frm_input("typsubmit", "namSubmit", "valSubmit");
frm_input_end();
form_end();
frm_textarea();
frm_textarea_end();
fieldset_beg();
font_beg("red");
dl_beg();
dt("Foo Dog");
dd("It's a Chinese Temple Guard, what were you thinking?");
dl_end();
br();
font_end();
fieldset_end();

body_end();
html_end();
?>