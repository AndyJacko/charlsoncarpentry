<?php require_once("scripts/dbConnection.php"); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);

$query_RSPageInfo = "SELECT * FROM tbl_pages WHERE tbl_id=7";
$RSPageInfo = mysql_query($query_RSPageInfo, $Wisdom_Mcr) or die(mysql_error());
$row_RSPageInfo = mysql_fetch_assoc($RSPageInfo);
$totalRows_RSPageInfo = mysql_num_rows($RSPageInfo);
?>
<?php
$maxRows_RSTestimonials = 10;
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
<html><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_RSPageInfo["page_title"]; ?></title>
<meta name="description" content="<?php echo $row_RSPageInfo["page_desc"]; ?>">
<meta name="keywords" content="<?php echo $row_RSPageInfo["page_keys"]; ?>">
<meta name="Location" content="United Kingdom">
<!-- InstanceEndEditable -->
<link href="scripts/css/charlesoncarpentry.css" rel="stylesheet" type="text/css">
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
            <li><a href="http://www.charlesoncarpentry.com">Home</a></li>
            <li><a href="/aboutus.php">About Us</a></li>
            <li><a href="/services.php">Services</a></li>
            <li><a href="/gallery.php?c=9">Galleries</a></li>
            <li><a href="/contact.php">Contact</a></li>
            <li><a href="/testimonials.php">Testimonials</a></li>
            <li><a href="/links.php">Links</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section id="contentcontainer">
      <div id="contleft">
				<!-- InstanceBeginEditable name="body" -->
					<?php echo $row_RSPageInfo["page_content"]; ?>
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
          <p><strong><?php echo $result; ?> - <?php echo $row_RSTestimonials["test_who"]; ?></strong></p>
          <p><?php echo nl2br($row_RSTestimonials["test_desc"]); ?></p>
          </div>
          <?php	} while ($row_RSTestimonials = mysql_fetch_assoc($RSTestimonials)); ?>
          
          <?php if ($t > 9){ ?>          
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
          <?php if ($t > 9){ ?>          
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
			<div id="contright">
        <p class="twt aCentre">Twitter Feed</p>
				<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
				<script>
        new TWTR.Widget({
          version: 2,
          type: 'profile',
          rpp: 10,
          interval: 30000,
          width: 200,
          height: 320, 
          theme: {
            shell: {
              background: '#692a2c',
              color: '#FFFFFF'
            },
            tweets: {
              background: '#FFFFFF',
              color: '#000000',
              links: '#692a2c'
            }
          },
          features: {
            scrollbar: true,
            loop: true,
            live: true,
            behavior: 'all'
          }
        }).render().setUser('@johncharleson1').start();
        </script>
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
mysql_free_result($RSPageInfo);
mysql_free_result($RSTestimonials);
?>