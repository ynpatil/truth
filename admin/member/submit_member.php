<?php
session_start();
include("../../common/app_function.php");
include("../../common/config.php");

$content=addslashes($linkcontect);
$curdate=date("Y-m-d");
$txdate = dateformate($txtdate)." 00:00:00";
$txtendcontract = dateformate($txtendcontract)." 00:00:00";

if($status=="Deactivate")
{
	$query_update="UPDATE ".$tblpref."member_reg set mem_status = 'Active'	WHERE mem_id='$id'";
	if(!($result=mysql_query($query_update))){echo $query_update.mysql_error(); exit;}
	header("Location:index.php?flag=stat");
	exit;
}
if($status=="Active")
{
	$query_update="UPDATE ".$tblpref."member_reg set mem_status = 'Deactivate' , mem_deactdate='$curdate' WHERE mem_id='$id'";
	if(!($result=mysql_query($query_update))){echo $query_update.mysql_error(); exit;}
	header("Location:index.php?flag=stat");
	exit;
}

if($mode=="del")
{
	$query="Delete from ".$tblpref."member_reg where mem_id='$id'";
	if(!($result=mysql_query($query))){echo mysql_error($query); exit;}

	header("Location:index.php?flag=del");
	exit;
}

if($id=="")
{
	$qadd="INSERT INTO ".$tblpref."expert set 
	exp_service_area_id='$exp_type',
	exp_comp_name ='$comp_name',
	exp_person_name ='$person',
	exp_tel ='$tel',
	exp_fax ='$fax',
	exp_web ='$website',
	exp_contract_date = '$txdate',
	exp_endcont_date = '$txtendcontract',
	exp_email ='$email',
	exp_pass ='$pass',
	exp_profile ='$content',
	exp_status = '$radstatus'";
	if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
	$id = mysql_insert_id();

	if($_FILES["upload1"]["name"]!="") 
	{
			$fileload = $_FILES["upload1"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="logo_exp".$id.".".$file_ext[1];
			$destpath="../../tempex/".$myattach;

			copy($_FILES["upload1"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."expert SET exp_comp_logo ='".$myattach."' WHERE exp_id =".$id;
			if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
	}

			
	$query = "select * from ".$tblpref."admin where admin_id = 1";
	if (!($result = mysql_query($query))) { echo 'Error : ' . $query.mysql_error(); }
	$row = mysql_fetch_array($result);

	$ouremail = $row[admin_email];

	$sub="Truth Junction :: User Profile Detail : " . $ouremail .  " From :" . $row[username];

	$mess ="<html>
			<body>
			Hello $comp_name, <BR><BR>

			<TABLE width='100%' cellspacing='0' cellpadding='0' border=0 >
			
			<TR>
				<TD align=left>Expert Service Area : ".$exp_type. "</TD>
			</TR>
			<TR>
				<TD align=left>Expert Name : ".$comp_name."</TD>
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
				<TD>Password : ".$pass."</TD>
			</TR>

			<TR>
				<TD align=left>Best Regards ,</TD>
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

		header("Location:index.php?flag=edit");
		exit;
}

if($id!="" && $mode!="mail")
{
		$queryreg = "UPDATE ".$tblpref."member_reg SET
		mem_title      = '$ddtitle',
		mem_first_name = '$txtfname',
		mem_sur_name   = '$txtsname',
		mem_gender     = '$radgender',
		mem_dob       = '$txtdob',
		mem_address    = '$txtpaddress',
		mem_phone      = '$txtphone',
		mem_cel        = '$txtcel',
		mem_email      = '$email',
		mem_password   = '$password',
		mem_rpassword  = '$rpassword',
		mem_squest     = '$squest',
		mem_answer     = '$answer',
		mem_keymem     = '$kmem',
		mem_refname    = '$refid',
		mem_AccountName = '$AccountName',
		mem_AccountNo   = '$AccountNo',
		mem_BankName    = '$BankName',
		mem_Bankcode    = '$Bankcode',
		mem_BranchName  = '$BranchName',
		mem_BranchCode  = '$BranchCode',
		mem_contactfee  ='$chkcontactsms'
		WHERE mem_id = '$id'";

		if(!($resreg=mysql_query($queryreg))){echo $queryreg.mysql_error(); exit;}
	
		if($_FILES["upload"]["name"]!="")
		{
			$fileload = $_FILES["upload"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="member_".$id.".".$file_ext[1];
			$destpath="tjtmp/".$myattach;

			copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."member_reg SET mem_upload ='".$myattach."' WHERE mem_id =".$id;
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

		header("Location:index.php?flag=edit");
		exit;
}
if($mode=="mail")
{
		
$query = "select * from ".$tblpref."admin where admin_id = 1";
if (!($result = mysql_query($query))) { echo 'Error : ' . $query.mysql_error(); }
$row = mysql_fetch_array($result);

$ouremail = $row[admin_email];

$queryexp="select * from ".$tblpref."expert where exp_id='$id'"; 
if(!($resultexp=mysql_query($queryexp))){ echo $queryexp.mysql_error(); exit;}
$exp_add=mysql_fetch_array($resultexp);

$sub="Truth Junction :: Profile Detail : " . $ouremail .  " From :" . $row[username];

$mess ="<html>
			<body >
			 Hello $exp_add[exp_person_name], <BR><BR>

			<TABLE width='100%' cellspacing='0' cellpadding='0' border=0 >
			
			<TR>
				<TD align=left>expert Type : ".$exp_add[exp_type]. "</TD>
			</TR>
			<TR>
				<TD align=left>Company Name : ".$exp_add[exp_comp_name]."</TD>
			</TR>
			<TR>
				<TD align=left>Contact Person : ".$exp_add[exp_person_name]."</TD>
			</TR>
			<TR>
				<TD align=left> Tel : ".$exp_add[exp_tel]."</TD>
			</TR>
			<TR>
				<TD aalign=left> Fax : ".$exp_add[exp_fax]."</TD>
			</TR>
			<TR>
				<TD aalign=left> Website : ".$exp_add[exp_web]."</TD>
			</TR>
			<TR>
				<TD aalign=left> Email : ".$exp_add[exp_email]."</TD>
			</TR>
			<TR>
				<TD aalign=left> Profile : ".$exp_add[exp_profile]."</TD>
			</TR>
			<TR>
				<TD>Please use the following Login details to login to Truth Junction website</TD>
				
			</TR>

			<TR>
				<TD>User ID : ".$exp_add[exp_email]."</TD>
			</TR>
			<TR>
				<TD>Password : ".$exp_add[exp_pass]."<br><br></TD>
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

		$email = $exp_add[exp_email];

		@mail($email,$sub,$mess,$mesheader);	
		
		header("Location:index.php?flag=mail");
		exit;
}
?>