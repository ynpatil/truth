<?session_start();
session_register("$_SESSION[username]");
include("../common/config.php");
include("../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,index.php", 0);
	exit();
}

admin_header("../","Home");
admin_nav("../");

?>

<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
							<TR>
							<TD align="center">
							&nbsp;<BR>
							<p style="MARGIN-LEFT: 15px; MARGIN-RIGHT: 15px"><b>
							<br>
							<br>
							Welcome to the Admin section of <?echo $sitename;?>!<br>
							<br>
							</font></b>- You can 
							 access all Admin functions form here.<br>
							
	   
							
</TABLE>

<?admin_footer("../");?>