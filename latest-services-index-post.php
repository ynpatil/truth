<?php
session_start();
include("common/app_function.php");
include("common/config.php");

$queservices="SELECT serv.exps_name,serv.exps_date,serv.exps_id FROM ((truth_expert AS expt LEFT JOIN truth_expert_servies AS serv ON expt.exp_id=serv.exps_expert_id) LEFT JOIN truth_services_category AS cat ON expt.exp_service_area_id=cat.cat_id) WHERE cat.cat_id='$_REQUEST[cat]' AND expt.exp_status = 'Active'  AND serv.exps_status='Active' ORDER BY serv.exps_date DESC LIMIT 0,6";
if (!($servresult = mysql_query($queservices))) { echo "FOR QUERY: $queservices<BR>".mysql_error();exit;}

?>
<div id="servicepanel">
<div class="round-box-t">
	<div class="pad8">
		<h2><span>Latest Experts Postings</span></h2>
		<h4><span>
		<?
		$service = "SELECT * FROM truth_services_category WHERE cat_id='$_REQUEST[cat]'";
		if (!($servcat = mysql_query($service))) { echo "FOR QUERY: $service<BR>".mysql_error();exit;}
		$rescat = mysql_fetch_array($servcat);
		echo $rescat[cat_name];
		?>
		</span></h4>
		<div style=" padding:5px 0 0 10px;">
		
			<table width="98%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td valign="top" class="light-bluebg">
					<table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-bottom:43px;">
					<tr>
						<td><h3 class="icon-posting">Posting</h3></td>
					</tr>
					<tr>
						<td valign="top" class="post-date">
							<ul>
							<?
							while($rowserv = mysql_fetch_array($servresult))
							{
							$txtdate[] = $rowserv[exps_date]; 
							?>
								<li><a <? if($_SESSION[mem_id]=="") { ?> href="javascript:errmsg();" <? } else { ?>href="truth-junction-servies-view.php?serviceid=<? echo $rowserv[exps_id]?>" <? } ?>><? echo $rowserv[exps_name]?></a></li>
							<? } ?>
								
							</ul>
						</td>
					</tr>
					</table>
				</td>
				
				<td width="2%"></td>
				
				<td valign="top" class="light-bluebg">
					
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><h3 class="date">Date</h3></td>
					</tr>
					<tr>
						<td valign="top" class="post-date">
							<ul>
							<?
							if(is_array($txtdate))
							{
							foreach($txtdate AS $val)
							{
							?>
								<li><a <? if($_SESSION[mem_id]=="") { ?> href="javascript:errmsg();"  <? } else { ?>href="#" <? } ?>><? $txtd = explode(" ",$val);
									echo dateformate1($txtd[0]);
								?></a></li>
							<? } } ?>
							</ul>
						</td>
					</tr>
					</table>
					

				</td>
			</tr>
			</table>
		</div>
	</div>
	<div class="clear"></div>
</div>
</div>