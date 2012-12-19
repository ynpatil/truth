<?session_start();
session_register("$_SESSION[username]");
include("../common/config.php");
include("../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,index.php", 0);
	exit();
}
admin_header("../","Admin Information");
admin_nav("../");

$query="SELECT * FROM ".$tblpref."admin WHERE admin_id='1'"; 
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
$row_add=mysql_fetch_array($result);
?>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="70%" align="center" >
	<tr><td align="center"><h2>Admin Information</h2></td></tr>
	<tr><td height="12px" class="warning" align="center"><?if($flag=="edit"){echo "Admin info is edited successfully.";}?></td></tr>
	<tr>
	 <th>
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		 	<FORM NAME="frmcmsadd" METHOD="POST" onsubmit="return validate();" ACTION="submit_admininfo.php">
			<INPUT TYPE="hidden" name="id" value="<?=$row_add[admin_id]?>">
			<tr><th colspan="2" align="center" >Change Info</th>
			</td></tr>

            <TR>
		    <TD align="right" class="tbborder" >Username :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="username" maxLength="255" size="50" value="<?=$row_add[username]?>" readonly></TD>
			</TR>

			<TR>
		    <TD align="right" class="tbborder" >Password :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="password" NAME="password" maxLength="255" size="50" value="<?=$row_add[password]?>"></TD>
			</TR>

			<TR>
		    <TD align="right" class="tbborder" >Admin E-mail :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="email" maxLength="255" size="50" value="<?=$row_add[admin_email]?>"></TD>
			</TR>
			
	  <!--  <TR>
		    <TD align="right" class="tbborder" >Contact Address :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder">
			<textarea rows="3" cols="47" name="address" ><?=$row_add[admin_address]?></textarea>
			</TD>
			</TR>
			
			<TR>
		    <TD align="right" class="tbborder" >Contact Phone :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="phone" maxLength="255" size="50" value="<?=$row_add[admin_con_no]?>"></TD>
			</TR>

			<TR>
		    <TD align="right" class="tbborder" >Contact Fax :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="fax" maxLength="255" size="50" value="<?=$row_add[admin_fax_no]?>"></TD>
			</TR> -->	
												  	
			<TR>
			<td align="center" colspan="2" class="tbborder">		
			<INPUT TYPE="submit" value="Submit" Name="submit" class="mybutton">&nbsp;&nbsp;</td>
			</tr>
		
		</FORM>
	</TABLE>
</TD>
</TR>
</table>
</TD>
</TR>
<tr><td>&nbsp;</td></tr>
</table>
<?admin_footer("../");?>