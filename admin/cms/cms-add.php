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

$query="select * from ".$tblpref."content_master where cms_id='$id'"; 
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
$row_add=mysql_fetch_array($result);

admin_header("../../","CMS Management");
admin_nav("../../");
?>
<script type="text/javascript" src="../../cal_js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../cal_js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<script type="text/javascript">	
	$(function(){
		  $('#datepicker').daterangepicker({
			posX: 420,
			posY: 240
		  }); 
	 });
</script>

<SCRIPT LANGUAGE="JavaScript">
function validate()
{
	 var error = true;
		
		if (document.frmcmsadd.name.value=="")
		{ 
  			document.getElementById('ename').innerHTML = "Please Enter Page Name !";
		  	document.frmcmsadd.name.focus();
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
function check(val)
{	
	if(val=="cms")
	{
		// document.getElementById("check1").style.display ="block";
		 document.getElementById("title").style.display ="block";
		 document.getElementById("check2").style.display="none";
	}
	else
	{
		 //document.getElementById("check1").style.display="none";
		 document.getElementById("title").style.display ="none";
		 document.getElementById("check2").style.display="block";
	}
}
</SCRIPT>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	<tr><td align="center" ><h2>CMS</h2></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><th>
			<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%">
			<FORM NAME="frmcmsadd" METHOD="POST" onsubmit="return validate();" ACTION="submit-cms.php" enctype="multipart/form-data">
			<tr><th colspan="2" align="center">
			<?if($id!=""){?>Edit<?}else{?>Add New<?}?></th>
			</td></tr>
            <TR>
			<TD align="right" class="tbborder">Choose Parent : </TD>
			 <TD align="left" style="padding-left:5px;" class="tbborder">
             	<select name="parent" style="width:400px;">
				<option value="">---Please Select Parent---</option>
                <option value="Parent" <? if($parentid=="") { ?> selected <? } ?>>Add New</option>
					<?
					$count=1;
					$coursequery="select * from ".$tblpref."content_master WHERE cms_parent = '' ORDER BY cms_id";
					if(!($courseresult=mysql_query($coursequery))){echo mysql_error($coursequery); exit;}
					while($course_row=mysql_fetch_array($courseresult)) {
					?>
					<option value="<?="child_".$course_row[cms_id]?>" <?php if($course_row[cms_id]==$parentid){?>selected <?}?>><?="$count ".$course_row[cms_title]?></option>
					<?
					$count1=1;
					$parentquery="select * from ".$tblpref."content_master WHERE cms_parent = '$course_row[cms_id]'";
					if(!($parentresult=mysql_query($parentquery))){echo mysql_error($parentquery); exit;}
					$num = mysql_num_rows($parentresult);
					while($parent_row=mysql_fetch_array($parentresult)) {
					?>
                	<option value="<?="subchild_".$parent_row[cms_id]?>" <?php if($parent_row[cms_id]==$parentid){?>selected <?}?>><?="&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1 ".$parent_row[cms_title]?></option>
   					
					<? $count1++;} ?>
					<? $count++;} ?>
                	                   
                  </select>
			</td>
			</TR>	
            
			<tr>
		    <TD align="right" class="tbborder" >Page Name :<FONT COLOR="#FF0000">*</FONT></TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="name" id="name" maxLength="255" size="50" value="<?=$row_add[cms_title]?>" onchange="empty(this.id);">
			<br><label id='ename' class='warning'></label></TD>
			</TR>
		
			<?if($mode!="add"){?>
			<tr>
		    <td align="right" class="tbborder" >Last Update Date :<FONT COLOR="#FF0000">*</FONT></TD>
			<td align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="text" NAME="date" maxLength="255" size="50" id="datepicker" value="<?=dateformate($row_add[cms_date]);?>" readonly></TD>
			</TR>
			<?}?>
			
           	<tr>
			<td align="right" width="22%" class="tbborder" style="border-right:1px solid #abd4e7;">Description :</td>
			<td align="left" style="padding-left:5px;" class="tbborder">
			<?php
					$oFCKeditor = new FCKeditor('linkcontect') ;
					$oFCKeditor->BasePath = '../../common/fckeditor/';
					//$oFCKeditor->ToolbarSet = "Standard";
					$oFCKeditor->Value = stripslashes($row_add[cms_desc]);
					$oFCKeditor->Width  = '550' ;
					$oFCKeditor->Height = '450' ;
					$oFCKeditor->Create() ;
			?>
            </td></tr>													  	
		<tr>
		<td align="center" colspan="2" class="tbborder">
		<input type="hidden" value="add" name="txtmode">
		<input type="hidden" value="<?=$id?>" name="id">
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
</TD>
</TR>
</table>
<?admin_footer("../../");?>