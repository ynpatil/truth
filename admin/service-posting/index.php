<?
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

		if($serviceid!="")
		{
			if($status=="Active")
			{
				$qadd="UPDATE ".$tblpref."expert_servies set
				exps_status='Inactive'
				where exps_id= '$serviceid'";
				if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
			}
			if($status=="Inactive")
			{
				$qadd="UPDATE ".$tblpref."expert_servies set
				exps_status='Active'
				where exps_id= '$serviceid'";
				if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
			}
		}
		
		if ($_GET[sorton]!="")
		{
			 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
		}
		else
		{
			$condition2=" ORDER BY exps_id DESC";
		}
		if($txtname!="")
		{
			$condition[]="exps_id='$txtname'";
		}
		if(is_array($condition))
		{
			$condition=" WHERE " . implode(" AND ",$condition);
		}

		$que="SELECT * FROM  ".$tblpref."expert_servies $condition $condition2";
		
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

admin_header("../../","Services Area Mgmt");
admin_nav("../../");
?>
<BR>
<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center" class="body"><b><h2>Services Posting Management</h2></b></td></tr>
    <TR>
    <TD valign="top" width="75%">
				<TABLE width="80%" style="border-collapse: collapse" bordercolor="#ededed" border="1" cellspacing="0" cellpadding="3" align="center" valign="top">
				<FORM NAME="frmcms" METHOD="POST" ACTION="index.php">
				<tr ><th colspan="2" align="center"><b>&nbsp;Search</b></font>
				</td></tr>

				<TR>
				<TD align="right" >Services Name :</FONT></TD>
				<TD align="left" style="padding-left:5px;">
				<select NAME="txtname" style="width:200px">
				<option value="">Please Select</option>			
				<? 
				$query="SELECT * FROM  ".$tblpref."expert_servies"; 
				if (!($result = mysql_query($query))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); 	exit;}
				while($row=mysql_fetch_array($result))
				{?>
				<option value="<?=$row[exps_id]?>" <?if($row[exps_id]==$txtname){?>selected <?}?>><?=$row[exps_name]?> </option>
                
				<?}?>
				</select>
				</TD>
				</TR>		

				<TR>
				<td align="center" colspan="2">
				<INPUT TYPE="submit" value="Search" Name="txtsearch" class="mybutton">&nbsp;&nbsp;</td>
				</tr>
				</FORM>
				</TABLE>
	</td>
	</tr>

<?if($rowCount==0){?>
				<TR>
				<TD align="center" class="warning" valign="middle">No record found.</TD>
				</TR>
				<? } ?>	
				<?if($flag=="edit"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">Record is edited Successfully.</TD>
				</TR>
				<? } ?>	
				<?if($flag=="add"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">New record is added successfully.</TD>
				</TR>
				<? } ?>	
				<?if($flag=="exits"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">Record is already exits.</TD>
				</TR>
				<? } ?>	
				<?if($flag=="del"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">Record is deleted Successfully.</TD>
				</TR>
<? } ?>	


<!-- 	<TR>
	<TD align="right">
	<a href="pub_cat_add.php?mode=add">ADD NEW</a> 
	</TD>
	</TR> -->
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

			<TD class="tbborder"  align="center"><a href="view-uploaded-doc.php?serviceid=<?=$row_category[exps_id]?>">View All Uploaded Doc</a></TD>

			<TD width="15%" class="tbborder" align="center"><a href="index.php?status=<?=$row_category[exps_status]?>&serviceid=<?=$row_category[exps_id]?>">
			<strong><?=$row_category[exps_status]?></strong></a></TD>

			<TD width="15%" class="tbborder" align="center"><a href="view-services-posting.php?serviceid=<?=$row_category[exps_id]?>">View</a></TD>
		</TR>
		<? } ?>
		</TABLE>

</table>
</td>
</tr>


<?admin_footer("../../");?>