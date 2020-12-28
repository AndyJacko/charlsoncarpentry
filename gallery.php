<?php require_once("scripts/dbConnection.php"); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);

$query_RSPageInfo = "SELECT * FROM tbl_pages WHERE tbl_id=4";
$RSPageInfo = mysql_query($query_RSPageInfo, $Wisdom_Mcr) or die(mysql_error());
$row_RSPageInfo = mysql_fetch_assoc($RSPageInfo);
$totalRows_RSPageInfo = mysql_num_rows($RSPageInfo);

if ($_GET["c"] != "") {
  $query_RSGallery = "SELECT * FROM tbl_gallery WHERE img_cat = ".$_GET["c"]." ORDER BY tbl_id DESC";
} else { 
  $query_RSGallery = "SELECT * FROM tbl_gallery WHERE img_cat = 9 ORDER BY tbl_id DESC";
}
$RSGallery = mysql_query($query_RSGallery, $Wisdom_Mcr) or die(mysql_error());
$row_RSGallery = mysql_fetch_assoc($RSGallery);
$totalRows_RSGallery = mysql_num_rows($RSGallery);
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<link href="scripts/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
<script src="scripts/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
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
					<?php
          switch ($_GET["c"]) {
            case 0:
              echo "<h1>Extensions</h1>";
              break;
            case 1:
              echo "<h1>Lofts &amp; Conversions</h1>";
              break;
            case 2:
              echo "<h1>Kitchens</h1>";
              break;
            case 3:
              echo "<h1>Bathrooms</h1>";
              break;
            case 4:
              echo "<h1>Wardrobes</h1>";
              break;
            case 5:
              echo "<h1>Gardens</h1>";
              break;
            case 6:
              echo "<h1>Installations</h1>";
              break;
            case 7:
              echo "<h1>Storage</h1>";
              break;
            case 8:
              echo "<h1>Bespoke</h1>";
              break;
            case 9:
              echo "<h1>Something Different</h1>";
              break;
            case 10:
              echo "<h1>Work In Progress</h1>";
              break;
          }
          ?>
          <?php echo $row_RSPageInfo["page_content"]; ?>
          <br>
          <div class="gallerylinks">
            <a href="?c=0">Extensions</a>
            <a href="?c=1">Lofts &amp; Conversions</a>
            <a href="?c=2">Kitchens</a>
            <a href="?c=3">Bathrooms</a>
            <a href="?c=4">Wardrobes</a>
            <a href="?c=5">Garden</a>
            <a href="?c=6">Installations</a>
            <a href="?c=7">Storage</a>
            <a href="?c=8">Bespoke</a>
            <a href="?c=9">Something Different</a>
            <a href="?c=10">Work In Progress</a>
          </div>
          <br>
          <?php if ($totalRows_RSGallery > 0) { ?>
            <?php do { ?>
              <a data-rel="prettyPhoto[gallery]" href="/images/gallery/m/<?php echo $row_RSGallery["img_fname"]; ?>" title="<?php echo $row_RSGallery["img_caption"]; ?>"><img class="galborder" src="/images/gallery/t/<?php echo $row_RSGallery["img_fname"]; ?>" alt="<?php echo $row_RSGallery["img_title"]; ?>"></a> 
            <?php } while ($row_RSGallery = mysql_fetch_assoc($RSGallery)); ?>
            <br class="clearfix">
          <?php } else { echo "<p class='aligncenter msg'>Sorry, no images added yet...</p>"; } ?>
          <script type="text/javascript">
            $(document).ready(function(){ $("a[rel^='prettyPhoto']").prettyPhoto({ animation_speed: ',normal', slideshow: 5000, autoplay_slideshow: false, opacity: 0.8, show_title: true, allow_resize: true, default_width: 500, default_height: 344, counter_separator_label: '/', theme: 'facebook', horizontal_padding: 20, hideflash: false, wmode: 'opaque', autoplay: true, modal: false, deeplinking: false, overlay_gallery: false, keyboard_shortcuts: true, changepicturecallback: function(){}, callback: function(){}, ie6_fallback: true }); });
            $('a[data-rel]').each(function() { $(this).attr('rel', $(this).data('rel')); });
          </script>
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
mysql_free_result($RSGallery);
?>