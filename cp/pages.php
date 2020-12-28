<?php require_once('../scripts/authnlogout.php'); ?>
<?php require_once('../scripts/update.php'); ?>
<?php
if($_POST["page_title"] != "") {
	upd8("UPDATE tbl_pages SET page_title = '".$_POST["page_title"]."', page_keys = '".$_POST["page_keys"]."', page_desc = '".$_POST["page_desc"]."', page_content = '".$_POST["page_content"]."' WHERE tbl_id = ".$_POST["tbl_id"]);
	header("Location: /cp/pages.php?s=1&p=".$_POST["tbl_id"]);
}

$con = mysql_connect("db459691498.db.1and1.com","dbo459691498","w1sd0mmcr");
if (!$con) {die('Could not connect: ' . mysql_error());}
mysql_select_db("db459691498", $con);

if ($_GET["p"] != "") {
  $RS = mysql_query("SELECT * FROM tbl_pages WHERE tbl_id = ".$_GET["p"]);
} else {
  $RS = mysql_query("SELECT * FROM tbl_pages WHERE tbl_id = 1");
}
$row_RS = mysql_fetch_assoc($RS);
$totalRows_RS = mysql_num_rows($RS);
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
<script type="text/javascript" src="../scripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "imagemanager,filemanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,code",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,help,|,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "visualchars,nonbreaking,template,pagebreak,restoredraft,image",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
	});
	
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
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
    <h1>Page Info and Content Editor</h1>
    <div class="aligncenter"><strong>Select Page To Edit:</strong><br>
      <form name="form" id="form" class="pageselector">
        <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
          <option value="pages.php?p=1" <?php if ($_GET["p"] == 1) { echo "selected"; } ?>>Home Page</option>
          <option value="pages.php?p=2" <?php if ($_GET["p"] == 2) { echo "selected"; } ?>>About Page</option>
          <option value="pages.php?p=3" <?php if ($_GET["p"] == 3) { echo "selected"; } ?>>Services Page</option>
          <option value="pages.php?p=4" <?php if ($_GET["p"] == 4) { echo "selected"; } ?>>Gallery Page</option>
          <option value="pages.php?p=5" <?php if ($_GET["p"] == 5) { echo "selected"; } ?>>Contact Page</option>
          <option value="pages.php?p=7" <?php if ($_GET["p"] == 7) { echo "selected"; } ?>>Testimonials Page</option>
          <option value="pages.php?p=8" <?php if ($_GET["p"] == 8) { echo "selected"; } ?>>Links Page</option>
        </select>
      </form>
      <br>
      <p>Edit the page details as required, then click "Update" to save changes. To change the header, click the existing image.</p>    
    </div>
    <?php if ($_GET["s"] == "1") { echo "<br><p class='msg aligncenter'>Page Info/Content Updated!</p><br>"; } ?>
    <div class="cppagesform cppagesformstyle">
      <form id="form1" name="form1" method="post" action="" onSubmit="return pageform();">
      <label>Title<span class="small">Page title.</span></label>
      <input name="page_title" type="text" id="page_title" value="<?php echo $row_RS["page_title"]; ?>">
      
      <label>Keywords<span class="small">Page meta keywords.</span></label>
      <input name="page_keys" type="text" id="page_keys" value="<?php echo $row_RS["page_keys"]; ?>">
      
      <label>Description<span class="small">Page meta description.</span></label>
      <input name="page_desc" type="text" id="page_desc" value="<?php echo $row_RS["page_desc"]; ?>">
      <br class="clearfix">
      
      <textarea name="page_content" rows="20" id="page_content"><?php echo $row_RS["page_content"]; ?></textarea>
      <br class="clearfix">

      <input name="tbl_id" type="hidden" value="<?php echo $row_RS["tbl_id"]; ?>">
      
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
