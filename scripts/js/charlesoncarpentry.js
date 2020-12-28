function contactform() {
	err = "";
	if (document.getElementById("YourName").value == "") {
		err = "You need to enter your name.\n";
	}
	if (document.getElementById("YourEmail").value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById("YourEmail").value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById("YourComment").value == "") {
		err = err + "You need to enter a message.\n";
	}
	if (document.getElementById("recaptcha_response_field").value == "") {
		err = err + "reCaptcha is required\r\n"
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function subform() {
	err = "";
	if (document.getElementById("YourName").value == "") {
		err = "You need to enter your name.\n";
	}
	if (document.getElementById("YourEmail").value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById("YourEmail").value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function testimonialform() {
	err = "";
	if (document.getElementById("test_who").value == "") {
		err = err + "You need to enter guests name.\n";
	}
	if (document.getElementById("test_date").value == "") {
		err = err + "You need to enter a date.\n";
	}
	if (document.getElementById("test_desc").value == "") {
		err = err + "Please enter the testimonial.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function pageform() {
	err = "";
	if (document.getElementById("page_title").value == "") {
		err = err + "You need to enter a page title.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function delTestimonial() {
  var r=confirm("Delete this testimonial?");
  if (r==true) {
	  return true;
  } else {
	  return false;
  }
}

function delImg() {
  var r=confirm("Delete this image?");
  if (r==true) {
	return true;
  } else {
	return false;
  }
}





