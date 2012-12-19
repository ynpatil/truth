<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$select_mem = "select * from ".$tblpref."member_reg WHERE mem_id ='$_SESSION[mem_id]' AND mem_status!='Deactive'";
	if(!($result_mem=mysql_query($select_mem))) { echo $select_mem.mysql_error();exit;}
	$row_login = mysql_fetch_array($result_mem);

	$CurDate = date('Y-m-d h:i:s');
	$Curdate = explode(" ",$CurDate);
	$cdate = explode("-",$Curdate[0]);

	$memregdate = explode(" ",$row_login[mem_date]);
	$date = explode("-",$memregdate[0]);

	$dif =  dateDiff1($memregdate[0],$Curdate[0]);/* Find the difference between Two date*/
	$dif = $dif + 2;							/* Add upper limit and  Lower limit for MONTH*/

	$DateFormate = FindMonth($date[0],$date[1],$dif);

	$DateFormate = array_reverse($DateFormate);
?>
<div id="expertpanel">
	<div class="head-title-bg">
		<div class="crumb">
			<a href="truth-junction-member-index.php"><strong>My Page</strong></a>&nbsp;&raquo; Commission History
		</div>
	</div>
<div style="width:696px;">
<!--  -->
<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">

			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Commission history</h2>
					<div style="padding-top:10px;">					
					<div class="table-block">
						<table width="100%">
							<thead>
							<tr>
								<th class="head1" align="center">Date of payment</th>
								<th class="head1" align="center">Subscription fee</th>
								<th class="head1" align="center">NPRM </th>
								<th class="head1" align="center">Commission</th>
								<th class="head1" align="center">Amt. Receivable</th>
							</tr>
							</thead>
							<?
							if(count($DateFormate)>=1)
							{
								for($i=0;$i<=count($DateFormate)-1;$i++)
								{	
									if($i%2==0)
									{
										$bgcolor = "light"; 
									}
									else
									{
										$bgcolor = ""; 
									}
							
							?>
							<tr class="<?=$bgcolor?>" height="30">
									<td class="head1" colspan="5"><strong>
									<? 
									   $dateformonth = explode(" ",$DateFormate[$i]);
									   echo $dateformonth[1]." ".$dateformonth[2];
									?>
									</strong></td>
									
							</tr>
							<?
							$month = $dateformonth[0]+1;
							
							if($month<13)
							{
								$emonth = $month;
								$eyear = $dateformonth[2];

								$smonth = $emonth -1;
								$syear = $dateformonth[2];
							}
							else
							{
								$emonth = $month - 12;
								$eyear = $dateformonth[2]+1;

								$smonth = $month - 1;
								$syear = $dateformonth[2];
							}

							$datestart = $syear."-".$smonth."-01 00:00:01";

							$dateend = $eyear."-".$emonth."-01 00:00:01";

							$queryph="select * from ".$tblpref."payment where pay_member_id='$_SESSION[mem_id]' AND pay_date < '$dateend' AND pay_date > '$datestart' ";
			
							if(!($resultph=mysql_query($queryph))){ echo $queryph.mysql_error(); exit;}
							$rowph = mysql_fetch_array($resultph);
							$paynumrow = mysql_num_rows($resultph);

							?>
							<tr class="<?=$bgcolor?>" height="30" >
								<td class="head1">P
								<? 
								   if($paynumrow > 0)
									{
									   $txtdate = explode(" ",$rowph[pay_date]);
									   echo dateformate1($txtdate[0])."<br>";
									   echo $txtdate[1];	
									}
									else
									{
										echo "Unpaid";
									}
								?></td>
								<td class="head1" align="right">P 
								<?
									$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date < '$dateend' ORDER BY subfee_id DESC";
									if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit;}
									$rowsubfee = mysql_fetch_array($resubfee);
									$rowsf = $rowsubfee[subfee_subfees] + $rowsubfee[subfee_contactfee];
									echo number_format($rowsf,2);
								?>								
								</td>
								<td class="head1" align="right">
								<?
								$selrefmem = "select * from ".$tblpref."member_reg WHERE mem_refname ='$_SESSION[mem_id]' AND mem_date < '$dateend'";
								if(!($resrefmem=mysql_query($selrefmem))){echo $selrefmem.mysql_error();exit;}
								$numrefmem = mysql_num_rows($resrefmem);
								echo $numrefmem;
								?>
								</td>
								<td class="head1" align="right">
								<?  
									$com = $numrefmem*100;
									echo number_format($com,2);
								?>
								</td>
								<td class="head1" align="right">P 

								<? 
									$txttotal = $com - $rowsf;
									if($txttotal > 0)
									{
										echo number_format($txttotal,2);
									}
									else
									{
										echo "0.00";
									}
									
								?>

								  </td>
									
							</tr>
							<?	} 
							} 
							?>

							

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