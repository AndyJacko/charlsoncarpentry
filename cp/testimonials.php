<?php require_once("../scripts/dbConnection.php"); ?>
<?php require_once('../scripts/authnlogout.php'); ?>
<?php
$maxRows_RSTestimonials = 20;
$p = 0;
if (isset($_GET['p'])) {
	$p = $_GET['p'];
}
$startRow_RSTestimonials = $p * $maxRows_RSTestimonials;

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSTestimonials = "SELECT * FROM tbl_testimonials ORDER BY test_date DESC";
$query_limit_RSTestimonials = sprintf("%s LIMIT %d, %d", $query_RSTestimonials, $startRow_RSTestimonials, $maxRows_RSTestimonials);
$RSTestimonials = mysql_query($query_limit_RSTestimonials, $Wisdom_Mcr) or die(mysql_error());
$row_RSTestimonials = mysql_fetch_assoc($RSTestimonials);

if (isset($_GET['t'])) {
	$t = $_GET['t'];
} else {
	$all_RSTestimonials = mysql_query($query_RSTestimonials);
	$t = mysql_num_rows($all_RSTestimonials);
}
$totalPages_RSTestimonials = ceil($t/$maxRows_RSTestimonials)-1;

$queryString_RSTestimonials = "";
if (!empty($_SERVER['QUERY_STRING'])) {
$params = explode("&", $_SERVER['QUERY_STRING']);
$newParams = array();
foreach ($params as $param) {
	if (stristr($param, "p") == false && 
		stristr($param, "t") == false) {
	array_push($newParams, $param);
	}
}
if (count($newParams) != 0) {
	$queryString_RSTestimonials = "&" . htmlentities(implode("&", $newParams));
}
}
$queryString_RSTestimonials = sprintf("&t=%d%s", $t, $queryString_RSTestimonials);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/cp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title></title>
<!-- InstanceEndEditable -->
<link href="../scripts/css/charlesoncarpentry.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="maincontainer">
  <div id="designcontainer">
    <header>
      <div id="feeequote">Get A Quote Now</div>
      <div id="phonenum">07975 910 146</div>
      <div id="estimates">Free Estimates</div>
    </header>
    <nav>
      <div id="navbg">
        <div id="navlinks">
          <ul>
            <li><a href="/cp/editadmin.php">Admin</a></li><li><a href="/cp/pages.php">Pages</a></li><li><a href="/cp/testimonials.php">Testimonials</a></li><li><a href="/cp/gallery.php">Gallery</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section id="contentcontainer">
      <div id="contleftcp">
				<!-- InstanceBeginEditable name="body" -->
    <h1>Testimonials Editor</h1>
    <p class="aligncenter">Below is a list of testimonials, click "EDIT" to change the details or "Delete" to remove the testimonial.</p>
		<p class="aligncenter"><strong>NOTE: If there are more than 20 testimonials, use the navigation to move through the pages.</strong></p>
    <?php if ($_GET["s"] == "1") { echo "<br><p class='msg aligncenter'>Testimonial Added!</p><br>"; } ?>
    <?php if ($_GET["s"] == "2") { echo "<br><p class='msg aligncenter'>Testimonial Edited!</p><br>"; } ?>
    <?php if ($_GET["s"] == "3") { echo "<br><p class='msg aligncenter'>Testimonial Deleted!</p><br>"; } ?>
    <br>
    <p><a href="addtestimonial.php">ADD NEW TESTIMONIAL</a></p>
    <br>
		<?php if ($t > 19){ ?>          
			<?php if ($p > 0) { ?>
        <a href="<?php printf("%s?p=%d%s", $currentPage, 0, $queryString_RSTestimonials); ?>">First</a>&nbsp;&nbsp;&nbsp;
      <?php } else {?>
        First&nbsp;&nbsp;&nbsp;
      <?php } ?>
      <?php if ($p > 0) { ?>
        <a href="<?php printf("%s?p=%d%s", $currentPage, max(0, $p - 1), $queryString_RSTestimonials); ?>">Previous</a>&nbsp;&nbsp;&nbsp;
      <?php } else {?>
        Previous&nbsp;&nbsp;&nbsp;
      <?php } ?>
    <?php } ?>
    <?php if ($t > 19){ ?>          
      <?php if ($p < $totalPages_RSTestimonials) { ?>
        &nbsp;&nbsp;&nbsp;<a href="<?php printf("%s?p=%d%s", $currentPage, min($totalPages_RSTestimonials, $p + 1), $queryString_RSTestimonials); ?>">Next</a>
      <?php } else {?>
        &nbsp;&nbsp;&nbsp;Next
      <?php } ?>
      <?php if ($p < $totalPages_RSTestimonials) { ?>
        &nbsp;&nbsp;&nbsp;<a href="<?php printf("%s?p=%d%s", $currentPage, $totalPages_RSTestimonials, $queryString_RSTestimonials); ?>">Last</a>
      <?php } else {?>
        &nbsp;&nbsp;&nbsp;Last
      <?php } ?>
    <?php } ?>
    
		<?php	do { ?>
    <?php
			$testyear = substr($row_RSTestimonials["test_date"],0,4);
			$testmonth = substr($row_RSTestimonials["test_date"],5,2);
			switch ($testmonth)	{
			case "01":
				$testmonth = "January";
				break;
			case "02":
				$testmonth = "February";
				break;
			case "03":
				$testmonth = "March";
				break;
			case "04":
				$testmonth = "April";
				break;
			case "05":
				$testmonth = "May";
				break;
			case "06":
				$testmonth = "June";
				break;
			case "07":
				$testmonth = "July";
				break;
			case "08":
				$testmonth = "August";
				break;
			case "09":
				$testmonth = "September";
				break;
			case "10":
				$testmonth = "October";
				break;
			case "11":
				$testmonth = "November";
				break;
			case "12":
				$testmonth = "December";
				break;
			} 			
			$result = $testmonth." ".$testyear;
		?>
    <div class="testimoniacont">
    <p><a href="edittestimonial.php?tbl_id=<?php echo $row_RSTestimonials["tbl_id"]; ?>">EDIT</a>&nbsp;&nbsp;&nbsp;<a href="deltestimonial.php?tbl_id=<?php echo $row_RSTestimonials["tbl_id"]; ?>" onClick="return delTestimonial();">DELETE</a>&nbsp;&nbsp;&nbsp;<strong><?php echo $result; ?> - <?php echo $row_RSTestimonials["test_who"]; ?></strong></p>
    <p><?php echo nl2br($row_RSTestimonials["test_desc"]); ?></p>
    </div>
    <?php	} while ($row_RSTestimonials = mysql_fetch_assoc($RSTestimonials)); ?>
    
		<?php if ($t > 19){ ?>          
			<?php if ($p > 0) { ?>
        <a href="<?php printf("%s?p=%d%s", $currentPage, 0, $queryString_RSTestimonials); ?>">First</a>&nbsp;&nbsp;&nbsp;
      <?php } else {?>
        First&nbsp;&nbsp;&nbsp;
      <?php } ?>
      <?php if ($p > 0) { ?>
        <a href="<?php printf("%s?p=%d%s", $currentPage, max(0, $p - 1), $queryString_RSTestimonials); ?>">Previous</a>&nbsp;&nbsp;&nbsp;
      <?php } else {?>
        Previous&nbsp;&nbsp;&nbsp;
      <?php } ?>
    <?php } ?>
    <?php if ($t > 19){ ?>          
      <?php if ($p < $totalPages_RSTestimonials) { ?>
        &nbsp;&nbsp;&nbsp;<a href="<?php printf("%s?p=%d%s", $currentPage, min($totalPages_RSTestimonials, $p + 1), $queryString_RSTestimonials); ?>">Next</a>
      <?php } else {?>
        &nbsp;&nbsp;&nbsp;Next
      <?php } ?>
      <?php if ($p < $totalPages_RSTestimonials) { ?>
        &nbsp;&nbsp;&nbsp;<a href="<?php printf("%s?p=%d%s", $currentPage, $totalPages_RSTestimonials, $queryString_RSTestimonials); ?>">Last</a>
      <?php } else {?>
        &nbsp;&nbsp;&nbsp;Last
      <?php } ?>
    <?php } ?>
		<!-- InstanceEndEditable -->
      </div>
      <br class="clearfix">
    </section>
    <footer>
     <div id="mainfooter">
       <div id="footeraddy">
         Address: <span class="yellowText">9 Gaskell Road, Eccles, M30 0HP</span><br><br>
         Email: <span class="yellowText">info@charlesoncarpentry.com</span><br><br>
         Mobile: <span class="yellowText">07975 910 146</span>
       </div>
       <div id="social">
         <a href="https://www.facebook.com/john.charleson.54" target="_blank"><img src="/images/social/facebook.png" alt="Facebook"></a>
         <a href="https://plus.google.com/113426889510141443864" target="_blank"><img src="/images/social/google-plus.png" alt="Google +"></a>
         <a href="https://twitter.com/johncharleson1" target="_blank"><img src="/images/social/twitter.png" alt="Twitter"></a>
         <a href="http://www.linkedin.com/profile/view?id=238746049" target="_blank"><img src="/images/social/linkedin.png" alt="LinkedIN"></a>
       </div>
       <div id="footercopy">&copy; <?php echo gmdate("Y"); ?> charlesoncarpentry.com</div>
     </div>
     <div id="footerbg"></div>
    </footer>
    <br class="clearfix">
  </div>
</div> 
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RSTestimonials);
?>