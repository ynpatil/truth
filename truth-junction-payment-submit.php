<?php
session_start();
include("common/config.php");

	$CurDate = date('Y-m-d h:i:s');

	if($_SESSION[mem_id]!="")
	{
		$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date <= '$CurDate' ORDER BY subfee_id DESC";
		if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit;}
		$rowsubfee = mysql_fetch_array($resubfee);
		$rowsf = $rowsubfee[subfee_subfees] + $rowsubfee[subfee_contactfee];

		$querypayment = "INSERT INTO ".$tblpref."payment SET
		pay_date = '$CurDate',
		pay_sub_fee = '$rowsf',
		pay_num_paid_ref = '0',
		pay_commission = '0',
		pay_total_paid = '$pay',
		pay_member_id = '$_SESSION[mem_id]'";
		if(!($respayment=mysql_query($querypayment))){echo $querypayment.mysql_error(); exit;}

		header("Location:truth-junction-member-index.php?flag=stat");
		exit;
	}
	else
	{
		header("Location:truth-junction-member-index.php");
		exit;
	}

?>