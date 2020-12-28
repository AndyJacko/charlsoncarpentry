<?php require_once("../scripts/dbConnection.php"); ?>
<?php require_once('../scripts/authnlogout.php'); ?>
<?php require_once('../scripts/update.php'); ?>
<?php
if ($_POST["test_desc"] != "") {
	upd8("UPDATE tbl_testimonials SET test_desc = '".$_POST["test_desc"]."',test_who = '".$_POST["test_who"]."',test_date = '".$_POST["test_date"]."' WHERE tbl_id=".$_POST["tbl_id"]);
  header("Location: /cp/testimonials.php?s=2");
}

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSTestimonials = "SELECT * FROM tbl_testimonials WHERE tbl_id=".$_GET["tbl_id"];
$RSTestimonials = mysql_query($query_RSTestimonials, $Wisdom_Mcr) or die(mysql_error());
$row_RSTestimonials = mysql_fetch_assoc($RSTestimonials);
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
    <h1>Edit Testimonial</h1>
    <p class="aligncenter">Edit the details as required. Click "Update" to save the changes.</p>
    <br><br>
    <div class="cpform cpformstyle">
      <form id="form1" name="form1" method="post" action="" onSubmit="return testimonialform();">
      <label>Name and Area<span class="small">Name and area of guest.</span></label>
      <input name="test_who" type="text" id="test_who" value="<?php echo $row_RSTestimonials["test_who"]; ?>">
      <p class="aligncenter msg2"><b>IMPORTANT!&nbsp;&nbsp;&nbsp;Enter date in YYYY-MM-DD format.</b></p>
      <br>
      <label>Date<span class="small">Date guest stayed?</span></label>
      <input name="test_date" type="text" id="test_date" value="<?php echo $row_RSTestimonials["test_date"]; ?>" placeholder="YYYY-MM-DD">
      
      <label>Testimonial<span class="small">Guests testimonial comments.</span></label>
      <textarea name="test_desc" cols="38" rows="5" id="test_desc"><?php echo $row_RSTestimonials["test_desc"]; ?></textarea>
      
      <input name="tbl_id" type="hidden" value="<?php echo $row_RSTestimonials["tbl_id"]; ?>">
      
      <button type="submit">UPDATE</button>
      <div class="spacer"></div>
      </form>
    </div>
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
