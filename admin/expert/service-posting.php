<?
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

		
	$que="SELECT * FROM  ".$tblpref."expert_servies WHERE exps_expert_id='$expertid'";
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
<html>
<body>
<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center" class="body"><b><h2>Services Posted By <?=$_REQUEST[expname]?></h2></b></td></tr>
    <TR>
	<TD align="right">
	 <TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
		<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination ?></TD>
		<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
	</table>
	</TD>
	</TR>
	<TR>
	<Th align="center">
	
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%">
		   <TR>
			<th>Sr.no</th>
			<th align="center"><A HREF="?sorton=cat_name&sortby=<?
			if($_GET[sorton]=="cat_name" && ($_GET[sortby])=="desc") 
				echo "asc";
			else
				echo "desc";
				?>" class="nav">Services Name</th>
			<th align="center"><A HREF="?sorton=cat_name&sortby=<?
			if($_GET[sorton]=="cat_name" && ($_GET[sortby])=="desc") 
				echo "asc";
			else
				echo "desc";
				?>" class="nav">Expert Name</th>
			<th>View Uploaded Doc</th>
			<th>Status</th>
			<th>View</th>
		</TR>
		<?	while($row_category=mysql_fetch_array($page_res)){ 
			$count ++;
			?>
		<TR width="100%">
			<TD align="center" width="10%" class="tbborder"><?= $count?></TD>
			<TD class="tbborder"  align="left"><?=$row_category[exps_name]?></TD>
			<TD class="tbborder"  align="left">
			<? 
			$querycat="SELECT * FROM ".$tblpref."expert WHERE exp_id = '$row_category[exps_expert_id]'";
			if(!($resultcat=mysql_query($querycat))){ echo $querycat.mysql_error(); exit;}
			$resultcat = mysql_fetch_array($resultcat);
			echo $resultcat[exp_person_name]; ?>
			</TD>

			<TD class="tbborder"  align="center">
			<a href="expert-uploaded-doc.php?serviceid=<?=$row_category[exps_id]?>&name=<?=$row_category[exps_name]?>" class="thickbox">View All Uploaded Doc</a>
			</TD>

			<TD width="15%" class="tbborder" align="center">
			<strong><?=$row_category[exps_status]?></strong></TD>

			<TD width="15%" class="tbborder" align="center"><a href="view-service-posting.php?serviceid=<?=$row_category[exps_id]?>" class="thickbox">View</a></TD>
		</TR>
		<? } ?>
		</TABLE>

</table>
</td>
</tr>
</table>
</body>
</html>