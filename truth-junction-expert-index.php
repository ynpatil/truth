<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$queryexp="select * from ".$tblpref."expert where exp_id='$_SESSION[exp_id]'"; 
	if(!($resultexp=mysql_query($queryexp))){ echo $queryexp.mysql_error(); exit;}
	$row_expert=mysql_fetch_array($resultexp);

	index_header('My Expert Page');
?>
<div id="expertpanel">
	<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo; My Page </div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>My Page </h2>
					<div style="padding-top:10px;">
					<!--  -->
					<h4>Welcome <? echo $row_expert[exp_person_name]; ?></h4>
					
					<h4> You are the expert of 
					<?
					$querycat="SELECT * FROM ".$tblpref."services_category WHERE cat_id = '$row_expert[exp_service_area_id]'";
					if(!($resultcat=mysql_query($querycat))){ echo $querycat.mysql_error(); exit;}
					$resultcat = mysql_fetch_array($resultcat);
					echo $resultcat[cat_name]; ?>
					!!!!</h4>
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
<?php index_footer_mem_exp() ?>
