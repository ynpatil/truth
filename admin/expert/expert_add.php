<?php
session_start();
include("../../common/config.php");
include("../../common/app_function.php");
include("../../common/fckeditor/fckeditor_php5.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."expert where exp_id='$id'"; 
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
$row_add=mysql_fetch_array($result);

admin_header("../../","Expert Management");
admin_nav("../../");
?>
<script type="text/javascript" src="../../js/paging.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../cal_js/daterangepicker1.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript">	
	$(function(){
		  $('#txtdate').daterangepicker({
			posX:470,
			posY: 380
		  }); 
	 });
</script>

<script type="text/javascript">	
	$(function(){
		  $('#txtendcontract').daterangepicker({
			posX:460,
			posY: 420
		  }); 
	 });
</script>

<style type="text/css">
.ui-daterangepickercontain {
	top:255px;
	left:448px;
	position: absolute;
	z-index: 999;
}
</style>

<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	<tr><td align="center" ><h2>Expert Management</h2></td></tr>
	<?if($flag=="filesize"){?>
	<tr><td height="20" class="warning" align="center">
	File size is not more then 100 KB
	</td></tr>
	<?}?>
	<tr><td height="12px"></td></tr>
	<tr><th>
	<FORM NAME="frmexpadd" METHOD="POST" ACTION="submit_expert.php" enctype="multipart/form-data" onsubmit="val()">
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		
		<tr><th colspan="2" align="center" ><?if($id!=""){?>Edit Expert<?}else{?>Add New Expert<?}?></th>
		</td></tr>

		<TR>
		<TD align="right" class="tbborder" width="30%">Choose Expert Service Area :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder">
		<select NAME="exp_type" id="exp_type" style="width:280px" onchange="empty(this.id);">
		<option value="" >Please Select</option>			
		<? 
		$query="SELECT * FROM  ".$tblpref."services_category"; 
		if (!($result = mysql_query($query))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); 	exit;}
		while($row=mysql_fetch_array($result))
		{?>
		<option value="<?=$row[cat_id]?>" <?if($row[cat_id]==$row_add[exp_service_area_id]){?>selected <?}?>><?=$row[cat_name]?> </option>
		<?}?>
		</select>
		<br><label id='eexp_type' class='warning'></label></td>
		</TR>
		
		<TR>
		<TD align="right" class="tbborder" >Expert Name :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="person" id="person" maxLength="255" size="50" value="<?=$row_add[exp_person_name]?>" onchange="empty(this.id);">
		<br><label id='eperson' class='warning'></label></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Company Name :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="comp_name" id="comp_name" maxLength="255" size="50" value="<?=$row_add[exp_comp_name]?>" onchange="empty(this.id);">
		<br><label id='ecomp_name' class='warning'></label></td>
		</TR>		
		
		<TR>
		<TD align="right" class="tbborder" >Tel :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="tel" id="tel" maxLength="255" size="50" value="<?=$row_add[exp_tel]?>" onchange="empty(this.id);">
		<br><label id='etel' class='warning'></label></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Fax :</TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="fax" id="fax" maxLength="255" size="50" value="<?=$row_add[exp_fax]?>" onchange="empty(this.id);">
		<br><label id='efax' class='warning'></label></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Website :</TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="website" id="website" maxLength="255" size="50" value="<?=$row_add[exp_web]?>" >
		</td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Date of Joining :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder">
		<? $contractdate = explode(" ",$row_add[exp_contract_date]);
			if(dateformate($contractdate[0])!='--')
			{
				$txtdate1 = dateformate($contractdate[0]);
			}
			else
			{
				$txtdate1 = "";
			}
		
		?>
		<input type="text" value="<?=$txtdate1?>" name="txtdate" id="txtdate"/>
		<br><label id='etxtdate' class='warning'></label></td></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >End of contract :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder">
		<? $endcontractdate = explode(" ",$row_add[exp_endcont_date]);
			if(dateformate($endcontractdate[0])!='--')
			{
				$txtdate2 = dateformate($endcontractdate[0]);
			}
			else
			{
				$txtdate2 = "";
			}
		?>
		<input type="text" value="<?=$txtdate2?>" name="txtendcontract" id="txtendcontract" />
		<br><label id='etxtendcontract' class='warning'></label></td></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Email / User Id :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="email" id="email" maxLength="255" size="50" value="<?=$row_add[exp_email]?>" onchange="empty(this.id);">
		<br><label id='eemail' class='warning'></label></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Password :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="password" NAME="pass" id="pass" maxLength="255" size="50" value="<?=$row_add[exp_pass]?>" onchange="empty(this.id);"><label  class='warning'> Password should be Alphanumeric</label>
		<br><label id='epass' class='warning'></label></td>
		</TR>
		
		<TR>
		<TD align="right" class="tbborder">Profile :</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder">
		<?php
				$oFCKeditor = new FCKeditor('linkcontect');
				$oFCKeditor->BasePath = '../../common/fckeditor/';
				//$oFCKeditor->ToolbarSet = "Standard";
				$oFCKeditor->Value = stripslashes($row_add[exp_profile]);
				$oFCKeditor->Width  = '500';
				$oFCKeditor->Height = '350';
				$oFCKeditor->Create();
		?>
		</td>
		</TR>
		<TR>
		<td align="right" class="tbborder" >Status : </td>
		<td align="left" style="padding-left:5px;" class="tbborder">
		<input type="radio" name="radstatus" value="Active" <? if($row_add[exp_status]=="Active" || $row_add[exp_status]==""){ ?>checked <? } ?>> Active &nbsp;<input type="radio" name="radstatus" value="Inactive" <? if($row_add[exp_status]=="Inactive"){ ?>checked <? } ?>> Inactive 
		</td>
		</TR>

		<TR>
		<td align="center" colspan="2" class="tbborder">
		<input type="hidden" value="add" name="txtmode">
		<input type="hidden" value="<?=$id?>" name="id">
		<INPUT TYPE="submit" value="Submit" Name="submit" class="mybutton" onclick="return val();" >&nbsp;&nbsp;</td>
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
<?admin_footer("../../");?>
<script language="javascript">
empty = function (id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	
	if (id == "pass")
	{
			var msg= "";
			var altmsg="";
			if (id == "pass")
			{
				msg = "Please Enter!";
				minlen = "Please Enter Minimum 8 character!";
			}
			if(obj=="")
			{
				document.getElementById(eid).innerHTML = msg;
				document.getElementById(id).focus();
				return false;
			}     
			 
			if(document.getElementById(id).value.length<8)
			{
				 document.getElementById(eid).innerHTML = minlen;
				 document.getElementById(id).focus();
				 return false;
			}
			if(document.getElementById(id).value!="")
			{
				
				var numaric = document.getElementById(id).value;
				for(var j=0; j<numaric.length; j++)
				{
				  var alphaa = numaric.charAt(j);
				  var hh = alphaa.charCodeAt(0);
				  if((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123))
				  {
				  }
				  else	
				  {
					  document.getElementById(eid).innerHTML = "Please Enter the Alphabets or Numbers";
						document.getElementById(id).focus();
						return false;
				  }
				}
								
			}
			else
			{
				document.getElementById(eid).innerHTML = "";
			}
			
	}

	if (id == "tel")
	{
			var msg= "";
			var altmsg="";
				if (id == "tel")
				{
					msg = "Please Enter Phone Number!";
					altmsg = "Please Enter Valid Phone Number!";
					minlen = "Please Enter Minimum 6 Phone Number!";
					maxlen = "Please Enter Maximum 14 digit Number!";
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
				
					if(document.getElementById(id).value.length<6)
					{
						 document.getElementById(eid).innerHTML = minlen;
						 document.getElementById(id).focus();
						 return ;
					}
					if(document.getElementById(id).value.length>14)
					{
						document.getElementById(eid).innerHTML = maxlen;
						document.getElementById(id).focus();
						return;
					}
					else
					{
						document.getElementById(eid).innerHTML = "";
					}
			}
	}

	if (id == "fax")
	{
			var msg= "";
			var altmsg="";
				if (id == "fax")
				{
					msg = "Please Enter Phone Number!";
					altmsg = "Please Enter Valid fax Number!";
					minlen = "Please Enter Minimum 6 fax Number!";
					maxlen = "Please Enter Maximum 14 digit Number!";
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
				
					if(document.getElementById(id).value.length<6)
					{
						 document.getElementById(eid).innerHTML = minlen;
						 document.getElementById(id).focus();
						 return ;
					}
					if(document.getElementById(id).value.length>14)
					{
						document.getElementById(eid).innerHTML = maxlen;
						document.getElementById(id).focus();
						return;
					}
					else
					{
						document.getElementById(eid).innerHTML = "";
					}
			}
	}


	if (id == 'email')
	{
		if (obj == "")
		{
			document.getElementById(eid).innerHTML = "Please Enter Email!";
			document.frmexpadd.email.focus();
		}
		else if(obj != "")
		{	
			var email	= document.frmexpadd.email.value;
			if(email != "")
			{	
				if(email.indexOf("@")==-1 || email.indexOf(".")==-1 || email.indexOf(" ")!=-1)
				{
					document.getElementById('eemail').innerHTML = "Invalid Email ID!";
					document.frmexpadd.email.focus();
					return;
				}
				else
				{
					document.getElementById(eid).innerHTML = "";
					return;	
				}
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
function val()
{
	var warning = true;

	if (document.frmexpadd.exp_type.value=="")
	{ 
  		document.getElementById('eexp_type').innerHTML = "Please Select Expert Service Area!";
		document.frmexpadd.exp_type.focus();
		warning =  false;
	}

	if (document.frmexpadd.comp_name.value=="")
	{ 
  		document.getElementById('ecomp_name').innerHTML = "Please Enter Company Name !";
		document.frmexpadd.comp_name.focus();
		warning =  false;
	}
	if (document.frmexpadd.person.value=="")
	{ 
  		document.getElementById('eperson').innerHTML = "Please Enter Expert name !";
		document.frmexpadd.person.focus();
		warning =  false;
	}
	if (document.frmexpadd.tel.value=="")
	{ 
  		document.getElementById('etel').innerHTML = "Please Enter Telephone No. !";
		document.frmexpadd.tel.focus();
		warning =  false;
	}

	if (document.frmexpadd.txtdate.value=="")
	{ 
  		document.getElementById('etxtdate').innerHTML = "Please Select Date!";
		document.frmexpadd.txtdate.focus();
		warning =  false;
	}

	if (document.frmexpadd.txtendcontract.value=="")
	{ 
  		document.getElementById('etxtendcontract').innerHTML = "Please Select Date!";
		document.frmexpadd.txtendcontract.focus();
		warning =  false;
	}


	if (document.frmexpadd.email.value=="")
	{ 
  		document.getElementById('eemail').innerHTML = "Please Enter Email. !";
		document.frmexpadd.email.focus();
		warning =  false;
	}
	if (document.frmexpadd.pass.value=="")
	{ 
  		document.getElementById('epass').innerHTML = "Please Enter Password. !";
		document.frmexpadd.pass.focus();
		warning =  false;
	}
	else{
		return empty('pass');
		warning =  false;

	}
	
	
return warning;
}
</script>
<!-- Script by hscripts.com -->
<script type="text/javascript">
function alphanumeric(alphane)
{
	var numaric = alphane;
	for(var j=0; j<numaric.length; j++)
		{
		  var alphaa = numaric.charAt(j);
		  var hh = alphaa.charCodeAt(0);
		  if((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123))
		  {
		  }
		  else	
		  {
              alert("Your Alpha Numeric Test Failed");
			 return false;
		  }
 		}
 alert("Your Alpha Numeric Test Passed");
 return true;
}
</script>
<!-- Script by hscripts.com -->

