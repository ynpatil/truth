<?php
	session_start();
	session_register();
	include("common/config.php");
	
	$username = $_REQUEST[username];
	$password = $_REQUEST[password]; 
	
	$select_login="select * from ".$tblpref."expert WHERE exp_email ='$username' AND exp_pass='$password'" ;
	if(!($result_login=mysql_query($select_login))) { echo $select_login.mysql_error();exit;}
	$row_count=mysql_num_rows($result_login);
	$row_login=mysql_fetch_array($result_login);
	
	if($row_count>0)
	{
		if($row_login[exp_status]=="Active")
		{
			$_SESSION[expertname]=$row_login[exp_person_name];
			$_SESSION[exp_id]=$row_login[exp_id];
			$_SESSION[exptype]="expert";
			header("Location:truth-junction-expert-index.php");
			exit;
		}
		else
		{
			header("Location:index.php?msg=inactive");
			exit;
		}

	}
	else
	{	
		$_SESSION[expertname]="";
		$_SESSION[exp_id]="";
		$_SESSION[exptype]="";
		header("Location:index.php?msg=wrg");
		exit;
	}

?>