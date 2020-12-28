<?php
function upd8($upd8sql) {
  $con = mysql_connect($dbHost,$dbUser,$dbPass);
  if (!$con) {die('Could not connect: ' . mysql_error());}
  mysql_select_db($dbLoc, $con);
  $Result1 = mysql_query($upd8sql);
}		
?>