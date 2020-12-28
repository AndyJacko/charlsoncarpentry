<?php require_once('../scripts/dbConnection.php'); ?>
<?php require_once('../scripts/authnlogout.php'); ?>
<?php
$upload_dir = "../images/temp/";
$upload_path = $upload_dir."/";	
$large_image_name = "resized_pic.jpg";
$thumb_image_name = "thumbnail_pic.jpg";
$max_file = "5242880";
$max_width = "600";
$thumb_width = "125";
$thumb_height = "125";

function resizeImage($image,$width,$height,$scale) {
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$image,90);
  chmod($image, 0777);
  return $image;
}

function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$thumb_image_name,90);
  chmod($thumb_image_name, 0777);
  return $thumb_image_name;
}

function getHeight($image) {
  $sizes = getimagesize($image);
  $height = $sizes[1];
  return $height;
}

function getWidth($image) {
  $sizes = getimagesize($image);
  $width = $sizes[0];
  return $width;
}

$large_image_location = $upload_path.$large_image_name;
$thumb_image_location = $upload_path.$thumb_image_name;

if(!is_dir($upload_dir)){
  mkdir($upload_dir, 0777);
  chmod($upload_dir, 0777);
}

if (file_exists($large_image_location)){
  if(file_exists($thumb_image_location)){
	$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name."\" alt=\"Thumbnail Image\"/>";
  }else{
	$thumb_photo_exists = "";
  }
  $large_photo_exists = "<img src=\"".$upload_path.$large_image_name."\" alt=\"Large Image\"/>";
} else {
  $large_photo_exists = "";
  $thumb_photo_exists = "";
}

if (isset($_POST["upload"])) { 
  $userfile_name = $_FILES['image']['name'];
  $userfile_tmp = $_FILES['image']['tmp_name'];
  $userfile_size = $_FILES['image']['size'];
  $filename = basename($_FILES['image']['name']);
  $file_ext = substr($filename, strrpos($filename, '.') + 1);
  if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		if (($file_ext!="jpg") && ($userfile_size > $max_file)) {
			$error= "ONLY jpeg images under 1MB are accepted for upload";
		}
  }else{
	$error= "Select a jpeg image for upload";
  }
  if (strlen($error)==0){
	if (isset($_FILES['image']['name'])){
	  move_uploaded_file($userfile_tmp, $large_image_location);
	  chmod($large_image_location, 0777);
	  
	  $width = getWidth($large_image_location);
	  $height = getHeight($large_image_location);
	  if ($width > $max_width){
		$scale = $max_width/$width;
		$uploaded = resizeImage($large_image_location,$width,$height,$scale);
	  }else{
		$scale = 1;
		$uploaded = resizeImage($large_image_location,$width,$height,$scale);
	  }
	  if (file_exists($thumb_image_location)) {
		unlink($thumb_image_location);
	  }
	}
	$_SESSION["img_title"] = $_POST["img_title"];
	$_SESSION["img_caption"] = $_POST["img_caption"];
	$_SESSION["img_cat"] = $_POST["img_cat"];
	$_SESSION["popo"] = 2;
	header("location:".$_SERVER["PHP_SELF"]);
	exit();
  }
}

if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
  $x1 = $_POST["x1"];
  $y1 = $_POST["y1"];
  $x2 = $_POST["x2"];
  $y2 = $_POST["y2"];
  $w = $_POST["w"];
  $h = $_POST["h"];
  $scale = $thumb_width/$w;
  $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
	header("location:".$_SERVER["PHP_SELF"]);
  exit();
}

if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
  $usrCode = mt_rand() ."". mt_rand();
  $file = '../images/temp/resized_pic.jpg';
  $newfile = '../images/gallery/m/'.$usrCode.'.jpg';
  
  if (!copy($file, $newfile)) {
	echo "failed to copy $file...\n";
  }
  $file = '../images/temp/thumbnail_pic.jpg';
  $newfile = '../images/gallery/t/'.$usrCode.'.jpg';
  
  if (!copy($file, $newfile)) {
	echo "failed to copy $file...\n";
  }
  unlink("../images/temp/resized_pic.jpg");
  unlink("../images/temp/thumbnail_pic.jpg");
  
  $insertSQL = sprintf("INSERT INTO tbl_gallery (img_cat,img_fname,img_title,img_caption) VALUES (".$_SESSION["img_cat"].",'".$usrCode.".jpg','".$_SESSION["img_title"]."','".$_SESSION["img_caption"]."')");

  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($insertSQL, $Wisdom_Mcr) or die(mysql_error());
	
	$stamp = imagecreatefrompng('../images/watermark.png');
	$im = imagecreatefromjpeg('../images/gallery/m/'.$usrCode.'.jpg');
	
	$marge_right = 3;
	$marge_bottom = 6;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);
	
	imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
  imagejpeg($im,'../images/gallery/m/'.$usrCode.'.jpg',90);
	unset($_SESSION['popo']);
  header("location: gallery.php?c=".$_SESSION["img_cat"]);
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/cp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Move Along People, Nothing To See Here</title>
<!-- InstanceEndEditable -->
<link href="../scripts/css/charlesoncarpentry.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../scripts/js/jquery-pack.js"></script>
<script type="text/javascript" src="../scripts/js/jquery.imgareaselect-0.3.min.js"></script>
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
  <div id="bodycontent">
		<?php
    if(strlen($large_photo_exists)>0){
    $current_large_image_width = getWidth($large_image_location);
    $current_large_image_height = getHeight($large_image_location);?>
    <script type="text/javascript">
    function preview(img, selection) { 
    var scaleX = <?php echo $thumb_width;?> / selection.width; 
    var scaleY = <?php echo $thumb_height;?> / selection.height; 
    $('#thumbnail + div > img').css({ 
      width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
      height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
      marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
      marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
    });
    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);
    } 
    $(document).ready(function () { 
      $('#save_thumb').click(function() {
      var x1 = $('#x1').val();
      var y1 = $('#y1').val();
      var x2 = $('#x2').val();
      var y2 = $('#y2').val();
      var w = $('#w').val();
      var h = $('#h').val();
      if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
        alert("You must make a selection first");
        return false;
      }else{
        return true;
      }
      });
    }); 
    $(window).load(function () { 
      $('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview }); 
    });
    </script>
    <?php }?>
    <h1>Add New Picture To Gallery</h1>
    <?php
    if (strlen($error) > 0) {
      echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";
    }
    if(strlen($large_photo_exists) > 0 && strlen($thumb_photo_exists) > 0) {
      echo "";
    } else {
    if (strlen($large_photo_exists )> 0) { ?>
    <h2>Create Thumbnail</h2>
    <br><br>
    <div align="center">
      <img src="<?php echo $upload_path.$large_image_name;?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail">
      <div style="float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
      <img src="<?php echo $upload_path.$large_image_name;?>" style="position: relative;" alt="Thumbnail Preview">
      </div>
      <br style="clear:both;"/>
      <form name="thumbnail" action="" method="post">
      <input type="hidden" name="x1" value="" id="x1">
      <input type="hidden" name="y1" value="" id="y1">
      <input type="hidden" name="x2" value="" id="x2">
      <input type="hidden" name="y2" value="" id="y2">
      <input type="hidden" name="w" value="" id="w">
      <input type="hidden" name="h" value="" id="h">
      <input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb">
      </form>
    </div>
    <hr />
    <?php } ?>
    <?php if (!isset($_SESSION["popo"])) { ?>
    <br><br>
    <h2>Upload Photo</h2>
    <br><br>
    <div class="cpform cpformstyle">
    <form name="photo" enctype="multipart/form-data" action="" method="post">
      <label>Photo<span class="small">The photo to upload.</span></label>
      <input type="file" name="image" id="image">
      <label>Gallery<span class="small">Which gallery to add to.</span></label>
      <select name="img_cat" id="img_cat">
        <option value="0">Extensions</option>
        <option value="1">Lofts/Conversions</option>
        <option value="2">Kitchens</option>
        <option value="3">Bathrooms</option>
        <option value="4">Wardrobes</option>
        <option value="5">Garden</option>
        <option value="6">Installations</option>
        <option value="7">Storage</option>
        <option value="8">Bespoke</option>
        <option value="9">Something Different</option>
        <option value="10">Work In Progress</option>
      </select>
      <label>Title<span class="small">Title of the photo.</span></label>
      <input name="img_title" type="text" id="img_title" size="50" onChange="checkuploadgalleryitems();" class="itemnorm" value="<?php echo $_POST["YourEmail"]; ?>">
      <label>Caption<span class="small">A brief info of photo.</span></label>
      <textarea name="img_caption" cols="38" rows="5" id="img_caption" onChange="checkuploadgalleryitems();" class="itemnorm"><?php echo $_POST["YourComment"]; ?></textarea>
      <button type="submit" name="upload">UPLOAD</button>
    </form>
    </div>
		<?php } ?>
		<?php } ?>
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
