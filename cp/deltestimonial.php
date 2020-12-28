<?php require_once('../scripts/authnlogout.php'); ?>
<?php require_once('../scripts/delete.php'); ?>
<?php 
delete("DELETE FROM tbl_testimonials WHERE tbl_id='".$_GET["tbl_id"]."'");
header("Location: /cp/testimonials.php?s=3");
?>