<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	index_header("Services");
?>
<link href="css/inettuts.css" rel="stylesheet" type="text/css"/>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo;	Services
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Services</h2>
					<div style="padding-top:10px;">
					<!--  -->
    <div id="columns">
	<?
	$querysa="select * from ".$tblpref."services_category ORDER BY cat_id";
	if(!($resultsa=mysql_query($querysa))){ echo $querysa.mysql_error(); exit;}
	while($rowsa=mysql_fetch_array($resultsa))
	{
	?>
			<ul id="column1" class="column">
              <li class="widget color-orange">
                <div class="widget-head">
                  <span style="color:white; font-weight:bold; font-size:12px; padding-left:10px;"><?=$rowsa[cat_name]?></span>
                </div>
                <div class="widget-content">
				<table width="100%">
				<tr height="30">
				<td><strong>Expert Name</strong></td><td><strong>No. of Posting</strong></td>
				</tr>
				<?
				$queservices="SELECT exp_person_name,exp_id FROM ".$tblpref."expert WHERE exp_service_area_id='$rowsa[cat_id]' AND exp_status='Active'";
				if (!($servresult = mysql_query($queservices))) { echo "FOR QUERY:$queservices<BR>".mysql_error();exit;}
				
				while($rowserv = mysql_fetch_array($servresult))
				{
				?>
				<tr><td><? echo $rowserv[exp_person_name]?></td>
				<td>
				<? 
				$queexp="SELECT exps_id FROM ".$tblpref."expert_servies WHERE exps_expert_id='$rowserv[exp_id]' AND exps_status='Active'";
				if (!($expresult = mysql_query($queexp))) { echo "FOR QUERY: $queexp<BR>".mysql_error();exit();}
				$numrow = mysql_num_rows($expresult);
				
				if($numrow>0)
				{
				?>
				<a href="truth-junction-services-details.php?expid=<?=$rowserv[exp_id]?>&said=<?=$rowsa[cat_name]?>"><? echo $numrow; ?></a>
				<? }
				else
				{
					echo "Yet To Post";
				}
				?>
				</td></tr>
				<? } ?>
				</table>                   
                </div>
            </li>
		</ul>
	<? } ?>

    </div>       
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-personalized-1.6rc2.min.js"></script>
    <script type="text/javascript" src="js/inettuts.js"></script>
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