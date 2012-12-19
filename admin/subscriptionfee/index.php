<?php
session_start();
session_register("$_SESSION[username]");
include("../../common/config.php");
include("../../common/app_function.php");
$CurDate = date('Y-m-d h:i:s');
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
admin_header("../../","Subscription Fee Management");
admin_nav("../../");

if($id !="")
{
	$query_update = "INSERT INTO ".$tblpref."subscriptionfee set 
					subfee_subfees = '$subfee',
					subfee_contactfee ='$subcont',
					subfee_commission ='$commission',
					subfee_date = '$CurDate'";
	if(!($resultupdate=mysql_query($query_update))){ echo $query_update.mysql_error(); exit;}
}

	$query= "SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date <= '$CurDate' ORDER BY subfee_id DESC";
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	$row_add=mysql_fetch_array($result);
?>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="70%" align="center">
	<tr><td align="center"><h2>Subscription Fee Management System</h2></td></tr>
	<tr><td height="12px" class="warning" align="center">
	<?if($id!=""){echo "Subscription Fee is updated successfully.";}?>
	
	</td></tr>
	<tr>
	 <th>
	 <form name="frmcmsadd" method="POST" action="index.php" onsubmit="return validate();">
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%">
		 	
			<INPUT TYPE="hidden" name="id" value="<?=$row_add[subfee_id]?>">
			<tr><th colspan="2" align="center" >Change Subscription Fee</th>
			</td></tr>

            <TR>
		    <TD align="right" class="tbborder" >Subscription fees :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="subfee" id="subfee" maxLength="255" size="50" value="<?=$row_add[subfee_subfees]?>" onchange="return empty(this.id)">
			<br><label id='esubfee' class='warning'></label></TD>
			</TR>

			<TR>
		    <TD align="right" class="tbborder">In Contact fees :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" name="subcont" id="subcont" maxLength="255" size="50" value="<?=$row_add[subfee_contactfee]?>" onchange="return empty(this.id)">
			<br><label id='esubcont' class='warning'></label></TD>
			</TR>

			<TR>
		    <TD align="right" class="tbborder">Commission:</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" name="commission" id="commission" maxLength="255" size="50" value="<?=$row_add[subfee_commission]?>" onchange="return empty(this.id)" readonly>
			<br><label id='ecommission' class='warning'></label></TD>
			</TR>
		  	
			<TR>
			<td align="center" colspan="2" class="tbborder">		
			<INPUT TYPE="submit" value="Submit" Name="submit" class="mybutton">&nbsp;&nbsp;</td>
			</tr>
		
	</TABLE>
	</FORM>
</TD>
</TR>
</table>
</TD>
</TR>
<tr><td>&nbsp;</td></tr>
</table>
<?admin_footer("../");?>
<script language="javascript">
empty = function (id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
		
	if (id == "subfee")
	{
			var msg= "";
			var altmsg="";
				if (id == "subfee")
				{
					msg = "Please Enter Number!";
					altmsg = "Please Enter Valid Number!";
					
				}

				if(obj=="")
				 {
					document.getElementById(eid).innerHTML = msg;
					document.getElementById(id).focus();
					return;
				 }     
				 else
				{
					var checkOK = "0123456789-+";
					var checkStr = document.getElementById(id).value;
					var allValid  = true;
					 var allNum = "";
	
					 for (i = 0;  i < checkStr.length;  i++)
					 {
							ch = checkStr.charAt(i);
							for (j = 0;  j < checkOK.length;  j++)
							if (ch == checkOK.charAt(j))
									break;

							 if (j == checkOK.length)
							   {
								 allValid = false;
								 break;
								}
								if (ch != ",")
								 allNum += ch;
					}
					if (!allValid)
					{
						document.getElementById(eid).innerHTML =altmsg;
						document.getElementById(id).focus();
						return;
					}
					else
					{
						   document.getElementById(eid).innerHTML = "";
					}
				
					
			}
	}

	if (id == "subcont")
	{
			var msg= "";
			var altmsg="";
				if (id == "subcont")
				{
					msg = "Please Enter Phone Number!";
					altmsg = "Please Enter Valid Number!";
				}

				if(obj=="")
				 {
					document.getElementById(eid).innerHTML = msg;
					document.getElementById(id).focus();
					return;
				 }     
				 else
				{
					var checkOK = "0123456789-+";
					var checkStr = document.getElementById(id).value;
					var allValid  = true;
					 var allNum = "";
	
					 for (i = 0;  i < checkStr.length;  i++)
					 {
							ch = checkStr.charAt(i);
							for (j = 0;  j < checkOK.length;  j++)
							if (ch == checkOK.charAt(j))
									break;

							 if (j == checkOK.length)
							   {
								 allValid = false;
								 break;
								}
								if (ch != ",")
								 allNum += ch;
					}
					if (!allValid)
					{
						document.getElementById(eid).innerHTML =altmsg;
						document.getElementById(id).focus();
						return;
					}
					else
					{
						   document.getElementById(eid).innerHTML = "";
					}
				
			}
	}
	

	if (id == "commission")
	{
			var msg= "";
			var altmsg="";
				if (id == "commission")
				{
					msg = "Please Enter Phone Number!";
					altmsg = "Please Enter Valid Number!";
				}

				if(obj=="")
				 {
					document.getElementById(eid).innerHTML = msg;
					document.getElementById(id).focus();
					return;
				 }     
				 else
				{
					var checkOK = "0123456789-+";
					var checkStr = document.getElementById(id).value;
					var allValid  = true;
					 var allNum = "";
	
					 for (i = 0;  i < checkStr.length;  i++)
					 {
							ch = checkStr.charAt(i);
							for (j = 0;  j < checkOK.length;  j++)
							if (ch == checkOK.charAt(j))
									break;

							 if (j == checkOK.length)
							   {
								 allValid = false;
								 break;
								}
								if (ch != ",")
								 allNum += ch;
					}
					if (!allValid)
					{
						document.getElementById(eid).innerHTML =altmsg;
						document.getElementById(id).focus();
						return;
					}
					else
					{
						   document.getElementById(eid).innerHTML = "";
					}
				
			}
	}

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
	var warning = true;

	if (document.frmcmsadd.subfee.value=="")
	{ 
  		document.getElementById('esubfee').innerHTML = "Please Enter the subscription fee!";
		document.frmcmsadd.subfee.focus();
		warning =  false;
	}

	if (document.frmcmsadd.subcont.value=="")
	{ 
  		document.getElementById('esubcont').innerHTML = "Please Enter the Contact fee!";
		document.frmcmsadd.subcont.focus();
		warning =  false;
	}

	if (document.frmcmsadd.commission.value=="")
	{ 
  		document.getElementById('ecommission').innerHTML = "Please Enter the Commission Alloted!";
		document.frmcmsadd.commission.focus();
		warning =  false;
	}
	
	return warning;
}
</script>