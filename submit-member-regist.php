<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");

	$ddtitle = $_REQUEST[ddtitle];
	$txtfname = $_REQUEST[txtfname];
	$txtsname = $_REQUEST[txtsname];
	$radgender = $_REQUEST[radgender];
	$txtdate = $_REQUEST[txtmonth];
	$txtpaddress = $_REQUEST[txtpaddress];
	$txtphone = $_REQUEST[txtphone];
	$txtcel = $_REQUEST[txtcel];
	$upload = $_REQUEST[upload];
	$email = $_REQUEST[email];
	$password = $_REQUEST[password];
	$rpassword = $_REQUEST[rpassword];
	$squest = $_REQUEST[squest];
	$answer = $_REQUEST[answer];
	$kmem = $_REQUEST[kmem];
	$refname = $_REQUEST[refname];
	$AccountName = $_REQUEST[AccountName];
	$AccountNo = $_REQUEST[AccountNo];
	$BankName = $_REQUEST[BankName];
	$Bankcode = $_REQUEST[Bankcode];
	$BranchName = $_REQUEST[BranchName];
	$BranchCode = $_REQUEST[BranchCode];
	$chkcontactsms = $_REQUEST[chkcontactsms];
	
	$len = strlen($txtday);
	switch($len)
	{
		case 1:
			$dat= "0".$txtday;
			break;
		default:
			$dat = $txtday;
			break;
	}
			
	$txtdob = $txtyear."-".$txtmonth."-".$dat;

	if($memid!="")
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
		mem_contactfee  ='$chkcontactsms'
		WHERE mem_id = '$_SESSION[mem_id]'";

		if(!($resreg=mysql_query($queryreg))){echo $queryreg.mysql_error(); exit;}
	
		if($_FILES["upload"]["name"]!="")
		{
			$fileload = $_FILES["upload"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="member_".$_SESSION[mem_id].".".$file_ext[1];
			$destpath="tjtmp/".$myattach;

			copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."member_reg SET mem_upload ='".$myattach."' WHERE mem_id = ".$_SESSION[mem_id];
			if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
		}
		
		//============================================================================
		$query = "select * from ".$tblpref."admin where admin_id = 1";
		if (!($result = mysql_query($query))) { echo 'Error : ' . $query.mysql_error(); }
		$row = mysql_fetch_array($result);
		$ouremail = $row[admin_email];

		$query="select * from ".$tblpref."content_master where cms_id='4'";
		if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
		$row_cms=mysql_fetch_object($result);

		$sub="Truth Junction :: Registration : " . $ouremail .  " From :" . $row[username];

		$mess ="<html>
				<body>
				 Hello ".$txtfname." ".$txtsname.", <BR><BR>

				<TABLE width='100%' cellspacing='0' cellpadding='0' border='0'>
				<TR>
					<TD align=left>You had Successfully Updated with Your Profile At Truth Junction</TD>
				</TR>
				<TR>
					<TD align=left>Please Login Now : ".$sitename."</TD>
				</TR>
				<TR>
					<TD align=left>Truth Junction Webmaster </TD>
				</TR>
				<TR>
					<TD align=left> ".$row_cms->cms_desc." </TD>
				</TR>
				</TABLE>
				</body>
				</html>";


		$mesheader =  "From: ".$row[username]."\n";
		$mesheader .= "Reply-To: ". $ouremail . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		@mail($email,$sub,$mess,$mesheader);

		//=============================================================================

		header("Location:truth-junction-member-index.php?flag=update");
		exit();
	}

	else 
	if($txtsname!="")
	{

		$txtdate = date("Y-m-d h:i:s");

		$queryreg = "INSERT INTO ".$tblpref."member_reg SET
		mem_title      = '$ddtitle',
		mem_first_name = '$txtfname',
		mem_sur_name   = '$txtsname',
		mem_gender     = '$radgender',
		mem_dob        = '$txtdob',
		mem_date       = '$txtdate',
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
		mem_contactfee  ='$chkcontactsms',
		mem_status = 'Active'";

		if(!($resreg=mysql_query($queryreg))){echo $queryreg.mysql_error(); exit;}
		$id = mysql_insert_id();
	
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

		$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date <= '$txtdate' ORDER BY subfee_id DESC";
		if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit;}
		$rowsubfee = mysql_fetch_array($resubfee);
		
		$rowsf = $rowsubfee[subfee_subfees] + $rowsubfee[subfee_contactfee];
	
		$querypayment = "INSERT INTO ".$tblpref."payment SET
		pay_date = '$txtdate',
		pay_sub_fee = '$rowsf',
		pay_num_paid_ref = '0',
		pay_commission = '0',
		pay_total_paid = '$rowsf',
		pay_type = 'Register',
		pay_member_id = '$id'";
		if(!($respayment=mysql_query($querypayment))){echo $querypayment.mysql_error(); exit;}
			
		$_SESSION[mem_name] = $txtfname." ".$txtsname;
		$_SESSION[mem_id] = $id;
		$_SESSION[exptype]="member";

		//============================================================================
		$query = "select * from ".$tblpref."admin where admin_id = 1";
		if (!($result = mysql_query($query))) { echo 'Error : ' . $query.mysql_error(); }
		$row = mysql_fetch_array($result);
		$ouremail = $row[admin_email];

		$query="select * from ".$tblpref."content_master where cms_id='4'";
		if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
		$row_cms=mysql_fetch_object($result);

		$sub="Truth Junction :: Registration : " . $ouremail .  " From :" . $row[username];

		$mess ="<html>
				<body>
				 Hello ".$txtfname." ".$txtsname.", <BR><BR>

				<TABLE width='100%' cellspacing='0' cellpadding='0' border='0'>
				<TR>
					<TD align=left>You had Successfully Register with Truth Junction</TD>
				</TR>
				<TR>
					<TD align=left>Please Login Now : ".$sitename."</TD>
				</TR>
				<TR>
					<TD align=left>Truth Junction Webmaster </TD>
				</TR>
					<TR>
					<TD align=left> ".$row_cms->cms_desc." </TD>
				</TR>
				</TABLE>
				</body>
				</html>";


		$mesheader =  "From: ".$row[username]."\n";
		$mesheader .= "Reply-To: ". $ouremail . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		@mail($email,$sub,$mess,$mesheader);

		//=============================================================================

		header("Location:truth-junction-member-index.php?flag=succ");
		exit();

	}
	else
	{
		session_destroy();	header("Location:truth-junction-membreg.php?flag=err&mem_title=$mem_title&mem_first_name=$mem_first_name");
		exit();
	}
?>