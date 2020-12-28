<?php
function getHeader() {
	$theHeader = "
	<html>
	<body>
		<table width='552' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='border: 2px solid #000000;' align='center'>
			<tr>
				<td>
					<table width='552' border='0' cellspacing='0' cellpadding='0' align='center'>
						<tr bgcolor='#FFFFFF'>
							<td width='552' height='143' valign='top'><a href='http://www.charlesoncarpentry.com' target='_blank'><img src='http://www.charlesoncarpentry.com/images/logo.png' alt='Charleson Carpentry' width='167' height='161' border='0' vspace='2' hspace='2' style='display: block;'></a></td>
						</tr>
						<tr bgcolor='#093a6a'>
							<td align='center' valign='top' height='20' style='padding: 5px; color: #FFFFFF; font-family: Arial; border-top: 2px solid #000000; border-bottom: 2px solid #000000;'><strong>Contact Form/Testimonial Submission</strong></td>
						</tr>
						<tr>
							<td valign='top' style='padding: 5px; font-family: Arial;'>
	";			
	return $theHeader;
}

function getFooter() {
	$theFooter = "
							</td>
						</tr>
						<tr>
							<td height='20' align='center' valign='middle' bgcolor='#093a6a' style='border-top: 2px solid #000000;'><a href='http://www.charlesoncarpentry.com' target='_blank' style='color: #FFFFFF; font-size: 10px; font-family: Arial; text-decoration: none;'><strong>Charleson Carpentry</strong></a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<p align= 'center' style='font-size: 8px; font-family: Arial;'>&copy; ".gmdate("Y")." Charleson Carpentry</p>
	</body>
	</html>
	";			
	return $theFooter;
}
?>