<?php require_once('../scripts/dbConnection.php'); ?>
<?php require_once('../scripts/authnlogout.php'); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);

if ($_GET["c"] != "") {
  $query_RSGallery = "SELECT * FROM tbl_gallery WHERE img_cat = ".$_GET["c"]." ORDER BY tbl_id DESC";
} else { 
  $query_RSGallery = "SELECT * FROM tbl_gallery WHERE img_cat = 0 ORDER BY tbl_id DESC";
}
$RSGallery = mysql_query($query_RSGallery, $Wisdom_Mcr) or die(mysql_error());
$row_RSGallery = mysql_fetch_assoc($RSGallery);
$totalRows_RSGallery = mysql_num_rows($RSGallery);
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
    <h1>Gallery Editor</h1>
    <p class="aligncenter">Below is a list of all the images in the gallery. Click "Edit" to change the image or image details. Click "Delete" to remove the image.</p>
    <br>
    <div class="gallerylinks">
      <a href="?c=0">Extensions</a>
      <a href="?c=1">Lofts / Conversions</a>
      <a href="?c=2">Kitchens</a>
      <a href="?c=3">Bathrooms</a>
      <a href="?c=4">Wardrobes</a>
      <a href="?c=5">Garden</a>
      <a href="?c=6">Installations</a>
      <br>
      <a href="?c=7">Storage</a>
      <a href="?c=8">Bespoke</a>
      <a href="?c=9">Something Different</a>
      <a href="?c=10">Work In Progress</a>
    </div>
    <p><a href="addimage.php">Add New Image To Gallery</a></p>
    <br>
    <?php if ($totalRows_RSGallery > 0) { ?>
		<?php do { ?>
      <div class="iBlock aligncenter">
        <img src="/images/gallery/t/<?php echo $row_RSGallery['img_fname']; ?>" class="galborder">
        <br>
        <a href="editimage.php?tbl_id=<?php echo $row_RSGallery['tbl_id']; ?>">Edit</a>&nbsp;|&nbsp;<a href="deleteimage.php?tbl_id=<?php echo $row_RSGallery['tbl_id']; ?>" onClick="return delImg();">Delete</a>
      </div>
    <?php } while ($row_RSGallery = mysql_fetch_assoc($RSGallery)); ?>
      <br class="clearfix">
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
mysql_free_result($RSGallery);
?>