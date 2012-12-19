<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$query="select * from ".$tblpref."content_master where cms_id='4'";
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	$row_cms=mysql_fetch_object($result);
	
	index_header($row_cms->cms_title);
?>
<script type="text/javascript" src="js/contact.js"></script>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo; Contact Us
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Contact Us</h2>

				<div style="padding-top:10px;">
							<? echo $row_cms->cms_desc;?>
				</div>
				<div class="done">
				<b>Thank you !</b> We will contact you soon.
				</div>
				<div id="contactform" class="form">
				<form id="contactus" action="#">
				<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
				<td colspan='2' align='left'>&nbsp;</td>
				</tr>
				<tr>
				<td colspan='2' align='left'><h2>Feedback Form</h2></td>
				</tr>
				<tr>
				<td colspan='2' align='left' >&nbsp;</td>
				</tr>
				<tr class="trcolor">
				<td align="right" valign="top" class="text12">Name of Sender<span class="style1">*</span></td>
				<td align="left" valign="top"><div class="txtbox"><input type="text" name="sname" id="sname" value="" onblur="empty(this.id);"  /></div><div class="err"><img id="ename" src = "" class="none" alt="" /></div>
				</td>
				</tr>
				<tr>
				<td align="right" valign="top" class="text12">Company of Sender </td>
				<td align="left" valign="top"><div class="txtbox"><input type="text" name="company" value="" /></div></td>
				</tr>
				<tr class="trcolor">
				<td align="right" valign="top" class="text12">Telephone No <span class="style1">*</span></td>
				<td align="left" valign="top"><div class="txtbox"><input type="text" name="tel" id="tel" value="" onblur="empty(this.id);" /></div><div class="err"><img id="etel" src = "" class="none" alt="" /></div>
				</td>
				</tr>
				<tr>
				<td align="right" valign="top" class="text12">Fax No </td>
				<td><div class="txtbox"><input type="text" name="fax" value="" /> </div></td>
				</tr>
				<tr class="trcolor">
				<td align="right" valign="top" class="text12">Email <span class="style1">*</span></td>
				<td align="left" valign="top"><div class="txtbox"><input type="text" name="email" id="email" value="" onblur="empty(this.id);" /></div><div class="err"><img id="eemail" src = "" class="none" alt="" /></div></td>
				</tr>
				<tr>
				<td align="right" valign="top" class="text12">Subject <span class="style1">*</span></td>
				<td align="left" valign="top"><div class="txtbox"><input type="text" name="subject" id="subject" value="" onblur="empty(this.id);" /></div><div class="err"><img id="esubject" src = "" class="none" alt="" /></div></td>
				</tr>
				<tr class="trcolor">
				<td align="right" valign="top" class="text12">Message <span class="style1">*</span></td>
				<td align="left" valign="top"><div class="txtbox"><textarea rows="6" cols="30" name="message" id="message" onblur="empty(this.id);"></textarea></div><div class="err"><img id="emessage" src = "" class="none" alt="" /></div></td>
				</tr>
				<tr>
				<td align="right" class="text12" valign="top">Enter given code <span class="style1">*</span></td>
				<td align="left" class="left5"><div class="txtbox"><input type="text" name="captcha" id="captcha" value="" onblur="empty(this.id);" /></div><div class="err"><img id="ecaptcha" src = "" class="none" alt="" /></div></td>
				</tr>
				<tr class="trcolor">
				<td align="right" valign="top" class="text12">&nbsp;</td>
				<td align="left" class="left5 txtbox" style="padding-left:14px;"><img src="common/antispamex01.php" alt="varification code" /></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td align="left" class="txtbox" style="padding-left:15px;"><div class="loading"></div>
				<div class="buttondiv" ><br/>
				<input type="image" src="images/btn-submit.jpg" border="0" name="submit" id="submit"/>
				<span id="msgbox" class="none"></span>
				</div>
				</td>
				</tr>    
				</table>
				</form>  
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