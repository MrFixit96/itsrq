<?php

  $happyfuntime = "happy;fun`time & more happyness; this ` is `` happyfuntime;";
  
  echo $happyfuntime;

  $regexpression = "/;|&|\`/";
  
  echo "<br />";
  echo "<br />";

  preg_match($regexpression, $happyfuntime);

  echo "<br />";
  echo "<br />";

  echo $happyfuntime;

  echo "<br />";
  echo "<br />";

  echo "end happy fun time yes";
  
  ?>