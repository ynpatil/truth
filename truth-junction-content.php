<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$query="select * from ".$tblpref."content_master where cms_id='$_GET[cid]'";
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	$row_cms=mysql_fetch_object($result);
	
	index_header($row_cms->cms_title);
?>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo;
	<? if($row_cms->cms_parent!=""){ 
	$queryparent="select * from ".$tblpref."content_master where cms_id='$row_cms->cms_parent'";
	if(!($resultparent=mysql_query($queryparent))){ echo $queryparent.mysql_error(); exit;}
	$row_parent=mysql_fetch_object($resultparent);
	?>
	<a href="truth-junction-content.php?cid=<? echo $row_parent->cms_id;?>">
	<strong><? echo $row_parent->cms_title;?></strong></a>&nbsp;&raquo; <? } echo $row_cms->cms_title;?>
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2><?=$row_cms->cms_title?></h2>
					<div style="padding-top:10px;">
					<?=$row_cms->cms_desc?>
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