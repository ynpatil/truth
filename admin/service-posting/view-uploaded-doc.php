<?session_start();
include("../../common/config.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

	if ($_GET[sorton]!="")
	{
		 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
	}
		
	$condition[]="esdoc_service_id ='$serviceid'";

	if(is_array($condition))
	{
		$condition=" WHERE " . implode(" AND ",$condition);
	}

	$que="SELECT * FROM ".$tblpref."exp_ser_docup $condition $condition2";
	
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

admin_header("../../","Services Posting Mgmt");
admin_nav("../../");
?>
<script language="JavaScript" src="../../common/date-picker.js"></script>	
<script language="JavaScript" type="text/javascript" src="wysiwyg_cs.js"></script>
<table cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Services Posting Management</h2></b></td></tr>
	<tr><td height="12px"></td></tr>

	<tr><td>
			<div class="table-block">
			
					 <TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
						<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination?></TD>
						<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
					</table>

					<table width="100%">
					<thead>
					<tr>
						<th class="head1" align="center">Document Type</th>
						<th class="head1" align="center">Document Name</th>
						<th class="head1" align="center">Date Of Posting</th>
						<th class="head1" align="center">Download</th>
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
							<? $doctype = explode(".",$row_category[esdoc_upload]);
						
							?>
							
							<img src="../../images/<? echo $doctype[1].'.jpeg';?>" alt="<?=$row_category[esdoc_name]?>" height="90" width="120">
							
							</td>
							<td class="head1"><?=$row_category[esdoc_name]?></td>
							<td class="head1">
							<? 
							   $txtdate = explode(" ",$row_category[esdoc_date]);
							   echo dateformate1($txtdate[0])."<br>";
							   echo $txtdate[1];								
							?>
							</td>
							<td class="head1">
							<a href="../../tjtmp/<?=$row_category[esdoc_upload]?>">
							Download</a>&nbsp;</td>
						</tr>
					<? } ?>

					</tbody>
					</table>

					

					<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<TD  align= "center" width="80%" class="tdclass1"><?=$show_pagination?></TD>
					<TD align= "right" width="20%"class="tdclass1"><?=$show_status?></TD>
					</table>

					<table width="100%">
					<tr>
					<td align="center" colspan="2"><INPUT TYPE="button" value="Back" Name="Back" class="mybutton" onclick="javascript:history.back();">&nbsp;&nbsp;</td>
					</tr>
					</table>
                     </div>

</td>
</tr>
</table>
</td>
</tr>
</table>

<?admin_footer("../../");?>