<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");

	$queservices="SELECT exp_person_name,exp_id FROM ".$tblpref."expert WHERE exp_id='$expid' ";
	if (!($servresult = mysql_query($queservices))) { echo "FOR QUERY: $queservices<BR>".mysql_error();exit;}
	$rowserv = mysql_fetch_array($servresult);

	if ($_GET[sorton]!="")
	{
		 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
	}
	
	$condition[]="exps_expert_id  ='$expid'";

	$condition[]="exps_status='Active'";

	if($txtname!="")
	{
		$condition[]="exps_name  ='$txtname'";
	}
		
	if(is_array($condition))
	{
		$condition=" WHERE " . implode(" AND ",$condition);
	}

	$que="SELECT * FROM ".$tblpref."expert_servies $condition $condition2";
	
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

	index_header("Services");
?>

<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo;	
	<a href="truth-junction-services.php"><strong>Services</strong></a>&nbsp;&raquo;  <?=$said?>&nbsp;&raquo; <?=$rowserv[exp_person_name]?>
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2><?=$rowserv[exp_person_name]?></h2>
					<div style="padding-top:10px;">
					<!--  -->
					<div class="table-block">
	
					<TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
					<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination?></TD>
					<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
					</table>
							<table width="100%"><thead>
							<tr>
								<th class="head1" align="center">Image</th>
								<th class="head1" align="center">Services Name</th>
								<th class="head1" align="center">Date Of Posting</th>
								<th class="head1" align="center">Details</th>
							</tr>
							</thead>
							<tbody>
							<?
							while($row_category=mysql_fetch_array($page_res))
							{ 
								$count ++;
							?>
								<tr class="light" height="30">
									<td class="head1">
									<? if($row_category[exps_image_one]!=""){ ?>
									<img src="tjtmp/<?=$row_category[exps_image_one]?>" alt="<?=$row_category[exps_name]?>" height="90" width="120">
									<? } else { ?>
									<img src="tjtmp/no-img.jpg" alt="<?=$row_category[exps_name]?>" height="80" width="110">
									<? } ?>
									</td>
									<td class="head1"><?=$row_category[exps_name]?></td>
									<td class="head1">
									<? $txtdate = explode(" ",$row_category[exps_date]);
									   echo dateformate1($txtdate[0])."<br>";
									   echo $txtdate[1];								
									?></td>
									<td class="head1"><a href="truth-junction-servies-view.php?serviceid=<?=$row_category[exps_id]?>"><strong>View Details</strong></a></td>
								</tr>
							<? } ?>

							</tbody>
							</table>

					<TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
					<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination?></TD>
					<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
					</table>
                    </div>
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