<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");

	if ($_GET[sorton]!="")
	{
		 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
	}
	$condition[] = "exps_expert_id = '$_SESSION[exp_id]'";
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

	
?>
<div id="expertpanel">
<script type="text/javascript" src="js/thickbox-compressed.js"></script>
<link href="css/thickbox.css" rel="stylesheet" type="text/css" />

<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo; My Services
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>My Services </h2>
					
					<div style="float:right; padding-top:10px;"><a href="expert-post-services.php?TB_iframe=true&height=520&width=700" class="thickbox"><img src="images/btn-services-posted.jpg" alt=""/></a></div>
	<div class="clear"></div>
		<? if($flag=="add") { ?>
			<table>
		<tr><td height="20" class="warning" align="center" colspan="2"> Service has been successfully added </td></tr></table>
		<? } ?>
		<? if($flag=="edit") { ?>
			<table>
		<tr><td height="20" class="warning" align="center" colspan="2"> Service has been successfully updated </td></tr></table>
		<? } ?>
		<? if($flag=="del") { ?>
			<table>
		<tr><td height="20" class="warning" align="center" colspan="2"> Service has been successfully deleted </td></tr></table>
		<? } ?>
					<div style="padding-top:10px;">
					<!--  -->
					<div class="table-block">
	
	 <TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
		<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination?></TD>
		<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
	</table>

							<table width="100%">

							<thead>
							<tr>
								<th class="head1" align="center">Image</th>
								<th class="head1" align="center">Services Name</th>
								<th class="head1" align="center">Date Of Posting</th>
								<th class="head1" align="center">Status</th>
								<th class="head1" align="center">Action</th>
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
									<? if($row_category[exps_image_one]!=""){?>
									<img src="tjtmp/<?=$row_category[exps_image_one]?>" alt="<?=$row_category[exps_name]?>" height="90" width="120">
									<? } else {?>
									<img src="tjtmp/no-img.jpg" alt="<?=$row_category[exps_name]?>" height="80" width="110">
									<? } ?>
									</td>
									<td class="head1"><?=$row_category[exps_name]?></td>
									<td class="head1">
									<? $txtdate = explode(" ",$row_category[exps_date]);
									   echo dateformate1($txtdate[0])."<br>";
									   echo $txtdate[1];								
									?></td>
									<td class="head1"><?=$row_category[exps_status]?></td>
									<td class="head1" >
									<a href="truth-junction-service-upload.php?expid=<?=$row_category[exps_id]?>&name=<?=$row_category[exps_name]?>"><strong>Upload Document</strong></a><br><br>
									<a href="expert-post-services.php?id=<?=$row_category[exps_id]?>&TB_iframe=true&height=500&width=700" class="thickbox"><strong>Update Service</strong></a><br><br>
									<a href="submit-service.php?id=<?=$row_category[exps_id]?>&mode=del"><strong>Delete</strong></a></td>
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
	</div>