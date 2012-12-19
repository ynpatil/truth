<?
session_start();
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
	else
	{
		$condition2=" ORDER BY mem_id DESC";
	}
	
	$condition[] = "mem_id!=1";
	$condition[] = "mem_status='Deactivate'";

	if($txtmemid!="")
	{
		$condition[] = "mem_id = '$txtmemid'";
	}

	if($txtfname!="")
	{
		$condition[] = "mem_first_name LIKE '%$txtfname%'";
	}

	if($txtlname!="")
	{
		$condition[] = "mem_sur_name LIKE '%$txtlname%'";
	}

	if($status!="")
	{
		$condition[] = "mem_status='$status'";
	}

	if($txtdate!="")
	{
		$condition[] = "mem_date like '%".dateformate($txtdate)."%'";
	}

	if($txtreferer!="")
	{
		$condition[] = "mem_id = '$txtreferer'";
	}

	if($txtreferance!="")
	{
		$condition[] = "mem_refname = '$txtreferance'";
	}

	if(is_array($condition))
	{
		$condition=" WHERE " . implode(" AND ",$condition);
	}

	$que="SELECT * FROM ".$tblpref."member_reg $condition $condition2";
	
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

admin_header("../../","Member Management");
admin_nav("../../");
?>
<script type="text/javascript" src="../../js/paging.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../cal_js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../cal_js/daterangepicker1.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript">	
	$(function(){
		  $('#txtdate').daterangepicker({
			posX:470,
			posY: 300
		  }); 
	 });
</script>

<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center"><b><h2>Reports: Deactivate Member Management</h2></b></td></tr>
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
					<TD align="right" class="tbborder">Member Id :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<input type="text" name="txtmemid" value="">
					</TD>
					</TR>
					
					<TR>
					<TD align="right" class="tbborder">First Name :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<input type="text" name="txtfname" value="">
					</TD>
					</TR>
					
					<TR>
					<TD align="right" class="tbborder">Last Name :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<input type="text" name="txtlname" value="">
					</TD>
					</TR>
					
					<TR>
					<TD align="right" class="tbborder">Date Of Joining :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<input type="text" value="<?=$txtdate1?>" name="txtdate" id="txtdate"/>
					</TD>
					</TR>

					<TR>
					<TD align="right" class="tbborder">Referring Member :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<?
					$category=$_GET[drop1];
					$query1="SELECT * FROM  ".$tblpref."member_reg WHERE mem_id!=1 ORDER BY mem_id DESC";
					if (!($result = mysql_query($query1))) { echo "FOR QUERY: $query1<BR>".mysql_error(); 	exit;}
					?>
					<select name="txtreferer">
					<option value="">Please Select</option>			
					<?while($row=mysql_fetch_array($result)){?>
					<option value="<?=$row[mem_refname]?>" <?if($row[mem_refname]==$txtreferer){?>selected <?}?>><? echo $row[mem_title].". ".$row[mem_first_name]." ".$row[mem_sur_name];?></option>
					<?}?>
					</select>
					</TD>
					</TR>

					<TR>
					<TD align="right" class="tbborder">Referred Members :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<?
					$category=$_GET[drop1];
					$query1="SELECT * FROM  ".$tblpref."member_reg WHERE mem_id!=1 ORDER BY mem_id DESC"; 
					if (!($result = mysql_query($query1))) { echo "FOR QUERY: $query1<BR>".mysql_error(); 	exit;}
					?>
					<select name="txtreferance">
					<option value="">Please Select</option>			
					<?while($row=mysql_fetch_array($result)){?>
					<option value="<?=$row[mem_id]?>" <?if($row[mem_id]==$txtreferance){?>selected <?}?>><? echo $row[mem_title].". ".$row[mem_first_name]." ".$row[mem_sur_name];?></option>
					<?}?>
					</select>
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
			<th style="padding:0px;">Picture</th>
			<th style="padding:0px;">Full Name</th>
			<th style="padding:0px;">Member ID</th>			
			<th style="padding:0px;">Date Of Joining</th>
 			<th style="padding:0px;">Referring member</th>
			<th style="padding:0px;">N.R.M</th>
			<th style="padding:0px;">Deactivation Date</th>
			<th style="padding:0px;">Amt Receivable</th>
			</TR>

			<TR width="100%">
			<?
			while($row_category=mysql_fetch_array($page_res)){ 
			$count ++;?>
			<TD width="2%" class="tbborder"><?=$count?></TD>
			<TD class="tbborder" align="left">
			<? if($row_category[mem_upload]!=""){ ?>
			<img src="../../tjtmp/<?=$row_category[mem_upload]?>" height="100" width="100" alt="">
			<? } else { ?>
			<img src="../../tjtmp/no-img.jpg" height="100" width="100" alt="">
			<? } ?>
			</TD>
			
			<TD class="tbborder" align="left">
			<? 
				echo $row_category[mem_title].". ".$row_category[mem_first_name]." ".$row_category[mem_sur_name];
			?>
			</TD>
			<TD class="tbborder"align="left">TJ-
			<? 
			$len = strlen($row_category[mem_id]);
			switch($len)
			{
				case 1:
				$new_app_id = "000".$row_category[mem_id];
				break;
				case 2:
				$new_app_id = "00".$row_category[mem_id];
				break;
				case 3:
				$new_app_id = "0".$row_category[mem_id];
				break;
				default:
				$new_app_id = $row_category[mem_id];
				break;
			}
			echo $new_app_id;
			?>			
			</TD>
			<td class="tbborder">
			<?
				$txtdate = explode(" ",$row_category[mem_date]);
				echo dateformate($txtdate[0])."<br/>";
				echo $txtdate[1];
			?>
			</td>
			
			<td class="tbborder">
			<?
				$queryref="SELECT * FROM ".$tblpref."member_reg WHERE mem_id='$row_category[mem_refname]'";
				if(!($resref=mysql_query($queryref))){ echo $queryref.mysql_error(); exit;}
				$row_ref = mysql_fetch_array($resref);
				echo $row_ref[mem_first_name]." ".$row_ref[mem_sur_name];
			?>
			</td>
			<td class="tbborder">
			<?
				$queryref="SELECT mem_id FROM ".$tblpref."member_reg WHERE mem_refname='$row_category[mem_id]'";
				if(!($resref=mysql_query($queryref))){ echo $queryref.mysql_error(); exit;}
				$row_ref = mysql_num_rows($resref);
				echo $row_ref;
			?>
			</td>
			<td class="tbborder">
			<?
				$txtdate = explode(" ",$row_category[mem_deactdate]);
				echo dateformate($txtdate[0])."<br/>";
				echo $txtdate[1];
			?>
			</td>
			<td class="tbborder">
			<? echo outstandingdue($row_category[mem_date],$row_category[mem_id]); ?>
			</td>
			
		</TR>
		<? } ?>
		</TABLE>
</td>
</tr>
</table> 
<? admin_footer("../../");?>