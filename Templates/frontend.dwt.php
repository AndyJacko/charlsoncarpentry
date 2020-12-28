<?php require_once("../scripts/dbConnection.php"); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);

$query_RSPageInfo = "SELECT * FROM tbl_pages WHERE tbl_id=2";
$RSPageInfo = mysql_query($query_RSPageInfo, $Wisdom_Mcr) or die(mysql_error());
$row_RSPageInfo = mysql_fetch_assoc($RSPageInfo);
$totalRows_RSPageInfo = mysql_num_rows($RSPageInfo);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title><?php echo $row_RSPageInfo["page_title"]; ?></title>
<meta name="description" content="<?php echo $row_RSPageInfo["page_desc"]; ?>">
<meta name="keywords" content="<?php echo $row_RSPageInfo["page_keys"]; ?>">
<meta name="Location" content="United Kingdom">
<!-- TemplateEndEditable -->
<link href="../scripts/css/charlesoncarpentry.css" rel="stylesheet" type="text/css">
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
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
				<!-- TemplateBeginEditable name="body" -->
          <?php echo $row_RSPageInfo["page_content"]; ?>
        <!-- TemplateEndEditable -->
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
</html>
<?php
mysql_free_result($RSPageInfo);
?>