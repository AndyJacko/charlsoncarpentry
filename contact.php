<?php require_once("scripts/dbConnection.php"); ?>
<?php require_once("scripts/emailer/emailfunctions.php"); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);

$query_RSPageInfo = "SELECT * FROM tbl_pages WHERE tbl_id=5";
$RSPageInfo = mysql_query($query_RSPageInfo, $Wisdom_Mcr) or die(mysql_error());
$row_RSPageInfo = mysql_fetch_assoc($RSPageInfo);
$totalRows_RSPageInfo = mysql_num_rows($RSPageInfo);
?>
<?php 
$cap = 1;
if (isset($_POST["YourName"])){
  require_once('scripts/recaptchalib.php');
  $privatekey = "";
  $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
  
  if (!$resp->is_valid) {
	  $cap = 0;
  } else {
		$YourName = $_POST["YourName"];
		$YourEmail = $_POST["YourEmail"];
		$to = "contactform@charlesoncarpentry.com";
		$YourComment = $_POST["YourComment"];
		$subject = "Contact/Testimonial form submission";
		$mailbody = getHeader();	
		$mailbody .= "
			<table width='540' border='0' cellspacing='0' cellpadding='0' align='center'>
				<tr>
					<td width='82' valign='top' style='font-family: Arial; font-size: 12px;'><strong>Name</strong></td>
					<td width='458' valign='top' style='font-family: Arial; font-size: 12px;'>".$YourName."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #000000;'></td></tr>
				<tr>
					<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Email</strong></td>
					<td valign='top' style='font-family: Arial; font-size: 12px;'>".$YourEmail."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #000000;'></td></tr>
				<tr>
					<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Message</strong></td>
					<td valign='top' style='font-family: Arial; font-size: 12px;'>".nl2br($YourComment)."</td>
				</tr>
			</table>
			";
		$mailbody .= getFooter();	
		$headers = "MIME-Version: 1.0 \n";
		$headers .= "Content-type:text/html;charset=utf-8 \n";
		$headers .= "From: contactform@charlesoncarpentry.com \n";
		
		mail($to,$subject,$mailbody,$headers);
		
		header("Location: /contact.php?s=1"); 
  }
}
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
<script src="scripts/js/charlesoncarpentry.js"></script>
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
          <br>
          <?php if ($_GET["s"] == "1") { echo "<h2 class='msg aligncenter'>Your Email Was Sent OK!</h2><br>"; } ?>
          <?php if ($cap == 0) { echo("<h2 class='msg2 aligncenter'>reCaptcha was wrong, please retry...</h2><br>"); } ?>
          <div class="myform formstyle">
          <script type="text/javascript"> var RecaptchaOptions = { theme : 'blackglass' }; </script>
          <form id="form1" name="form1" method="post" action="contact.php" onSubmit="return contactform();">
          <label>Your Name<span class="small">Please enter your name.</span></label>
          <input name="YourName" type="text" id="YourName" value="<?php echo $_POST["YourName"]; ?>">
          
          <label>Email Address<span class="small">Where can we contact you?</span></label>
          <input name="YourEmail" type="text" id="YourEmail" value="<?php echo $_POST["YourEmail"]; ?>">
          
          <label>Your Message<span class="small">Please enter your message.</span></label>
          <textarea name="YourComment" cols="38" rows="5" id="YourComment"><?php echo $_POST["YourComment"]; ?></textarea>
          
          <label>reCaptcha<span class="small">Enter the words you see.</span></label>
          <div class="captcha">
          <?php
            require_once('scripts/recaptchalib.php');
            $publickey = "";
            echo recaptcha_get_html($publickey);
          ?>
          </div>
          <button type="submit">SEND COMMENT</button>
          <div class="spacer"></div>
          </form>
        </div>
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
?>