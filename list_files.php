<?php

$CurDir = dirname($_SERVER["SCRIPT_FILENAME"]);
$CurDir .= "/scripts";
echo "$CurDir <br />";
$hDir = opendir($CurDir );
while ($aDir = readdir($hDir))
{
if (!is_dir($aDir))
{
echo '<a href= scripts/'.$aDir.'>'.$aDir.'</a><br>';
}
}
 
?>