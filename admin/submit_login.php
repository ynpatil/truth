<? session_start();
session_register();
include("../common/config.php");
//$_SESSION["getrvalue"];

$imgsession= $_SESSION["getrvalue"];
if(strtolower($_REQUEST['captcha']) == $imgsession)
{
$username=addslashes(trim($_POST[username]));
$password=trim($password);
$query=sprintf("select * from ".$tblpref."admin where username='%s'",$username);

if(!($result = mysql_query($query))){ echo $query.mysql_error();  exit; }
	 $rowcount = mysql_num_rows($result);
	  if($rowcount > 0)
		{
			$row = mysql_fetch_array($result);
			if(($username!=$row[username]) || ($password!=$row[password]))
			{
				$select="select * from  ".$tblpref."admin";
				if(!($result_sel = mysql_query($select))){ echo $select.mysql_error();  exit; }
				$row_sel = mysql_fetch_array($result_sel);
				$n=$row_sel[logincount];
				$n=$n+1;

				if($row_sel[logincount]< 2)
				{
					$update="update ".$tblpref."admin set 
					logincount='$n' where username ='$username'";
					if(!($result_up = mysql_query($update))){ echo $update.mysql_error();  exit; }
					header("Location:index.php?flag=wrong");
					exit;
				}else
				{
					header("Location:failedlogin.php");
					exit;
				}		
			}else
			{
				$_SESSION[username]=$row[username];
				$_SESSION[user_type]=$row[user_type];
				$_SESSION[user_game]=$row[admin_game];
				$_SESSION[admin_name]=$row[admin_name];

				$update="update ".$tblpref."admin set 
				logincount='0' where username ='$username'";
				if(!($result_up = mysql_query($update))){ echo $update.mysql_error();  exit; }

				header("Location:home.php?flag=right");
				exit;
			}
			
	}else{
				$select="select * from  ".$tblpref."admin";
				if(!($result_sel = mysql_query($select))){ echo $select.mysql_error();  exit; }
				$row_sel = mysql_fetch_array($result_sel);
				$n=$row_sel[logincount];
				$n=$n+1;

				if($row_sel[logincount]< 5)
				{
					$update="update ".$tblpref."admin set 
					logincount='$n' where username ='$username'";
					if(!($result_up = mysql_query($update))){ echo $update.mysql_error();  exit; }

					header("Location:index.php?flag=wrong");
					exit;
				}else
				{
					header("Location:failedlogin.php");
					exit;
				}
}
}else{
				

				header("Location:index.php?flag=invalid");
				exit;
				
}
?>