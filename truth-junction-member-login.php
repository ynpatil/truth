<?php
	session_start();
	session_register();
	include("common/config.php");
	
	$username = $_REQUEST[username];
	$password = $_REQUEST[password]; 
	
	$select_login = "select * from ".$tblpref."member_reg WHERE mem_email ='$username' AND mem_password='$password'";
	if(!($result_login=mysql_query($select_login))) { echo $select_login.mysql_error();exit;}
	$row_count=mysql_num_rows($result_login);
	$row_login=mysql_fetch_array($result_login);
	
	if($row_count>0)
	{
		if($row_login[mem_status]=="Active")
		{
			$_SESSION[mem_name] = $row_login[mem_first_name]." ".$row_login[mem_sur_name];
			$_SESSION[mem_id] = $row_login[mem_id];
			$_SESSION[exptype]="member";
			header("Location:truth-junction-member-index.php");
			exit;
		}
		else
		{
			header("Location:index.php?msgmem=inactive");
			exit;
		}

	}
	else
	{	
		$_SESSION[mem_name]="";
		$_SESSION[mem_id]="";
		$_SESSION[exptype]="";
		header("Location:index.php?msgmem=wrg");
		exit;
	}

?>