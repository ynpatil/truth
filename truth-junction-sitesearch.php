<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_title like '%$txtsearch%' OR cms_desc like '%$txtsearch%'";
	$result2 = mysql_query($query);
	$num2 = mysql_num_rows($result2);


	if(strtolower($txtsearch)=="home")
	{
		header("Location:index.php");
		exit;
	}

	if(strtolower($txtsearch)=="contact us")
	{
		header("Location:truth-junction-contactus.php");
		exit;
	}


	index_header('Site Search');
?>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo; Site Search
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Site Search</h2>
					<div style="padding-top:10px;">
					<? if($num3>0 || $num2>0 || $num4>0) { ?>
		 
		  <?php while($row = mysql_fetch_object($result2)) { ?>
		   <table width="100%" border="0" cellspacing="0" cellpadding="5">
		  <tr>
			<td class="middle_text_bold" style="padding:10px;"><strong><?php echo $row->cms_title;?></strong></td>
		  </tr>
			<tr>
			<td class="middle_text" style="padding:10px;">
			<?  
				$desc = $row->cms_desc;
				$pos = 0;$getstr = "";
				$strings=strip_tags($desc);
				$pos=strpos($strings, $txtsearch);
				if($pos!=0 && ($pos-30)>=0)
				{
					$posfirst=$pos-30;
				}
				else
				{
					$posfirst=$pos;
				}
				$posend=300;
				$getstr=substr($strings,$posfirst,$posend);
				echo str_replace($txtsearch,"<b>$txtsearch</b>",$getstr);
			?>
			<span class="more_text">
			</td></tr>
				
		<tr><td style="padding-left:12px;"><a href="<? echo $row->cms_sitelink."?cid=".$row->cms_id; ?>" title="<?=$row->cms_title?>" target="_self" class="readmore">More...</a></span>
		</td>
		</tr>
		</table>


		
  
		<? } }   ?>
		
				<table width="100%">

				<tr>
				<td>
				<? 
				$queexp="SELECT exps_name FROM ".$tblpref."expert_servies WHERE exps_name like '%$txtsearch%' AND exps_status='Active'";
				if (!($expresult = mysql_query($queexp))) { echo "FOR QUERY: $queexp<BR>".mysql_error();exit();}
				$row1 = mysql_fetch_array($expresult);
				$numrow = mysql_num_rows($expresult);
				
				if($numrow>0)
				{
				?>
				<strong>Services : </strong><? echo $row1[exps_name]; ?> 
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a <? if($_SESSION[mem_id]=="") { ?> href="#" onclick="errmsg();" <? } 
				else { ?>href="truth-junction-services.php" <? } ?>>Read More</a>
				<? } ?>
				</td></tr>
			
				</table>        
		
		

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