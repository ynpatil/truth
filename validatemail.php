<?php 
	include("common/config.php");
	include("common/app_function.php");

	$email = $_REQUEST['value'];
	$query = "select * from ".$tblpref."member_reg where mem_email='$email'";
	if(!($res = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$num = mysql_num_rows($res);	
	echo $num;
?>	