<?php require_once('../scripts/dbConnection.php'); ?>
<?php require_once('../scripts/getvalstring.php'); ?>
<?php session_start(); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "/cp/editadmin.php";
  $MM_redirectLoginFailed = "/cp/index.php?s=1";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  
  $LoginRS__query=sprintf("SELECT name_admin, password_admin FROM tbl_admin WHERE name_admin=%s AND password_admin=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Wisdom_Mcr) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" type="text/css" href="../scripts/css/cplogin.css">
<title>Move Along People, Nothing To See Here</title>
</head>

<body>
<div id="header"><a href="http://www.charlesoncarpentry.com"><img src="../images/logo.png" alt="Charleson Carpentry"></a></div>
<div id="content">
  <br><br><h1>Login To Controlpanel</h1><br><br>
  <?php
  if (isset($_GET['s'])){
	$popo = $_GET['s'];
	if ($popo == 1){
	  echo "<p>Sorry, the details you entered were incorrect.</p><br><br>";
	}else{
	  echo"";
	}
	if ($popo == 2){
	  echo "<p>To log back in, please re-enter your details.</p><br><br>";
	}else{
	  echo"";
	}
	if ($popo == 3){
	  echo "<p>Sorry, you are not authorised to view that page unless you login first.</p><br><br>";
	}else{
	  echo"";
	}
  }
  ?>      
  <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <input name="Username" type="text" id="Username" placeholder="Enter Username"><br><br>
  <input name="Password" type="password"  id="Password" placeholder="Enter Password"><br><br>
  <?php if ($_GET['s'] != "1"){ ?>
	<input type="submit" name="Submit" id="Submit" value="Login">
  <?php }else{ ?>
	<input type="submit" name="Submit" id="Submit" value="Retry">
  <?php } ?>
  </form>
  <br><br><br><br><p>--- Unauthorised Access Is Not Permitted ---</p>
</div>
</body>
</html>