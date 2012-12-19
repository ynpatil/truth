<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$select_mem = "select * from ".$tblpref."member_reg WHERE mem_id ='$_SESSION[mem_id]'";
	if(!($result_mem=mysql_query($select_mem))) { echo $select_mem.mysql_error();exit;}
	$row_login = mysql_fetch_array($result_mem);

	$CurDate = date('Y-m-d h:i:s');
	$Curdate = explode(" ",$CurDate);
	$cdate = explode("-",$Curdate[0]);

	$memregdate = explode(" ",$row_login[mem_date]);
	$date = explode("-",$memregdate[0]);

	$dif =  dateDiff1($memregdate[0],$Curdate[0]);/* Find the difference between Two date*/
	$dif = $dif + 1;						     /* Add upper limit and  Lower limit for MONTH*/

	$DateFormate = FindMonth($date[0],$date[1],$dif);

	if(count($DateFormate)>=1)
	{
		for($i=0;$i<=count($DateFormate)-1;$i++)
		{	
			if($i%2==0)
			{
				$bgcolor = "light"; 

				$RecordBG[] = $bgcolor;

			}
			else
			{
				$RecordBG[] = "";
			}
			$dateformonth = explode(" ",$DateFormate[$i]);
			$MonthRecored[] = $dateformonth[1]." ".$dateformonth[2]; //Date Column1 (Month row)
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

			$queryph="select * from ".$tblpref."payment where pay_member_id='$_SESSION[mem_id]' AND pay_date < '$dateend' AND pay_date > '$datestart'";

			if(!($resultph=mysql_query($queryph))){ echo $queryph.mysql_error(); exit;}
			$rowph = mysql_fetch_array($resultph);
			$paynumrow = mysql_num_rows($resultph);

			if($paynumrow > 0)
			{
			   $txtdate = explode(" ",$rowph[pay_date]);
			   $date = dateformate1($txtdate[0])."<br>"; // date for that month Column 1
			   $RecordDate[] = $date.$txtdate[1];
			   $RecordPaynow[] = "Paid";
			}
			else
			{
				$RecordPaynow[] = "UnPaid";
				$RecordDate[] = "";
			}

			$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE  subfee_date < '$dateend' ORDER BY subfee_id DESC limit 0,1";
			if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit;}
			$rowsubfee = mysql_fetch_array($resubfee);
			$rowsf = $rowsubfee[subfee_subfees] + $rowsubfee[subfee_contactfee];

			$RecordSubFee[] = number_format($rowsf,2); // subscription fee for that month Column 2


			$selrefmem = "select * from ".$tblpref."member_reg WHERE mem_refname ='$_SESSION[mem_id]' AND mem_date < '$dateend'";
			if(!($resrefmem=mysql_query($selrefmem))){echo $selrefmem.mysql_error();exit;}
			$numrefmem = mysql_num_rows($resrefmem);
			$RecordMemRef[] = $numrefmem;   // No Of referer Member for that month Column 3

			$com = $numrefmem*100;

			$RecordCommision[] = number_format($com,2); // commission at that month column 4


			$txttotal = $com - $rowsf;
			if($txttotal < 0)
			{
				$txttotal = $txttotal*(-1);
														
				if($paynumrow>0)
				{
					$total = $total + $txttotal;
					$cost =  number_format($total,2);
					$RecordPaid[] = "<b>".$cost."(Paid)</b>";  // Total Paid at that month column 5
					$total = 0;
					$totpay[]=$total;
				}
				else
				{
					$total = $total + $txttotal;
					$totpay[]=$total;
					$unpaid = number_format($total,2);
					$RecordPaid[] = $unpaid."(Carry Forward)"; // Total Paid at that month column 5
				}

			}
			else
			{
				$RecordPaid[] = "0.00"; // Total Paid at that month column 5
			}

		} 
	}
?>
<div id="expertpanel">
	<div class="head-title-bg">
		<div class="crumb">
			<a href="truth-junction-member-index.php"><strong>My Page</strong></a>&nbsp;&raquo; Payments Due
		</div>
	</div>
<div style="width:696px;">

<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">

			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>Payments Due</h2>
					<div style="padding-top:10px;">					
					<div class="table-block">
						<table width="100%">
							<thead>
							<tr>
								<th class="head1" align="center">Due Date</th>
								<th class="head1" align="center">Subscription fee</th>
								<th class="head1" align="center">NRM </th>
								<th class="head1" align="center">NPRM</th>
								<th class="head1" align="center">Commission</th>
								<th class="head1" align="center">Total to Paid</th>
								<th class="head1" align="center">Pay Now</th>
							</tr>
							</thead>
							<?
							if(count($MonthRecored) > 0)
							{
								for($i=count($MonthRecored)-1;$i>=0;$i--)
								{
							?>
							<tr class="<?=$RecordBG[$i]?>" height="30">
									<td class="head1" colspan="7"><strong>
									<? 
									  echo $MonthRecored[$i]."<br>";
									?>									
									</strong></td>
							</tr>
						
							<tr class="<?=$RecordBG[$i]?>" height="30" >
								<td class="head1">
								<? 
								  echo $RecordDate[$i]."<br>"; 
								?>
								</td>
								<td class="head1" align="right">P 
								<?
								  echo $RecordSubFee[$i]."<br>";
								?>								
								</td>
								<td class="head1" align="right">
								<?
								  echo $RecordMemRef[$i]."<br>";
								?>
								</td>
								<td class="head1" align="right">
								<?
								  echo $RecordMemRef[$i]."<br>";
								?>
								</td>
								<td class="head1" align="right"><b>P</b>
								<?  
									echo $RecordCommision[$i]."<br>";
								?>
								</td>
								<td class="head1" align="right">P 
								<? 
									echo $RecordPaid[$i]."<br><br>";
								?>
								</td>
								<? if($i==count($MonthRecored)-1){
							
								if($RecordDate[$i]=="" AND $totpay[$i]!=0) {?>
								<td class="head1" align="center">
								<a href="truth-junction-payment-submit.php?pay=<?=$totpay[$i];?>" style="background: none repeat scroll 0% 0% rgb(252, 161, 8); float: right; color: white; border: 1px solid rgb(252, 161, 8);"><strong>Pay Now</strong></a>
								</td>
								<? } else { ?>
								<td class="head1" align="center">
								Paid
								</td>															
								<? } }
								else{ 
								if($RecordPaynow[$i]=="UnPaid") { ?>
								<td class="head1" align="center">
								Unpaid
								</td>
								<? } else { ?>
								<td class="head1" align="center">
								Paid
								</td>
								<? } } ?>
							
									
							</tr>
							<?
								}
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