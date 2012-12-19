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

	echo "\"".$tabsp."Report Name: Commissions Payable in Current month \"\r\n";
	echo "\"".$tabsp."Date Of Printing: $today \"\r\n";
	echo "\"".$tabsp." \"\r\n";
	echo "\""."Member ID".$tabsp."Member Name".$tabsp."Date of Payment".$tabsp."Commission Payable \"\r\n";
		
	$query="select * from ".$tblpref."member_reg WHERE mem_id!=1 ORDER BY mem_date DESC";
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	while($row=mysql_fetch_array($result)){

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

	$dateendquery = "SELECT LAST_DAY(now()) as LastDayOfMonth";
	if (!($endres = mysql_query($dateendquery))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); exit;}
	$rowenddate = mysql_fetch_array($endres);
	$lastdate = $rowenddate[LastDayOfMonth]." 00:00:00";

	$selrefmem = "select * from ".$tblpref."member_reg WHERE mem_refname ='$row[mem_id]' AND mem_date <= '$lastdate'";
	if(!($resrefmem=mysql_query($selrefmem))){echo $selrefmem.mysql_error();exit;}
	$numrefmem = mysql_num_rows($resrefmem);

	$com = $numrefmem*100;
		if($com > 0)
		{
			$RecordCommision = number_format($com,2);
			$comm = $RecordCommision;

			$txtdate = explode("-",date("Y-m-d"));
			$datecurmonth = "01-".$txtdate[1]."-".$txtdate[2];

					
			echo "\"".$count."".$tabsp."".$row[mem_title].$row[mem_first_name]." ".$row[mem_sur_name].$tabsp."".$datecurmonth.$tabsp."".$comm."".$tabsp." \"\r\n";
		}

	}

?>