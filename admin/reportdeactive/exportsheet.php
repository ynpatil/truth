<? 
set_time_limit(0);
include("../../common/app_function.php");
include("../../common/config.php");

	$today=date("Y-m-d");
	$filename  = "Export Sheet".date("dmY");
	$ext       = 'csv';
	$mime_type = 'application/csv';
	$tabsp='","';

	include("../../common/download.php");

	echo "\"".$tabsp."Report Name: Member Report \"\r\n";
	echo "\"".$tabsp."Date Of Printing: $today \"\r\n";
	echo "\"".$tabsp." \"\r\n";
	echo "\""."Member ID".$tabsp."Member Name".$tabsp."Gender".$tabsp."Date Of Birth".$tabsp."Date Of Registration".$tabsp."Postal address".$tabsp."Phone No".$tabsp."Cell No".$tabsp."Email Address".$tabsp."Password".$tabsp."Referrer Name".$tabsp."Account Name".$tabsp."Account Number".$tabsp."Bank Name".$tabsp."Bank Code".$tabsp."Branch Name".$tabsp."Branch Code".$tabsp."Contact SMS".$tabsp."No of Referer Member".$tabsp."Total Due".$tabsp."Status \"\r\n";
		
	$query="select * from ".$tblpref."member_reg WHERE mem_id!=1 AND mem_status='Deactivate' ORDER BY mem_date DESC";
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	while($row=mysql_fetch_array($result)){ 


	$queryref="select * from ".$tblpref."member_reg WHERE mem_id='$row[mem_refname]'";
	if(!($resultref=mysql_query($queryref))){ echo $queryref.mysql_error(); exit;}
	$row_ref = mysql_fetch_array($resultref);

	$num_ref = mysql_num_rows($resultref);

	$referer = $row_ref[mem_title].$row_ref[mem_first_name]." ".$row_ref[mem_sur_name];		


	$queryreferer="SELECT mem_id FROM ".$tblpref."member_reg WHERE mem_refname='$row[mem_id]'";
	if(!($resreferer=mysql_query($queryreferer))){ echo $queryreferer.mysql_error(); exit;}
	$rowreferer = mysql_num_rows($resreferer);

	$len = strlen($row[mem_id]);
	switch($len)
	{
		case 1:
		$new_app_id = "000".$row[mem_id];
		break;
		case 2:
		$new_app_id = "00".$row[mem_id];
		break;
		case 3:
		$new_app_id = "0".$row[mem_id];
		break;
		default:
		$new_app_id = $row[mem_id];
		break;
	}
	$count = "TJ-".$new_app_id;

	$outstand = outstandingdue($row[mem_date],$row[mem_id]);

	$count++;		
	echo "\"".$count."".$tabsp."".$row[mem_title].$row[mem_first_name]." ".$row[mem_sur_name]."".$tabsp."".$row[mem_gender]."".$tabsp."".$row[mem_dob]."".$tabsp."".$row[mem_date]."".$tabsp."".$row[mem_address]."".$tabsp."".$row[mem_phone].$tabsp."".$row[mem_cel].$tabsp."".$row[mem_email].$tabsp."".$row[mem_password].$tabsp."".$referer."".$tabsp."".$row[mem_AccountName].$tabsp."".$row[mem_AccountNo].$tabsp."".$row[mem_BankName].$tabsp."".$row[mem_Bankcode].$tabsp."".$row[mem_BranchName].$tabsp."".$row[mem_BranchCode].$tabsp."".$row[mem_contactfee].$tabsp."".$outstand.$tabsp."".$rowreferer.$tabsp."".$row[mem_status]."".$tabsp." \"\r\n";

	}

?>