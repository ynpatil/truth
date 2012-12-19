<?session_start();
include("../../common/config.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."services_category where cat_id='$id'"; 
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
$row_add=mysql_fetch_array($result);

admin_header("../../","Services Posting Mgmt");
admin_nav("../../");
?>
<script language="JavaScript" src="../../common/date-picker.js"></script>	
<script language="JavaScript" type="text/javascript" src="wysiwyg_cs.js"></script>
<table cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Services Posting Management</h2></b></td></tr>
	<tr><td height="12px"></td></tr>

	<tr><td>
			<TABLE width="100%" style="border-collapse: collapse" border="1" bordercolor="#D0D0D0" cellspacing="0" cellpadding="3" align="center">
			<FORM NAME="frmdepartadd" METHOD="POST" onsubmit="return validate();" ACTION="submit_pub_cat.php" enctype="multipart/form-data">
			<tr><th colspan="2" align="center" >View Services Posting</th>
			</td></tr>

			<TR>
			<TD align="right" width="30%">Services Area :<FONT COLOR="#FF0000">*</FONT></TD>
			<TD align="left" style="padding-left:5px;"><INPUT TYPE="text" NAME="name" id="name" maxLength="150" size="50" value="<?=$row_add[cat_name]?>" onchange="empty(this.id);"><br><label id='ename' class='warning'></label></TD>
			</TR>
			
			<tr>
			<td align="center" colspan="2">
			<input type="hidden" value="add" name="txtmode" >
			<input type="hidden" value="<?=$row_add[cat_id]?>" name="id" >
			<INPUT TYPE="button" value="Back" Name="Back" class="mybutton" onclick="javascript:history.back();">&nbsp;&nbsp;</td>
			</tr>
		</form>
		</table>

</td>
</tr>
</table>
</td>
</tr>
</table>
<script language="JavaScript">
empty = function (id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
 	if (obj != "")
	{
		document.getElementById(eid).innerHTML = "";
		return;
	}	
	else
	{
		document.getElementById(eid).innerHTML = "Please Enter!";	
		document.getElementById(id).focus();
	}
}

function validate()
{		
		var error = true;
		if (document.frmdepartadd.name.value=="")
		 { 
  			document.getElementById('ename').innerHTML = "Please Enter Service Area !";
		  	document.frmdepartadd.name.focus();
			error =  false;
		 }
		
		if (error != true)
		{
		
			return false;
		}
		else
		{
			return true;
		}
}
</script>
<?admin_footer("../../");?>