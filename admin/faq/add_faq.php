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
admin_header("../../","FAQ Management");	
admin_nav("../../");

$query="select * from ".$tblpref."content_master where cms_id='$faqid' ";
if(!($result=mysql_query($query))){echo mysql_error($query); exit;}
$row_add=mysql_fetch_array($result);
?>

<script type="text/javascript" src="../../cal_js/daterangepicker1.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker1.css" type="text/css" />
<script type="text/javascript">	
	$(function(){
		  $('#txtdate').daterangepicker({
			posX: null,
			posY: null
		  }); 
	 });
</script>
		
		<!-- from here down, demo-related styles and scripts -->
<style type="text/css">
	body { font-size: 62.5%; }
	
</style>

<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td>&nbsp;</td></tr>
	<tr><td align="center"><b><h2>FAQ Management</h2></b></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><td>
			<table width="80%" style="border-collapse: collapse" bordercolor="#ABD4E7" border="1" cellspacing="0" cellpadding="3" align="center">
			<form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_faq.php">
			<tr><th colspan="2" align="center" ><b>&nbsp;<?php if($mode=="add"){?>Add New FAQ<?php }else{?>Edit FAQ <?php }?></b>
			</td></tr>
         
			<tr>
		    <td align="right" class="body">Question&nbsp;:<font color="red">*</font></td>
			<td align="left" style="padding-left:5px;"><input type="text" name="txtname"  id="txtname" maxlength="255" size="50" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">
			<br><label id='etxtname' class='warning'></label></td>
			</tr>
            <?php if($faqid!="")
			{
				$txtdate=dateformate($row_add[cms_date]);
			}?>

            <tr>
			  <td align="right" class="body">Answer :</FONT></td>
			  <td align="left" style="padding-left:5px;">
			  <?php 
								$oFCKeditor = new FCKeditor('linkcontect') ;
								$oFCKeditor->BasePath = '../../common/fckeditor/';
								//$oFCKeditor->ToolbarSet = "Standard";
								$oFCKeditor->Value = stripslashes($row_add[cms_desc]);
								$oFCKeditor->Width  = '550' ;
								$oFCKeditor->Height = '450' ;
								$oFCKeditor->Create() ;
								?></td>
			  
		    </tr>						  	
		<tr>
		<td align="center" colspan="2"><?php if($mode=="add"){// mode and id are in hidden field to be posted in submit page
		?><input type="hidden" value="add" name="txtmode" >
		<?php }else{?>
		<input type="hidden" value="edit" name="txtmode" ><input type="hidden" value="<?php  echo $faqid?>" name="txtid" ><?php }?>
		<input type="hidden" value="<?php  echo $status?>" name="status" >
		<input type="submit" value="Submit" name="submit" class="mybutton">&nbsp;&nbsp;</td>

		</tr>
		
		</form>
		</table>

</TD>
</TR>
</table>

</TD>
</TR>
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
		
		var warning = true;
		if (document.frmcmsadd.txtname.value=="")
		 { 
  			document.getElementById('etxtname').innerHTML = "Please Enter Question!";
		  	document.frmcmsadd.txtname.focus();
			warning =  false;
		 }
		 
		if (warning != true)
		{
			return false;
		}
		
}
</script>

<?php admin_footer("../../")?>