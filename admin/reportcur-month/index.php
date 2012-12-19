<?
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

	$curdate = date("Y-m-d");
	
	$dates = explode("-",$curdate);

	$startdate = $dates[0]."-".$dates[1]."-01 00:00:00";
	
	if ($_GET[sorton]!="")
	{
		 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
	}
	else
	{
		$condition2=" ORDER BY pay_id DESC";
	}

	$condition[] = "pay_type != 'Register'";

	if($txtdate!="")
	{
		$datep=explode(" ", $txtdate);
		if($datep[1]=="TO")
		{
			$datep1=dateformate($datep[0])." 00:00:00";
			$datep2=dateformate($datep[2])." 00:00:00";
			$condition[]="pay_date  >= '$datep1' AND pay_date <= '$datep2'";
		}
		else
		{
			$datep1=dateformate($datep[0])." 00:00:00";
			$datep2=dateformate($datep[2])." 00:00:00";
			$condition[]=" pay_date ='".$datep1."'";
		}
	}
	else
	{
		$dateendquery = "SELECT LAST_DAY(now()) as LastDayOfMonth";
		if (!($endres = mysql_query($dateendquery))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); exit;}
		$rowenddate = mysql_fetch_array($endres);
		$lastdate = $rowenddate[LastDayOfMonth]." 00:00:00";
		$condition[] = "pay_date  >= '$startdate' AND pay_date <= '$lastdate'";
	}

	if(is_array($condition))
	{
		$condition=" WHERE " . implode(" AND ",$condition);
	}

	$que="SELECT * FROM ".$tblpref."payment $condition $condition2";
	
	
	$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
	$pagesize=20;
	$the_query  = pagination($que,$page,null,$curr_query,$pagesize);
	$real_string     = explode("~" , $the_query);
	$que= $que.$cstr." LIMIT ". $real_string[0];
	$show_status     = $real_string[2];
	$show_pagination = $real_string[1];
	if (!($page_res = mysql_query($que))) 
	{ echo "FOR QUERY: $strsql<BR>".mysql_error(); 	exit;}
	$rowCount = mysql_num_rows($page_res);
	$srnum=$real_string[0][0];
	$srnum= $real_string[0];
	$srnum=explode(",",$srnum);
	$count=$srnum[0];

admin_header("../../","Payment Receivable in Current month from old Members");
admin_nav("../../");
?>
<script type="text/javascript" src="../../js/paging.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../cal_js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript">	
	$(function(){
		  $('#txtdate').daterangepicker({
			posX:570,
			posY: 200
		  }); 
	 });
</script>
<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center"><b><h2>Reports: Payment Receivable in Current month from old Members</h2></b></td></tr>
    <TR>
    <TD valign="top" width="75%">
				<TABLE class="tbborder"	cellspacing="0" cellpadding="0" border="0" width="70%" align="center" valign="top">
				<TR>
				<Th valign="top" width="75%" >
					<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" align="center" valign="top">
					<FORM NAME="frmcms" METHOD="POST" ACTION="index.php">
					<tr ><th colspan="2" align="center"><b>&nbsp;Search</b></font>
					</td></tr>

					<TR>
					<TD align="right" class="tbborder">Date Of Payment :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<input type="text" value="<?=$txtdate1?>" name="txtdate" id="txtdate"/>
					</TD>
					</TR>				
					
				
					<TR>
					<td align="center" colspan="2" class="tbborder">
					<INPUT TYPE="submit" value="Search" Name="txtsearch" class="mybutton">&nbsp;&nbsp;</td>
					</tr>
					</FORM>
					</TABLE>
				</td>
				</tr>				
				</TABLE>
	</td>
	</tr>

	<TR>
	<TD align="center" class="warning">
	<?if($flag=="edit")
		{
		echo "Record is updated successfully.";
		}
	if($flag=="del")
		{
		echo "Record is deleted successfully.";
		}
	if($flag=="mail")
		{
		echo "Mail had send successfully to the user.";
		}
	if($flag=="add")
		{
		echo "New record is added successfully.";
		}
		if($rowCount==0)
		{
		//echo "No record found.";
		}
	if($flag=="exist")
		{
		echo "Record is already exist.";
		}
		if($flag=="stat")
		{
		echo "Status has been successfully changed.";
		}
	?>
	</td>
	</TR>
	<TR>
	<TD>&nbsp;</TD>
	</TR>
	
	<TR>
	<TD align="right">
	<a href="exportsheet.php"><strong>Export CSV File</strong></a>
	</TD>
	</TR>
	
	<TR>
	<TD align="right">
	 <TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
		<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination?></TD>
		<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
	</table>
	</TD>
	</TR>

	<TR>
	<Th align="center">
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		   <TR>
			<th style="padding:0px;">Sr.no</th>	
			<th style="padding:0px;">Member Picture</th>
			<th style="padding:0px;">Member ID</th>
			<th style="padding:0px;">Member Name</th>
			<th style="padding:0px;">Date Of Payment</th>
			<th style="padding:0px;">Total Payment</th>
			</TR>

			<TR width="100%">
			<?
			while($row=mysql_fetch_array($page_res)){ 
			$count ++;?>
			<TD width="2%" class="tbborder"><?=$count?></TD>
			<TD class="tbborder" align="left">
			<?
			$memquery = "SELECT * FROM ".$tblpref."member_reg WHERE mem_id='$row[pay_member_id]'";
			if (!($qresult = mysql_query($memquery))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); exit;}
			$row_mem = mysql_fetch_array($qresult);
			?>

			<? if($row_mem[mem_upload]!=""){ ?>
			<img src="../../tjtmp/<?=$row_mem[mem_upload]?>" height="100" width="100" alt="">
			<? } else { ?>
			<img src="../../tjtmp/no-img.jpg" height="100" width="100" alt="">
			<? } ?>
			</TD>
			<TD class="tbborder"align="left">TJ-
			<?
			$len = strlen($row_mem[mem_id]);
			switch($len)
			{
				case 1:
				$new_app_id = "000".$row_mem[mem_id];
				break;
				case 2:
				$new_app_id = "00".$row_mem[mem_id];
				break;
				case 3:
				$new_app_id = "0".$row_mem[mem_id];
				break;
				default:
				$new_app_id = $row_mem[mem_id];
				break;
			}
			echo $new_app_id;
			?>
			</TD>
			<TD class="tbborder" align="left">
			<? 
				echo $row_mem[mem_title].". ".$row_mem[mem_first_name]." ".$row_mem[mem_sur_name];
			?>
			</TD>
			<td class="tbborder">
			<?
				$txtdate = explode(" ",$row[pay_date]);
				echo dateformate($txtdate[0])."<br/>";
				echo $txtdate[1];
			?>
			</td>
			
			<td class="tbborder" align="right">
			P <? echo number_format($row[pay_total_paid],2) ?>
			</td>
			
		</TR>
		<? } ?>
		</TABLE>
</td>
</tr>
</table> 
<? admin_footer("../../");?>