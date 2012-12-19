<?
	session_start();
	session_register();
	include("common/config.php");
	
	$username = $_REQUEST[username];
	$password = $_REQUEST[password]; 
	

	$select_login="select * from ".$tblpref."member WHERE mem_email='$username' AND mem_pass='$password'" ;
	if(!($result_login=mysql_query($select_login))) { echo $select_login.mysql_error();exit;}
	$row_count=mysql_num_rows($result_login);
	$row_login=mysql_fetch_array($result_login);
	
		if($row_count==0)
		{
			header("Location:index.php?flag=err");
			exit;
		}
		else
		{
				
				$_SESSION[uanme]=$row_login[mem_person_name];
				$_SESSION[mem_id]=$row_login[mem_id];
			
				header("Location:truth-junction-expert-index.php");
				exit;			
		}
?>