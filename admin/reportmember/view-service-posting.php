<?php
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

$query="SELECT * FROM  ".$tblpref."expert_servies WHERE exps_id='$serviceid'";
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
$row_add=mysql_fetch_array($result);

?>
<html>
<body>
<table cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" valign="top" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Services Posting Management</h2></b></td></tr>
	<tr><td>
			<TABLE width="100%" style="border-collapse: collapse" border="1" bordercolor="#D0D0D0" cellspacing="0" cellpadding="3" align="center">
		
			<tr><th colspan="2" align="center" >View Services Posting</th>
			</td></tr>

			<TR>
			<TD align="right" width="30%">Services Name :</TD>
			<TD align="left" style="padding-left:5px;"><?=$row_add[exps_name]?></TD>
			</TR>
			<TR>
			<TD align="right" width="30%">Posted on :</TD>
			<TD align="left" style="padding-left:5px;">
			<? $txtdate = explode(" ",$row_add[exps_date]);
				echo dateformate($txtdate[0])." ".$txtdate[1];
			?>
			</TD>
			</TR>

			<TR>
			<TD align="right" width="30%" valign="top">Description :</TD>
			<TD align="left" style="padding-left:5px;" valign="top"><?=$row_add[exps_desc]?></TD>
			</TR>

			<TR>
			<TD align="right" width="30%" valign="top">Uploaded Image-I:</TD>
			<TD align="left" style="padding-left:5px;" valign="top">
			<? if($row_add[exps_image_one]!="") {?>
			<img src="../../tjtmp/<?=$row_add[exps_image_one]?>" alt="" height="100" width="160">
			<? } else { ?>
			<img src="../../tjtmp/no-img.jpg" alt="" height="100" width="160">
			<? } ?>
			</TD>
			</TR>
			
			<TR>
			<TD align="right" width="30%" valign="top">Uploaded Image-II:</TD>
			<TD align="left" style="padding-left:5px;" valign="top">
			<? if($row_add[exps_image_two]!="") {?>
			<img src="../../tjtmp/<?=$row_add[exps_image_two]?>" alt="" height="100" width="160">
			<? } else { ?>
			<img src="../../tjtmp/no-img.jpg" alt="" height="100" width="160">
			<? } ?>
			</TD>
			</TD>
			</TR>

			<tr>
			<td align="center" colspan="2">
			<input type="hidden" value="add" name="txtmode" >
			<input type="hidden" value="<?=$row_add[cat_id]?>" name="id" >
			<INPUT TYPE="button" value="Close" Name="Close" class="mybutton" onclick="javascript:history.back();">&nbsp;&nbsp;</td>
			</tr>
		</form>
		</table>

</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>