<?
include("../common/config.php");

  $query_update="UPDATE ".$tblpref."admin set 
			password='$password',
			admin_email='$email',
			admin_address='$address',
			admin_con_no='$phone',
			admin_fax_no='$fax'
			where admin_id='$id'";
		
if(!($result=mysql_query($query_update))){echo $query_update.mysql_error(); exit;}
header("Location:admin_info.php?flag=edit");
exit;
?>