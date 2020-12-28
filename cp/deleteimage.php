<?php require_once('../scripts/dbConnection.php'); ?>
<?php require_once('../scripts/authnlogout.php'); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RS = "SELECT * FROM tbl_gallery WHERE tbl_id=".$_GET["tbl_id"];
$RS = mysql_query($query_RS, $Wisdom_Mcr) or die(mysql_error());
$row_RS = mysql_fetch_assoc($RS);
$totalRows_RS = mysql_num_rows($RS);

unlink("../images/gallery/m/".$row_RS["img_fname"]."");
unlink("../images/gallery/t/".$row_RS["img_fname"]."");

mysql_free_result($RS);

$delSQL = sprintf("DELETE FROM tbl_gallery WHERE tbl_id=".$_GET["tbl_id"]);
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($delSQL, $Wisdom_Mcr) or die(mysql_error());

header("location: gallery.php");
?>