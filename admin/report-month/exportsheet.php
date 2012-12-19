<? 
set_time_limit(0);
include("../../common/app_function.php");
include("../../common/config.php");

	$today=date("Y-m-d");
	$filename  = "Export Sheet Payment".date("dmY");
	$ext       = 'csv';
	$mime_type = 'application/csv';
	$tabsp='","';

include("../../common/download.php");

	echo "\"".$tabsp."Report Name: 	Payment Received in Selected month \"\r\n";
	echo "\"".$tabsp."Date Of Printing: $today \"\r\n";
	echo "\"".$tabsp." \"\r\n";
	echo "\""."Member ID".$tabsp."Member Name".$tabsp."Date Of Payment".$tabsp."Total Payment \"\r\n";
		
	$curdate = date("Y-m-d");
	
	$dates = explode("-",$curdate);

	$startdate = $dates[0]."-".$dates[1]."-01 00:00:00";
	
	if ($_GET[sorton]!="")
	{
		 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
	}
	else
	{
		$condition2=" ORDER BY pay_id DESC";
	}

	if($txtdate!="")
	{
		$condition[] = "pay_date like '%".dateformate($txtdate)."%'";
	}
	else
	{
		$dateendquery = "SELECT LAST_DAY(now()) as LastDayOfMonth";
		if (!($endres = mysql_query($dateendquery))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); exit;}
		$rowenddate = mysql_fetch_array($endres);

		$lastdate = $rowenddate[LastDayOfMonth]." 00:00:00";

		$condition[] = "pay_date  >= '$startdate' AND pay_date <= '$lastdate'";
	}

	if(is_array($condition))
	{
		$condition=" WHERE " . implode(" AND ",$condition);
	}

	$query="select * from ".$tblpref."payment $condition ORDER BY pay_date ASC";
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	while($row=mysql_fetch_array($result)){ 


	$queryref="select * from ".$tblpref."member_reg WHERE mem_id='$row[pay_member_id]'";
	if(!($resultref=mysql_query($queryref))){ echo $queryref.mysql_error(); exit;}
	$row_ref = mysql_fetch_array($resultref);

	
	$len = strlen($row_ref[mem_id]);
	switch($len)
	{
		case 1:
		$new_app_id = "000".$row_ref[mem_id];
		break;
		case 2:
		$new_app_id = "00".$row_ref[mem_id];
		break;
		case 3:
		$new_app_id = "0".$row_ref[mem_id];
		break;
		default:
		$new_app_id = $row_ref[mem_id];
		break;
	}
	$count = "TJ-".$new_app_id;


	$count++;		
	echo "\"".$count."".$tabsp."".$row_ref[mem_title].".".$row_ref[mem_first_name]." ".$row_ref[mem_sur_name]."".$tabsp."".$row[pay_date]."".$tabsp.""."P ".$row[pay_sub_fee]." \"\r\n";

	}

?>