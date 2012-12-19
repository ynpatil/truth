<?
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="SELECT * FROM ".$tblpref."expert ";  //Query for search dropdown
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}

			if ($_GET[sorton]!="")
			{
				 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
			}
			$typev=$txtname;
			
			if($txtname!="")
			{
				$condition[]="exp_person_name ='$txtname'";
			}
			if($exp_type!="")
			{
				$condition[]="exp_service_area_id ='$exp_type'";
			}
			if($status!="")
			{
				$condition[]="exp_status ='$status'";
			}
			
			if(is_array($condition))
			{
				$condition=" WHERE " . implode(" AND ",$condition);
			}

			$que="SELECT * FROM ".$tblpref."expert $condition $condition2"; 
			
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
			$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
			$srnum=explode(",",$srnum);
			$count=$srnum[0];

admin_header("../../","expert Management");
admin_nav("../../");
?>
<script type="text/javascript" src="../../js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="../../js/thickbox-compressed.js"></script>
<link href="../../css/thickbox.css" rel="stylesheet" type="text/css" />

<table cellspacing="3" cellpadding="0" border="0" width="90%" align="center"  valign="top" class="tbborder">
	<tr><td align="center" ><b><h2>Expert Management</h2></b></td></tr>
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
					<TD align="right" class="tbborder">Name of Expert :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<?
					$category=$_GET[drop1];
					$query1="SELECT * FROM  ".$tblpref."expert"; 
					if (!($result = mysql_query($query1))) { echo "FOR QUERY: $query1<BR>".mysql_error(); 	exit;}
					?>
					<select NAME="txtname" style="width:300px" >
					<option value="" >Please Select</option>			
					<?while($row=mysql_fetch_array($result)){?>
					<option value="<?=$row[exp_person_name]?>" <?if($row[exp_person_name]==$txtname){?>selected <?}?>><?=$row[exp_person_name]?></option>
					<?}?>
					</select>
					</TD>
					</TR>

					<TR>
					<TD align="right" class="tbborder">Services Area :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<select NAME="exp_type" id="exp_type" style="width:280px" onchange="empty(this.id);">
					<option value="" >Please Select</option>			
					<? 
					$query="SELECT * FROM  ".$tblpref."services_category"; 
					if (!($result = mysql_query($query))) { echo "FOR QUERY: $strsql<BR>".mysql_error(); 	exit;}
					while($row=mysql_fetch_array($result))
					{?>
						<option value="<?=$row[cat_id]?>" <?if($row[cat_id]==$exp_type){?>selected <?}?>><?=$row[cat_name]?> </option>
					<?}?>
					</select>
					</TD>
					</TR>

					<TR>
					<TD align="right" class="tbborder">Status :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<input type="radio" name="status" value="Active" <? if($status=='Active') { ?>checked <? } ?>>&nbsp;Active&nbsp;
					<input type="radio" name="status" value="Inactive" <? if($status=='Inactive') { ?>checked <? } ?>>&nbsp;Inactive&nbsp;
					<input type="radio" name="status" value="" <? if($status=='') { ?>checked <? } ?>>&nbsp;All&nbsp;
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
	<a href="expert_add.php?mode=add">ADD NEW</a>
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
			<th>Sr.no</th>			
			<th><A HREF="?sorton=exp_person_name&sortby=<?
			if($_GET[sorton]=="exp_person_name" && ($_GET[sortby])=="desc") 
				echo "asc";
			else
				echo "desc";
				?>" class="nav">Name of Expert</a></th>		
			
			<th><A HREF="?sorton=exp_comp_name&sortby=<?
			if($_GET[sorton]=="exp_comp_name" && ($_GET[sortby])=="desc") 
				echo "asc";
			else
				echo "desc";
				?>" class="nav">Service Area</a></th>		
			<th>Number Of Posting</th>
			<th>status</th>
 			<th>Action</th>
			</TR>
			<TR width="100%">
			<?while($row_category=mysql_fetch_array($page_res)){ 
			$count ++;?>
			
			<TD width="5%" class="tbborder"><?=$count?></TD>
			<TD class="tbborder" width="20%" align="left"><?=$row_category[exp_person_name]?></TD>
			<td class="tbborder" align="left">
			<?
			$querycat="SELECT * FROM ".$tblpref."services_category WHERE cat_id = '$row_category[exp_service_area_id]'";
			if(!($resultcat=mysql_query($querycat))){ echo $querycat.mysql_error(); exit;}
			$rescat = mysql_fetch_array($resultcat);
			echo $rescat[cat_name]; ?>
			</td>

			<td class="tbborder" width="25%">
			<?
			$postexp = "SELECT * FROM  ".$tblpref."expert_servies WHERE exps_expert_id = '$row_category[exp_id]'";
			if(!($respost=mysql_query($postexp))){ echo $postexp.mysql_error(); exit;}
			$rowpost = mysql_fetch_array($respost);
			$num_row = mysql_num_rows($respost);
			?>
			<a href="service-posting.php?expertid=<?=$row_category[exp_id]?>&expname=<?=$row_category[exp_person_name]?>" class="thickbox"><? echo $num_row."&nbsp;&nbsp;[&nbsp;View Details&nbsp;]"; ?></a>
			</td>

			<td class="tbborder">
			<a href="submit_expert.php?status=<?=$row_category[exp_status]?>&id=<?=$row_category[exp_id]?>"><?=$row_category[exp_status]?></a>			
			</td>
			<TD width="25%" class="tbborder" align="center"><a href="expert_add.php?mode=edit&id=<?=$row_category[exp_id]?>" > Edit</a>&nbsp; |&nbsp;<a href="submit_expert.php?id=<?=$row_category[exp_id]?>&mode=del" class="menu" onClick='if(confirm("Deleting an Expert will end up deleting all his services. Do you want to confirm delete ?")){return true;}else{return false;}'> Delete</a> &nbsp;|&nbsp;<a href="submit_expert.php?mode=mail&id=<?=$row_category[exp_id]?>" > Send Info</a>
			</TD>
		</TR>
		<? }?>
		</TABLE>
</td>
</tr>
</table> 
<? admin_footer("../../");?>