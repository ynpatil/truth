<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$querymem="select * from ".$tblpref."member_reg where mem_id='$_SESSION[mem_id]'"; 
	if(!($resultmem=mysql_query($querymem))){ echo $querymem.mysql_error(); exit;}
	$row_member=mysql_fetch_array($resultmem);

	index_header('My Member Page');
?>
<div id="expertpanel">
	<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo; My Page 
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>My Page </h2>
					<div style="padding-top:10px;">
					<!--  -->
					<? if($flag=="update"){ ?><h4> Your have Successfully updated the your Profile</h4> <? } ?>
					<? if($flag=="succ") { ?><h4> You have successfully registered with us</h4> <? } ?>
					<? if($flag=="") { ?>
					<h4>Welcome <? echo $row_member[mem_first_name]." ".$row_member[mem_sur_name]; ?></h4>
					
					<h4> You are the Active member of Truth-Junction !!!!</h4>
					<? } ?>
					<!--  -->
					</div>
				</div>
			<div class="clear"></div>
			</div>
			</td>
			</tr>
		</table>
	</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php index_footer_member(); ?>
