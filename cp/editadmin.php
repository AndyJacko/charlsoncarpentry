<?php require_once("../scripts/dbConnection.php"); ?>
<?php require_once('../scripts/authnlogout.php'); ?>
<?php require_once('../scripts/update.php'); ?>
<?php
if ($_POST["name_admin"] != "") {
	upd8("UPDATE tbl_admin SET name_admin = '".$_POST["name_admin"]."',password_admin = '".$_POST["password_admin"]."' WHERE id_admin=1");
  header("Location: /cp/editadmin.php?s=1");
}

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSAdmin = "SELECT * FROM tbl_admin WHERE id_admin=1";
$RSAdmin = mysql_query($query_RSAdmin, $Wisdom_Mcr) or die(mysql_error());
$row_RSAdmin = mysql_fetch_assoc($RSAdmin);
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
    <h1>Edit Admin</h1>
    <p class="aligncenter">Edit the details as required. Click "Update" to save the changes.</p>
    <?php if ($_GET["s"] == "1") { echo "<br><p class='msg aligncenter'>Admin Details Edited!</p>"; } ?>
    <br>
    <div class="cpform cpformstyle">
      <form id="form1" name="form1" method="post" action="">
      <label>Username<span class="small">Admin username.</span></label>
      <input name="name_admin" type="text" id="name_admin" value="<?php echo $row_RSAdmin["name_admin"]; ?>">
      
      <label>Password<span class="small">Admin password.</span></label>
      <input name="password_admin" type="text" id="password_admin" value="<?php echo $row_RSAdmin["password_admin"]; ?>">
      
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
