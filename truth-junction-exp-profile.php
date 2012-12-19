<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	include("common/fckeditor/fckeditor_php5.php");
	
	$query="select * from ".$tblpref."expert where exp_id='$_SESSION[exp_id]'"; 
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	$row_add=mysql_fetch_array($result);

	
	index_header("My Expert Page");
?>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo;
	My Expert Page
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>My Expert Page</h2>
					<div style="padding-top:10px;">
					<FORM NAME="frmexpadd" METHOD="POST" ACTION="submit-expert-profile.php" enctype="multipart/form-data" onsubmit="return val()">
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		
		<tr><th colspan="2" align="center" >Update Profile</th>
		</td></tr>
		
		<? if($flag=="edit") { ?>
		<tr><td height="20" class="warning" align="center" colspan="2"> You Profile Information has been updated successfully</td></tr>
		<? } ?>
		
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
		<input type="text" value="<?=$txtdate1?>" name="txtdate" id="txtdate" readonly/>
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
		
		<input type="text" value="<?=$txtdate2?>" name="txtendcontract" id="txtendcontract" readonly/>
		<br><label id='etxtendcontract' class='warning'></label></td></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Email / User Id :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="email" id="email" maxLength="255" size="50" value="<?=$row_add[exp_email]?>" onchange="empty(this.id);">
		<br><label id='eemail' class='warning'></label></td>
		</TR>

		<TR>
		<TD align="right" class="tbborder" >Password :<FONT COLOR="#FF0000">*</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="password" NAME="pass" id="pass" maxLength="255" size="50" value="<?=$row_add[exp_pass]?>" onchange="empty(this.id);"><label  class='error'> Password should be Alphanumeric</label>
		<br><label id='epass' class='warning'></label></td>
		</TR>
		
		<TR>
		<TD align="right" class="tbborder">Profile :</FONT></TD>
		<TD align="left" style="padding-left:5px;" class="tbborder"><?php
								$oFCKeditor = new FCKeditor('linkcontect') ;
								$oFCKeditor->BasePath = 'common/fckeditor/';
								//$oFCKeditor->ToolbarSet = "Standard";
								$oFCKeditor->Value = stripslashes($row_add[exp_profile]);
								$oFCKeditor->Width  = '540';
								$oFCKeditor->Height = '350';
								$oFCKeditor->Create() ;
								?>
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

					<!--  -->
					</div>
				</div>
			<div class="clear"></div>
			</div>
			</td>
			</tr>
		</table>
	</div>
	</div></div>
	<div class="clear"></div>
</div>
<? 
if($_SESSION[exptype]!="")
{
   if($_SESSION[exptype]=="expert") 
   { 
	   index_footer_mem_exp();
   }
   if($_SESSION[exptype]=="member")
   {
	   index_footer_member();
   }
}
else
{
	index_footer();
}
?>
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
				minlen = "Please Enter Minimum 6 character!";
			}
			if(obj=="")
			{
				document.getElementById(eid).innerHTML = msg;
				document.getElementById(id).focus();
				return;
			}     
			 
			if(document.getElementById(id).value.length<6)
			{
				 document.getElementById(eid).innerHTML = minlen;
				 document.getElementById(id).focus();
				 return ;
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
						return ;
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