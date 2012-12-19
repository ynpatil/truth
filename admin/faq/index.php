<?php 
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

if(@$_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

admin_header("../../","FAQ Management");	
admin_nav("../../");

      

 $query="SELECT * FROM ".$tblpref."content_master where cms_type='faq' ORDER BY cms_date"; //query for drop down list
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}


	if ($_GET[sorton]!="")
		{
			 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
		}

		$typev=$txtname;
		$condition[]="cms_type = 'faq'";
		if($txtname!="")
		{
			$condition[]="cms_title = '$txtname'";
		}
		
		if(is_array($condition))
		{
			$condition=" WHERE " . implode(" AND ",$condition);
		}

		$que="SELECT * FROM ".$tblpref."content_master $condition $condition2"; 

			$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby]."&mode=".$mode;
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
			$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  							in sequence
			$srnum=explode(",",$srnum);
			$count=$srnum[0];
?>

<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" >
	<tr><td align="center" ><b><h2>FAQ Management List</h2></b></td></tr>
	<TR>
    <TD valign="top" width="65%" >
	<TABLE class="tbborder"	cellspacing="0" cellpadding="0" border="0" width="80%" align="center" valign="top">
				<TR>
				<Th valign="top" width="75%" >
					<TABLE class="tbborder"	cellspacing="1" cellpadding="0" border="0" width="100%" align="center" valign="top">
					<FORM NAME="frmcms" METHOD="POST" ACTION="index.php?mode=search">
					<tr >
					<th colspan="2" align="center" ><b>&nbsp;Search</b></font>
					</th></tr>

					<TR   bgcolor="<?php  echo $bg_color?>">
					<TD align="right" class="tbborder">Name :</FONT></TD>
					<TD align="left" style="padding-left:5px;" class="tbborder">
					<select NAME="txtname" style="width:400px" >
					<option value="" >Please Select</option>			
					<?php  while($row=mysql_fetch_array($result))
					{?>
					<option value="<?php  echo $row[cms_title]?>" <?php if($row[cms_title]==$typev){?>selected <?php }?>><?php  echo $row[cms_title]?> </option>
					<?php }?>
					</TD>
					</TR>
					<? /* echo $typev; */?>
			
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
				<?php if($flag=="update"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">FAQ is Updated Successfully.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="add"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">FAQ is Added Successfully.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="exits"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">FAQ already exits.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="del"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">FAQ is deleted Successfully.</TD>
				</TR>
				<?php  } ?>	
	<TR>
	<TD align="right">
	</TD></TR>
	<TR>
	<TD align="right" height=20>
	</TD></TR>

	<TR>
	<TD align="right">
	 <a href="add_faq.php?mode=add" class="menu">ADD NEW</a> 
	</TD>
	</TR>

	<TR>
	<TD align="right">
	 <TABLE cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse;">
		<TD align="center" width="80%" class="tdclass1"><?php  echo $show_pagination?></TD>
		<TD align="right"  width="20%" class="tdclass1"><?php  echo $show_status?></TD>
	</table>
	</TD>
	</TR>

	<TR>
	<Th align="center">
	
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		<TR>
			<th width="10%" style="padding-left:10px;">Sr.no</th>
			<th align="center"><A HREF="?sorton=faq_title&sortby=<?php 
			if($_GET[sorton]=="faq_title" && ($_GET[sortby])=="desc") 
				echo "asc";
			else
				echo "desc";
				?>" class="nav">Title</th>

			<th align="center">Action</th>
			
		</TR>
		<?php $a=1;
		while($row_category=mysql_fetch_array($page_res)){ 
			$id=$row_category[cms_id];$count ++;?>
			<TR width="100%">
			<TD width="10%" style="padding-left:20px;" class="tbborder"><?php  echo $count?></TD>
			<TD  align="left" style="padding-left:10px;" class="tbborder"> <?php  echo $row_category[cms_title]?></TD>			
			<TD width="15%"  align="center" class="tbborder"><a href="add_faq.php?mode=edit&faqid=<?php  echo $id?>" class="menu"> Edit</a>&nbsp; |&nbsp;<a href="submit_faq.php?did=<?php  echo $row_category[cms_id]?>&mode=del" class="menu" onClick='if(confirm("Do You Want To Delete This ?")){return true;}else{return false;}'> Delete</a></TD>
		</TR>
		<?php $a++;}?>
		
	</table>
</td>
</tr>
</table>

<?php admin_footer("../../")?>