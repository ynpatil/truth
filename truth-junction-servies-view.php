<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");

	$queservices="SELECT * FROM ".$tblpref."expert_servies WHERE exps_id='$serviceid'";
	if (!($servresult = mysql_query($queservices))) { echo "FOR QUERY: $queservices<BR>".mysql_error();exit;}
	$rowserv = mysql_fetch_array($servresult);

	index_header("Services");
?>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo;	
	<a href="truth-junction-services.php"><strong>Services</strong></a>&nbsp;&raquo; 
	<?
		$queexp="SELECT * FROM ".$tblpref."expert WHERE exp_id='$rowserv[exps_expert_id]'";
		if (!($expresult = mysql_query($queexp))) { echo "FOR QUERY: $queexp<BR>".mysql_error();exit;}
		$rowexp = mysql_fetch_array($expresult);

		$quecat="SELECT * FROM ".$tblpref."services_category WHERE cat_id='$rowexp[exp_service_area_id]'";
		if (!($saresult = mysql_query($quecat))) { echo "FOR QUERY: $quecat<BR>".mysql_error();exit;}
		$rowsa = mysql_fetch_array($saresult);
		echo $rowsa[cat_name];
	?>
	&nbsp;&raquo; 
	<?=$rowexp[exp_person_name]?>&nbsp;&raquo; <?=$rowserv[exps_name]?>
	
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2><?=$rowserv[exps_name]?></h2>
					<div style="padding-top:10px;">
					
					<table width="100%">
					<tr><td  valign="top" colspan="2">
					<iframe name="scroller" scrolling=no  frameborder=no src="scroller.php?serid=<?=$serviceid?>" width="700" height="100" valign="middle" ></iframe></td></tr>

					<tr><td colspan="2">&nbsp;</td></tr>
					<tr><td width="14%" valign="top"><strong>Posting Date :</strong></td>
					<td align="left">
					<?  
						$serv = explode(" ",$rowserv[exps_date]);
						echo dateformate1($serv[0])." ";
						echo $serv[1];
					?>
					</td></tr>
					<tr><td colspan="2" style="padding-top:20px;"><?=$rowserv[exps_desc]?></td></tr>
					</table>
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