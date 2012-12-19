<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	$content = addslashes($linkcontect);

if($person!="")
{
		$query_update="UPDATE ".$tblpref."expert set
		exp_comp_name ='$comp_name',
		exp_person_name ='$person',
		exp_tel ='$tel',
		exp_fax ='$fax',
		exp_web ='$website',
		exp_email ='$email',
		exp_pass ='$pass',
		exp_profile ='$content'
		WHERE exp_id='$_SESSION[exp_id]'";

		if(!($result=mysql_query($query_update))){echo $query_update.mysql_error(); exit;}
	
		if($_FILES["upload1"]["name"]!="")
		{
			$fileload = $_FILES["upload1"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="logo_exp".$id.".".$file_ext[1];
			$destpath="tempex/".$myattach;

			copy($_FILES["upload1"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."expert SET exp_comp_logo ='".$myattach."' WHERE exp_id =".$id;
			if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
		}

$query = "select * from ".$tblpref."admin where admin_id = 1";
if (!($result = mysql_query($query))) { echo 'Error : ' . $query.mysql_error(); }
$row = mysql_fetch_array($result);

$ouremail = $row[admin_email];

$sub="Truth Junction :: Profile Detail : " . $ouremail .  " From :" . $row[username];

$mess ="<html>
			<body >
			 Hello $comp_name, <BR><BR>

			<TABLE width='100%' cellspacing='0' cellpadding='0' border=0 >
			
			<TR>
				<TD align=left>expert Type : ".$exp_type. "</TD>
			</TR>
			<TR>
				<TD align=left>Company Name : ".$comp_name."</TD>
			</TR>
			<TR>
				<TD align=left>Contact Person : ".$person."</TD>
			</TR>
			<TR>
				<TD align=left> Tel : ".$tel."</TD>
			</TR>
			<TR>
				<TD aalign=left> Fax : ".$fax."</TD>
			</TR>
			<TR>
				<TD aalign=left> Website : ".$website."</TD>
			</TR>
			<TR>
				<TD aalign=left> Email : ".$email."</TD>
			</TR>
			<TR>
				<TD aalign=left> Profile : ".$content."</TD>
			</TR>
			<TR>
				<TD>Please use the following Login details to login to Truth Junction website</TD>
				
			</TR>

			<TR>
				<TD>User ID : ".$email."</TD>
			</TR>
			<TR>
				<TD>Password : ".$pass."<br><br></TD>
			</TR>

			<TR>
				<TD align=left>Best regards ,</TD>
			</TR>
			<TR>
				<TD align=left>Truth Junction Webmaster </TD>
			</TR>
				<TR>
				<TD align=left> Contact details of Truth Junction </TD>
			</TR>
			</TABLE>
			
			</body>
			</html>	";

			$mesheader =  "From: ".$row[username]."\n" . "Reply-To: ". $ouremail . "\r\n";
			$mesheader .= "MIME-Version: 1.0\n";
			$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	
		@mail($email,$sub,$mess,$mesheader);	

		header("Location:truth-junction-exp-profile.php?flag=edit");
		exit;
}


?>