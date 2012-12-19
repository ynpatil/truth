<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$querymem = "select * from ".$tblpref."member_reg where mem_refname='$_SESSION[mem_id]'"; 
	if(!($resultmem = mysql_query($querymem))){ echo $querymem.mysql_error(); exit;}
	
	$num_row = mysql_num_rows($resultmem);
?>
<div id="expertpanel">
	<div class="head-title-bg">
		<div class="crumb">
		<a href="truth-junction-member-index.php"><strong>My Page</strong></a>&nbsp;&raquo; Referred Members
		</div>
	</div>
<div style="width:696px;">
<!--  -->
<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">

			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Referred Members</h2>
					<div style="padding-top:10px;">
					<div class="table-block">
						<table width="100%">
							<thead>
							<tr>
								<th class="head1" align="center">Picture</th>
								<th class="head1" align="center">Name</th>
								<th class="head1" align="center">Joining date </th>
								<th class="head1" align="center">No of Referred members</th>
								<th class="head1" align="center">Outstanding payment</th>
							</tr>
							</thead>
							<? 
							if($num_row>0)
							{
							while($rowmem = mysql_fetch_array($resultmem)) 
							   { 
							?>
							<tr class="light" height="30">
									<td class="head1">
									<? if($rowmem[mem_upload]!=""){ ?>
									<img src="tjtmp/<?=$rowmem[mem_upload]?>" height="100" width="100" alt="">	
									<? } else { ?>
									<img src="tjtmp/no-img.jpg" height="100" width="100" alt="">	
									<? } ?>							
									
									</td>
									<td class="head1"><? echo $rowmem[mem_title].".".$rowmem[mem_first_name]." ".$rowmem[mem_sur_name]?></td>
									<td class="head1">
									<? 
										$txtdate = explode(" ",$rowmem[mem_date]);
										echo dateformate($txtdate[0])."<br/>";
										echo $txtdate[1];
									?>
									</td>
									<td class="head1">
									<?
									 $querymemref = "select mem_id from ".$tblpref."member_reg where mem_refname='$rowmem[mem_id]'"; 
									if(!($resultref = mysql_query($querymemref))){ echo $querymemref.mysql_error(); exit;}
									$rownum = mysql_num_rows($resultref);
									echo $rownum;
									?>
									</td>
									<td class="head1">
									<? echo outstandingdue($rowmem[mem_date],$rowmem[mem_id]); ?>
									</td>
							</tr>
							<? } }else{ ?>
							<tr class="light" height="30">
							<td class="head1" colspan="5" align="center"><h2>Please add members under you</h2></td>
							</tr>
							<? } ?>
						  </table>
					</div>

					</div>
				</div>
			<div class="clear"></div>
			</div>
			</td>
			</tr>
		</table>
</div></div>