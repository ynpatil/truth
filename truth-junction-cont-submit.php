<?php
	include("common/config.php");
	include("common/app_function.php");

if((strtolower($_REQUEST['captcha'])) == $_SESSION['getrvalue'])
{						
		$sname		= $_GET[sname];
		$cperson	= $_GET[name];
		$company	= $_GET[cname];
		$cell		= $_GET[femail];
		$fax		= $_GET[fname];
		$email		= $_GET[email];
		$subject	= $_GET[subject];
		$message	= $_GET[msg];

		$adminquery = "SELECT * from ".$tblpref."admin WHERE admin_id='1'";
		if(!($adminresult=mysql_query($adminquery))) { echo "ERROR :". mysql_error(); exit();}
		$adminrow=mysql_fetch_array($adminresult);

		$adminmail = stripslashes($adminrow[admin_email ]);

		$msg="<html><head></head>";
		$msg= $msg ."<body bgcolor='#ffffff' class='mailtext' >";
		$msg= $msg ."<div align='left'>";
		$msg= $msg ."<table border='0' width='100%' id='table1' cellspacing='0' cellpadding='0'>";
		$msg= $msg ."<tr><td><b>Hello".stripslashes($adminrow[username]).", <br><br></b></td></tr>";
		$msg= $msg ."<tr><td><p>Feedback has been sent to you by". stripslashes($sname). "</p><br /></td></tr>";
		$msg= $msg ."<tr><td><p>".stripslashes($message)."</p><br /></td></tr>";
		$msg= $msg ."<tr>";
		$msg= $msg ."<td bgcolor='#ffffff'><table border='0' width='100%' cellspacing='0' align='left'>";
		
		$msg= $msg ."</table></td></tr><tr><td align='left'><br><b>Thank You!</b></td></tr></table></div></body></html>";
		
		$fr= stripslashes($cperson);
		$mesheader =  "From: ".$fr."\n" . "Reply-To: ". $email . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		@mail($adminmail,$subject,$msg,$mesheader);
		echo "Thank you for you feedback. We will soon contact you";
}
else
	echo "Problem";
?>