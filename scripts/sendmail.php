<?php
$bdyTxt = "Message from website:<br /><br />";
if ($_POST["Name"] != "") {
  $bdyTxt .= "<b>Name:</b> ".$_POST["Name"]."<br />";
}
if ($_POST["Email"] != "") {
  $bdyTxt .= "<b>Email:</b> ".$_POST["Email"]."<br />";
}
if ($_POST["Message"] != "") {
  $bdyTxt .= "<b>Message:</b> ".nl2br($_POST["Message"]);
}

//$to = "info@generalbuilderandplasterer.co.uk";
$to = "";
$subject = "Contact Form Submission";
$message = $bdyTxt;
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\n";
$headers .= "From: info@generalbuilderandplasterer.co.uk\n";
mail($to,$subject,$message,$headers);

header(sprintf("Location: /thanks.html"));
?>