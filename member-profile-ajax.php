<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$query="select * from ".$tblpref."member_reg where mem_id='$_SESSION[mem_id]'"; 
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	$row_add=mysql_fetch_array($result);
?>

<div id="expertpanel">
	<div class="head-title-bg">
		<div class="crumb">
		<a href="truth-junction-member-index.php"><strong>My Page</strong></a>&nbsp;&raquo; Update Profile
		</div>
	</div>
<div style="width:696px;">
<!--  -->
<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">

			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Update Profile</h2>
					<div style="padding-top:10px;">
					<form action="submit-member-regist.php" Method="POST" name="frmregistration" enctype="multipart/form-data" onsubmit="return validatereg();">

					<table width="100%" style="padding-left:20px;">
					<? if($flag=="succ") { ?>
					<tr>
					<td class="warning" colspan="2">Your Account has been created</td>
					</tr>
					<? } ?>
					<tr><td colspan="2"><h4>Your Personal Details</h4></td></tr>
					<tr>
						<td colspan="2">
						<table width="70%" style="border:#A2A2A2 solid 1px; margin:20px; padding:10px;">
					<tr>
						<td width="40%">Title : </td><td>
						<select name="ddtitle" id="ddtitle" class="inpt-txt" onchange="titlegender(this.id); empty(this.id);">
						<option value="Mr" <?if($row_add[mem_title]=="Mr"){?> selected <? } ?>>Mr.</option>
						<option value="Mrs" <?if($row_add[mem_title]=="Mrs"){?> selected <? } ?>>Mrs.</option>
						<option value="Miss" <?if($row_add[mem_title]=="Miss"){?> selected <? } ?>>Miss.</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>First Name : <FONT COLOR="#FF0000">*</FONT></td>
						<td><input type="text" name="txtfname" id="txtfname" value="<?=$row_add[mem_first_name]?>" class="regist" onchange="empty(this.id);">
						<br><label id='etxtfname' class='warning'></label></td>
					</tr>
					<tr>
						<td>Surname : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="text" name="txtsname" id="txtsname" value="<?=$row_add[mem_sur_name]?>" class="regist" onchange="empty(this.id);">
						<br><label id='etxtsname' class='warning'></label></td>
					</tr>
					<tr>
						<td valign="top">Gender : </td>
						<td>
						<table>
						<tr>
						<td align="left">
						<input type="radio" name="radgender" id="radmale" value="Male" <?if($row_add[mem_gender]=="Male"){?> checked <? } ?>>&nbsp;Male
						&nbsp;&nbsp;&nbsp;<input type="radio" name="radgender" id="radfemale" value="Female" <?if($row_add[mem_gender]=="Female"){?> checked <? } ?>>&nbsp;Female
						</td>
						<td width="30%">&nbsp;</td>
						</tr>
						</table>
						</td>
					</tr>
					
					<tr>
						<td>Date Of Birth : <FONT COLOR="#FF0000">*</FONT></td>
						<td>
						<? $dob = explode("-",$row_add[mem_dob])?>
						<table width="50%" style="border:#A2A2A2 solid 1px; margin:0px; padding:10px;">
						<tr><td>Month</td><td>Day</td><td>Year</td></tr>
						<tr>
						<td>
						<select name="txtmonth" id="txtmonth" onchange="functdob();">
						<option value="">Month</option>
						<option value="01" <? if($dob[1]=="01"){?> selected <? } ?>>January</option>
						<option value="02" <? if($dob[1]=="02"){?> selected <? } ?>>February</option>
						<option value="03" <? if($dob[1]=="03"){?> selected <? } ?>>March</option>
						<option value="04" <? if($dob[1]=="04"){?> selected <? } ?>>April</option>
						<option value="05" <? if($dob[1]=="05"){?> selected <? } ?>>May</option>
						<option value="06" <? if($dob[1]=="06"){?> selected <? } ?>>June</option>
						<option value="07" <? if($dob[1]=="07"){?> selected <? } ?>>July</option>
						<option value="08" <? if($dob[1]=="08"){?> selected <? } ?>>August</option>
						<option value="09" <? if($dob[1]=="09"){?> selected <? } ?>>September</option>
						<option value="10" <? if($dob[1]=="10"){?> selected <? } ?>>October</option>
						<option value="11" <? if($dob[1]=="11"){?> selected <? } ?>>November</option>
						<option value="12" <? if($dob[1]=="12"){?> selected <? } ?>>December</option>
						</select>
						</td>
						<td>
						<select name="txtday" id="txtday" onchange="functdob();">
						<option value="">Day</option>
						<? $day = 1; 
						while($day <= 31){ ?>
						<option value="<?=$day?>" <? if($dob[2]==$day){?> selected <? } ?>><?=$day?></option>
						<? $day++; } ?>
						</select>
						</td>
						<td>
						<select name="txtyear" id="txtyear" onchange="functdob();">
						<option value="">Year</option>
						<? $year = 2020; 
						while($year >= 1900){ ?>
						<option value="<?=$year?>" <? if($dob[0]==$year){?> selected <? } ?> ><?=$year?></option>
						<? $year--; } ?>
						</select>						
						</td></tr>
						<tr><td colspan="3"><label id='etxtmonth' class='warning'></label></td></tr>
						</table>
						</td>
					</tr>
					<tr>
						<td>Postal address : <FONT COLOR="#FF0000">*</FONT></td><td>
						<textarea name="txtpaddress" id="txtpaddress" rows="6" cols="20" onchange="empty(this.id);"><?=$row_add[mem_address]?></textarea>
						<br><label id='etxtpaddress' class='warning'></label></td>
					</tr>

					<tr>
						<td>Phone No. : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="text" name="txtphone" id="txtphone" value="<?=$row_add[mem_phone]?>" class="regist" onchange="empty(this.id);">
						<br><label id='etxtphone' class='warning'></label></td>
					</tr>

					<tr>
						<td>Cell No. : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="text" name="txtcel" id="txtcel" value="<?=$row_add[mem_cel]?>" class="regist" onchange="empty(this.id);">
						<br><label id='etxtcel' class='warning'></label></td>
					</tr>

					<tr>
						<td>Upload Photo : </td><td>
						<input type="file" name="upload" id="upload" class="inpt-txt">
						<? if($row_add[mem_upload]!=""){ ?>						
						<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
						<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.1.js"></script>
						<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.1.css" media="screen" />

						<script type="text/javascript">
						$(document).ready(function() {
							$("a#example2").fancybox({
								'titleShow'		: true,
								'transitionIn'	: 'elastic',
								'transitionOut'	: 'elastic'
							});

						});
						</script>
						<a id="example2" href="tjtmp/<?php echo $row_add['mem_upload']; ?>"><img src="tjtmp/<?php echo $row_add['mem_upload']; ?>" border="0" height="25" width="25" /></a>  <span class="style1">Click on Image for Preview</span>
						<? } ?>
						</td>
					</tr>
					</table>
					</td>
					</tr>
					<tr><td colspan="2"><h4>Access Details</h4></td></tr>
					<tr>
					<td colspan="2">
					<table width="70%" style="border:#A2A2A2 solid 1px; margin:20px; padding:10px;">
					<tr>
						<td width="40%">Email Address : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="text" name="email" id="email" class="regist" onblur="validateemail(this.value,this.id);" value="<?=$row_add[mem_email]?>">
						<input type="hidden" id="ajxemail" value=""><br><label id='eemail' class='warning'></label></td>
					</tr>

					<tr>
						<td>Confirm Email Address : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="text" name="cemail" id="cemail" class="regist" onblur="validateemail1(this.value,this.id);" value="<?=$row_add[mem_email]?>">
						<br><label id='ecemail' class='warning'></label></td>
					</tr>

					<tr>
						<td>Password : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="password" name="password" id="password" class="regist" onchange="empty(this.id);" value="<?=$row_add[mem_password]?>">
						<br><label id='epassword' class='warning'></label></td>
					</tr>

					<tr>
						<td>Re-Enter Password : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="password" name="rpassword" id="rpassword" class="regist" onblur="validatpass(this.value,this.id);" value="<?=$row_add[mem_password]?>">
						<br><label id='erpassword' class='warning'></label></td>
					</tr>

					<tr>
						<td>Secrete Question : <FONT COLOR="#FF0000">*</FONT></td>
						<td>
						<select name="squest" id="squest" class="regist" onchange="empty(this.id);" style="width:146px;">
						  <option value="">Choose a question ...</option>
						  <option value="What is the name of your best friend from childhood?"
						  <?if($row_add[mem_squest]=="What is the name of your best friend from childhood?"){?> selected <? } ?>>What is the name of your best friend from childhood?</option>
						  <option value="What was the name of your first teacher?"
						  <?if($row_add[mem_squest]=="What was the name of your first teacher?"){?> selected <? } ?>>What was the name of your first teacher?</option>
						  <option value="What is the name of your manager at your first job?" <?if($row_add[mem_squest]=="What is the name of your manager at your first job?"){?> selected <? } ?>>What is the name of your manager at your first job?</option>
						  <option value="What was your first phone number?" 
						  <?if($row_add[mem_squest]=="What was your first phone number?"){?> selected <? } ?>>What was your first phone number?</option>
						  <option value="What is your vehicle registration number?" <?if($row_add[mem_squest]=="What is your vehicle registration number?"){ ?>selected<? } ?>>What is your vehicle registration number?</option>
						</select>
						<br><label id='esquest' class='warning'></label></td>
					</tr>

					<tr>
						<td>Answer : <FONT COLOR="#FF0000">*</FONT></td><td>
						<input type="text" name="answer" id="answer" class="regist" value="<?=$row_add[mem_answer]?>" onchange="empty(this.id);">
						<br><label id='eanswer' class='warning'></label></td>
					</tr>
					</table>
					</td>
					</tr>

					<tr><td colspan="2"><h4>Referrer's Details</h4></td></tr>
					<tr>
						<td colspan="2">
						<table width="70%" style="border:#A2A2A2 solid 1px; margin:20px; padding:10px;">
					<tr>
						<td width="40%">Keyword Member Search : </td><td>
						<input type="text" name="kmem" id="kmem" class="regist"  value="<?=$row_add[mem_keymem]?>" readonly>
						<br><label id='ekmem' class='warning' ></label></td>
					</tr>

					<tr>
						<td>Referrer's Name : </td>
						<td style="padding-top:25px;">
						<div id="ref">
						<select name="refname" id="refname" class="regist" onchange="changeref(this.value);">
						<? if($row_add[mem_refname]==1){ ?>
						<option value="1" selected>Truth-Junction</option>
						<? } else {
						$queryref="select mem_first_name,mem_sur_name from ".$tblpref."member_reg where mem_id='$row_add[mem_refname]'"; 
						if(!($resref=mysql_query($queryref))){ echo $queryref.mysql_error(); exit;}
						$row=mysql_fetch_array($resref);
						?>
						<option value="<?=$row_add[mem_refname]?>" selected><? echo $row[mem_first_name]." ".$row[mem_sur_name];?></option>
						<? } ?>
						</select>
						</div>
						<input type="hidden" id="refid" name="refid" value="<?=$row_add[mem_refname]?>">
						<br><label id='erefname' style="color:#A2A2A2; font-weight:bold;">"If you do not have a referrer use Truth Junction as referrer"</label></td>
					</tr>
					</table>
					</td>
					</tr>

					<tr><td colspan="2"><h4>Account Details in which you want to receive commissions</h4></td></tr>

					<tr><td colspan="2" style="color:#A2A2A2; font-weight:bold;">'Please contact on following contact details to update your account details'</td></tr>

					<tr>
						<td colspan="2">
						<table width="70%" style="border:#A2A2A2 solid 1px; margin:20px; padding:10px;">
						<tr>
						<td width="35%">Account Name :</td><td><?=$row_add[mem_AccountName]?></td>
						</tr>
						<tr>
						<td>Account Number :</td><td><?=$row_add[mem_AccountNo]?></td>
						</tr>
						<tr>
						<td>Bank Name :</td><td><?=$row_add[mem_BankName]?></td>
						</tr>

						<tr>
						<td>Bank Code :</td><td><?=$row_add[mem_Bankcode]?></td>
						</tr>

						<tr>
						<td>Branch Name :</td><td><?=$row_add[mem_BranchName]?></td>
						</tr>

						<tr>
						<td>Branch Code :</td><td><?=$row_add[mem_BranchCode]?></td>
						</tr>

						</table>
						</td>
					</tr>

					<tr><td colspan="2"><h4>Payment</h4></td></tr>
					<?
					$txtdate = date("Y-m-d h:i:s");
					$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date <= '$txtdate' ORDER BY subfee_id DESC"; 
					if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit;}
					$rowsubfee = mysql_fetch_array($resubfee);
					?>
					<tr>
						<td colspan="2">
						<table width="70%" style="border:#A2A2A2 solid 1px; margin:20px; padding:10px;">
					<tr>
						<td>Contact SMS : </td>
						<td><input type="checkbox" name="chkcontactsms" value="yes"  onchange="chechsms('<?=$rowsubfee[subfee_contactfee]?>','<?=$rowsubfee[subfee_subfees]?>');"  <?if($row_add[mem_contactfee]=="yes"){?> checked <? } ?>>
						<label style="color:#A2A2A2; font-weight:bold;">Note : In Contact SMS fees is P <?=$rowsubfee[subfee_contactfee]?> per month</label></td>
					</tr>
					<tr><td colspan="2" class="warning">&nbsp;</td></tr>
					<tr><td colspan="2" style="color:#A2A2A2; font-weight:bold;">Your Subscription fees is P  <?=$rowsubfee[subfee_subfees]?></td></tr>
					<tr><td colspan="2"  style="color:#A2A2A2; font-weight:bold;"><div id="showhide" style="display:<? if($row_add[mem_contactfee]=="yes") { ?>block<? } else { ?>none<? } ?>;">Your In Contact SMS fee is P <?=$rowsubfee[subfee_contactfee]?></div></td></tr>
					<tr><td colspan="2" class="warning">Total Fees is P <span id="totalpay">
					<?if($row_add[mem_contactfee]=="yes"){
					echo $total = $rowsubfee[subfee_contactfee] + $rowsubfee[subfee_subfees];
					} else { echo $total = $rowsubfee[subfee_subfees]; } ?>
					</span></td></tr>

					<tr><td colspan="2">
					<input type="hidden" name="memid" id="memid" value="<? echo $_SESSION[mem_id] ?>">
					<input type="hidden" name="totpayment" id="totpayment" value="<? echo $total ?>">
					<input style="background:#FCA108; float:right; color:white; border:1px #FCA108 solid;" type="submit" name="submit" value="Update Profile">
					</td></tr>
					</table>
					</td>
					</tr>
					</table>
					</form>
					<!--  -->
					</div>
				</div>
			<div class="clear"></div>
			</div>
			</td>
			</tr>
		</table>
<!--  -->
</div></div>
<script language="javascript">
empty = function (id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	
	if (id == "txtphone")
	{
			var msg= "";
			var altmsg="";
				if (id == "txtphone")
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

	if (id == "txtcel")
	{
			var msg= "";
			var altmsg="";
				if (id == "txtcel")
				{
					msg = "Please Enter Phone Number!";
					altmsg = "Please Enter Valid Cell Number!";
					minlen = "Please Enter Minimum 6 Cell Number!";
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
			document.frmregistration.email.focus();
		}
		else if(obj != "")
		{	
			var email	= document.frmregistration.email.value;
			if(email != "")
			{	
				if(email.indexOf("@")==-1 || email.indexOf(".")==-1 || email.indexOf(" ")!=-1)
				{
					document.getElementById('eemail').innerHTML = "Invalid Email ID!";
					document.frmregistration.email.focus();
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


	if (id == "password")
	{
			var msg= "";
			var altmsg="";
			if (id == "password")
			{
				msg = "Please Enter Password!";
				minlen = "Please Enter Alteast 8 letter!";
			}

			if(obj=="")
			{
				document.getElementById(eid).innerHTML = msg;
				document.getElementById(id).focus();
				return;
			}     
			else
			{
				if(document.getElementById(id).value.length<8)
				{
					 document.getElementById(eid).innerHTML = minlen;
					 document.getElementById(id).focus();
					 return ;
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
function validatereg()
{

	var warning = true;

	if (document.frmregistration.txtfname.value=="")
	{ 
  		document.getElementById('etxtfname').innerHTML = "Please Enter The first name";
		document.frmregistration.txtfname.focus();
		warning =  false;
	}

	if (document.frmregistration.txtsname.value=="")
	{ 
  		document.getElementById('etxtsname').innerHTML = "Please Enter The Surname";
		document.frmregistration.txtsname.focus();
		warning =  false;
	}

	if (document.frmregistration.txtmonth.value=="" || document.frmregistration.txtday.value=="" || document.frmregistration.txtyear.value=="")
	{ 
  		document.getElementById('etxtmonth').innerHTML = "Please Enter The Date Of Birth";
		document.frmregistration.txtmonth.focus();
		warning =  false;
	}


	if (document.frmregistration.txtpaddress.value=="")
	{ 
  		document.getElementById('etxtpaddress').innerHTML = "Please Enter the Postal Address";
		document.frmregistration.txtpaddress.focus();
		warning =  false;
	}

	if (document.frmregistration.txtphone.value=="")
	{ 
  		document.getElementById('etxtphone').innerHTML = "Please Enter the Phone No.";
		document.frmregistration.txtphone.focus();
		warning =  false;
	}

	if (document.frmregistration.txtcel.value=="")
	{ 
  		document.getElementById('etxtcel').innerHTML = "Please Enter the Cell No.";
		document.frmregistration.txtcel.focus();
		warning =  false;
	}

	if (document.frmregistration.email.value=="")
	{ 
  		document.getElementById('eemail').innerHTML = "Please Enter the Email";
		document.frmregistration.email.focus();
		warning =  false;
	}

	if (document.frmregistration.cemail.value=="")
	{ 
  		document.getElementById('ecemail').innerHTML = "Please Enter the Confirm Email";
		document.frmregistration.cemail.focus();
		warning =  false;
	}
	if(document.frmregistration.email.value != document.frmregistration.cemail.value)
	{
  		document.getElementById('ecemail').innerHTML = "Please Enter Correct Confirm Email";
		document.frmregistration.cemail.focus();
		warning =  false;
	}

	if (document.frmregistration.password.value=="")
	{ 
  		document.getElementById('epassword').innerHTML = "Please Enter the Password";
		document.frmregistration.password.focus();
		warning =  false;
	}

	if (document.frmregistration.rpassword.value=="")
	{
  		document.getElementById('erpassword').innerHTML = "Please Enter the Re-Enter password";
		document.frmregistration.rpassword.focus();
		warning =  false;
	}

	if(document.frmregistration.password.value != document.frmregistration.rpassword.value)
	{
  		document.getElementById('erpassword').innerHTML = "Please Enter Correct Confirm Password";
		document.frmregistration.rpassword.focus();
		warning =  false;
	}

	if (document.frmregistration.squest.value=="")
	{
  		document.getElementById('esquest').innerHTML = "Please Select Secrete Question";
		document.frmregistration.squest.focus();
		warning =  false;
	}

	if (document.frmregistration.answer.value=="")
	{
  		document.getElementById('eanswer').innerHTML = "Please Enter the Answer";
		document.frmregistration.answer.focus();
		warning =  false;
	}
	if (document.frmregistration.AccountName.value=="")
	{
  		document.getElementById('eAccountName').innerHTML = "Please Enter the Account Name";
		document.frmregistration.AccountName.focus();
		warning =  false;
	}

	if (document.frmregistration.AccountNo.value=="")
	{
  		document.getElementById('eAccountNo').innerHTML = "Please Enter the Account No.";
		document.frmregistration.AccountNo.focus();
		warning =  false;
	}

	if (document.frmregistration.BankName.value=="")
	{
  		document.getElementById('eBankName').innerHTML = "Please Enter the Bank Name";
		document.frmregistration.BankName.focus();
		warning =  false;
	}

	if (document.frmregistration.Bankcode.value=="")
	{
  		document.getElementById('eBankcode').innerHTML = "Please Enter the Bank code";
		document.frmregistration.Bankcode.focus();
		warning =  false;
	}

	if (document.frmregistration.BranchName.value=="")
	{
  		document.getElementById('eBranchName').innerHTML = "Please Enter the Bank Name";
		document.frmregistration.BranchName.focus();
		warning =  false;
	}
	
	if (document.frmregistration.BranchCode.value=="")
	{
  		document.getElementById('eBranchCode').innerHTML = "Please Enter the Bank Code";
		document.frmregistration.BranchCode.focus();
		warning =  false;
	}

	return warning;
}

function chechsms(contfee , subfee)
{

	if(document.frmregistration.chkcontactsms.checked) 
	{	
		total = parseInt(contfee) + parseInt(subfee);
		document.getElementById("showhide").style.display="block";
	
		document.getElementById("totalpay").innerHTML = total;
		document.getElementById("totpayment").value = total;
	}
	else
	{
		total = parseInt(subfee);
		document.getElementById("showhide").style.display="none";
		
		document.getElementById("totalpay").innerHTML  = total;
		document.getElementById("totpayment").value = total;
	}

}
validateemail1 = function(value,id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	if(document.getElementById('email').value != document.getElementById('cemail').value)
	{
		document.getElementById(eid).innerHTML = "Please Enter the correct Confirm Id";
		return false;	
	}
	else
	{
		document.getElementById(eid).innerHTML = "";
		return;	
	}
		
}
validatpass = function(value,id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	if(document.getElementById('password').value != document.getElementById('rpassword').value)
	{
		document.getElementById(eid).innerHTML = "Please Enter the correct Password";
		return false;	
	}
	else
	{
		document.getElementById(eid).innerHTML = "";
		return;	
	}
		
}

validateemail = function(value,id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	if (id == 'email')
	{
		if (obj == "")
		{
			document.getElementById(eid).innerHTML = "Please Enter Email!";
			document.frmregistration.email.focus();
		}
		else if(obj != "")
		{	
			var email	= document.frmregistration.email.value;
			if(email != "")
			{	
				if(email.indexOf("@")==0 || email.indexOf(".")==0 || email.indexOf("@")==-1 || email.indexOf(".")==-1 || email.indexOf(" ")!=-1)
				{
					document.getElementById('eemail').innerHTML = "Invalid Email ID!";
					document.frmregistration.email.focus();
					return;
				}
				else
				{
					var url;
	url="validatemail.php?value="+value;
											
	var xmlHttp;
	try
	{  
	// Firefox, Opera 8.0+, Safari 
		 xmlHttp=new XMLHttpRequest();  
	}
	catch (e)
	{ 
	 // Internet Explorer  
		try
		{    
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
		}
		catch (e)
		{    
			try
			{     	
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
			}
			 catch (e)
			 {      
				  alert("Your browser does not support AJAX!");
				  return false;  
			 }
		}
	  }
	  xmlHttp.onreadystatechange=function()
	  {
		if(xmlHttp.readyState==4)
		{
			result = xmlHttp.responseText;
			
			if(result!="" && result!=0)
			{
				document.getElementById("eemail").innerHTML="Email Id Already Exist!";
				document.getElementById("ajxemail").value = result;
			}
			else
			{
				document.getElementById("eemail").innerHTML="";
				document.getElementById("ajxemail").value = "";	
			}
		}
	  }
	  xmlHttp.open("Get",url,true);
	  xmlHttp.send(null);	
				}
			}
		}
	}
		
}

valmemref= function(value,id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	
	var url;
	url="valmemref.php?value="+value;
											
	var xmlHttp;
	try
	{  
	// Firefox, Opera 8.0+, Safari 
		 xmlHttp=new XMLHttpRequest();  
	}
	catch (e)
	{ 
	 // Internet Explorer  
		try
		{    
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
		}
		catch (e)
		{    
			try
			{     	
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
			}
			 catch (e)
			 {      
				  alert("Your browser does not support AJAX!");
				  return false;  
			 }
		}
	  }
	  xmlHttp.onreadystatechange=function()
	  {
		if(xmlHttp.readyState==4)
		{
			result = xmlHttp.responseText;
			
			if(result!="" && result!=0)
			{
				document.getElementById("ref").innerHTML = result;
			}
			
		}
	  }
	  xmlHttp.open("Get",url,true);
	  xmlHttp.send(null);	

	
		
}

titlegender = function(id)
{
	var obj = document.getElementById(id).value;

	if(obj=="Mr")
	{
		document.getElementById("radmale").checked = true;
	}

	if(obj=="Mrs" || obj=="Miss")
	{
		document.getElementById("radfemale").checked = true;
	}

}
changeref = function(val)
{
	document.getElementById("refid").value=val;
}

functdob = function()
{
	var now = new Date();

	var today = new Date(now.getFullYear()-18,now.getMonth(),now.getDate());
	
	var objyear = document.getElementById("txtyear").value;
	var objdate = document.getElementById("txtday").value;
	var objmonth = document.getElementById("txtmonth").value;

	var dob = new Date(objyear,objmonth-1,objdate);

	if(dob > today)
	{
		document.getElementById("etxtmonth").innerHTML = "You have to be atleast 18 years to be a member";
		return false;
	}
	else
	{
		document.getElementById("etxtmonth").innerHTML = "";
		return true;
	}
	
}



</script>