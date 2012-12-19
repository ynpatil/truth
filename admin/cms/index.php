<?php
session_start();
include("../../common/config.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
exit();
}

$typetxt=$txtname; 
if($txtname!="")
{
	$condition[]="cms_id='$txtname'";
}
$txtdate1=dateformate($txtdate);

if($txtdate!="")
{
	$condition[]="cms_date='$txtdate1'";
}

if(is_array($condition))
{
	$condition= " WHERE ".implode(" AND ",$condition);
}

admin_header("../../","CMS Management");
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
		  $('#datepicker').daterangepicker({
			posX:470,
			posY: 180
		  }); 
	 });
</script>

<style type="text/css">
.ui-daterangepickercontain {
	top:255px;
	left:448px;
	position: absolute;
	z-index: 999;
}
</style>
<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
  <tr>
    <td align="center" ><b>
      <h2>Content Management System</h2>
      </b></td>
  </tr>
  <tr>
  
  <td valign="top" width="95%" >
  
  <table class="tbborder"	cellspacing="0" cellpadding="0" border="0" width="75%" align="center" valign="top">
    <tr>
    
    <th valign="top" width="75%"><table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" align="center" valign="top">
        <form name="frmcms" method="post" action="index.php">
          <tr>
            <th colspan="2" align="center"><b>&nbsp;Search</b></font></th>
          </tr>
          
          <tr>
            <td align="right" class="tbborder">Page Name :</FONT></td>
            <td align="left" style="padding-left:5px;" class="tbborder"><select name="txtname" style="width:400px;">
			<option value="">---Please Select ---</option>
			<?	$count=1;
				$coursequery="select * from ".$tblpref."content_master WHERE cms_parent = '' ORDER BY cms_id";
				if(!($courseresult=mysql_query($coursequery))){echo mysql_error($coursequery); exit;}
				while($course_row=mysql_fetch_array($courseresult)) {
			?>
			<option value="<?=$course_row[cms_id]?>" <?php if($course_row[cms_id]==$typetxt){?>selected <?}?>><?="$count ".$course_row[cms_title]?></option>
			<?	$count1=1;
				$parentquery="select * from ".$tblpref."content_master WHERE cms_parent = '$course_row[cms_id]'";
				if(!($parentresult=mysql_query($parentquery))){echo mysql_error($parentquery); exit;}
				$num = mysql_num_rows($parentresult);
				while($parent_row=mysql_fetch_array($parentresult)) {
			?>
			<option value="<?=$parent_row[cms_id]?>" <?php if($parent_row[cms_id]==$typetxt){?>selected <?}?>><?="&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1 ".$parent_row[cms_title]?></option>
			<? $count2=1;
			$query3="select * from ".$tblpref."content_master WHERE cms_parent = '$parent_row[cms_id]' ";
			if(!($result3=mysql_query($query3))){echo mysql_error($query3); exit;}
			$num = mysql_num_rows($result3);
			while($schild_row=mysql_fetch_array($result3)) {
			?>
			<option value="<?=$schild_row[cms_id]?>" <?php if($schild_row[cms_id]==$typetxt){?>selected <?}?>><?="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1.$count2 ".$schild_row[cms_title]?></option>
			<? $count2++;} ?>	
			<? $count1++;} ?>
			<? $count++;} ?>
              </select>
            </td>
          </tr>
          <tr>
			<?php if($datepicker!=""){
				$datepicker=dateformate($datepicker);
			}?>
            <td align="right" class="tbborder">Updated Date :</FONT></td>
            <td align="left" style="padding-left:5px;" class="tbborder"><input type="text" value="" name="txtdate" id="datepicker" />
            </td>
          </tr>
          <tr>
            <td align="center" colspan="2" class="tbborder"><input type="submit" value="Search" name="txtsearch" class="mybutton">
              &nbsp;&nbsp;</td>
          </tr>
        </form>
      </table>
      </td>
    </tr>
    
  </table>
  </td>
  </tr>
  
  <tr>
    <td align="center" class="warning">
		<?php if($flag=="edit")
		{
		echo "Record is updated successfully.";
		}
		if($flag=="del")
		{
		echo "Record is deleted successfully.";
		}
		if($flag=="add")
		{
		echo "New record is added successfully.";
		}?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><a href="cms-add.php?mode=add" style="padding-right:15px;"><b>ADD NEW</b></a> </td>
  </tr>
  <tr>
    <td align="right"><table cellspacing="0" cellpadding="0" border="0" width="100%">
        <td align= "center" width="80%" class="tdclass1"><?=$show_pagination ?></td>
        <td align= "right" width="20%"class="tdclass1"><?=$show_status?></td>
      </table></td>
  </tr>
  <tr>
    <th align="center"><table class="tbborder" cellspacing="1" cellpadding="2" border="0" width="100%" id="results">
        <?php if($txtname!="" || $txtdate!="") {?>
        <tr>
          <th>Sr.no</th>
          <th>Name</th>
          <th>Link url</th>
          <th>Action</th>
        </tr>
        <?php 
		$count2=1;
		$query3="select * from ".$tblpref."content_master $condition ORDER BY cms_id";
		if(!($result3=mysql_query($query3))){echo mysql_error($query3); exit;}
		while($schild_row=mysql_fetch_array($result3)) 
		{
		?>
        <tr width="100%">
          <td width="10%" class="tbborder"><?php echo $count2;?></td>
          <td class="tbborder" align="left" width="20%"><?=$schild_row[cms_title]?></td>
          <td class="tbborder" align="left"><?=$path.$schild_row[cms_sitelink]."?cid=".$schild_row[cms_id]?></td>
          <td width="15%" class="tbborder" align="center"><a href="cms-add.php?mode=edit&id=<?=$schild_row[cms_id]?>&parentid=<?=$schild_row[cms_parent]?>" > Edit</a></td>
        </tr>
<? if($txtdate=="")
{?>
        <tr>
          <td colspan="4" class="body"><div id="pageNavPosition"></div></td>
        </tr>
<? } ?>
        <script type="text/javascript">
        var pager = new Pager('results', 5); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
		</script>
    
        <tr>
          <?php $count2++;} }else{ ?>
        <tr>
          <th>Sr.no</th>
          <th>Name</th>
          <th>Link url</th>
          <th>Action</th>
        </tr>
        <?php 
				$count=1;
				$query1="select * from ".$tblpref."content_master WHERE cms_parent = '' ORDER BY cms_id";
				if(!($result1=mysql_query($query1))){echo mysql_error($query1); exit;}
				while($parent_row=mysql_fetch_array($result1)) 
				{
				?>
        <tr width="100%">
        <td width="10%" class="tbborder" ><b>
        <?=$count?>
         </b></td>
          <td class="tbborder" align="left" width="20%"><?=$parent_row[cms_title]?></td>
          <td class="tbborder" align="left"><?=$path.$parent_row[cms_sitelink]."?cid=".$parent_row[cms_id]?></td>
          <td width="15%" class="tbborder" align="center">
          <a href="cms-add.php?mode=edit&id=<?=$parent_row[cms_id]?>&parentid=<?=$parent_row[cms_parent]?>" > Edit</a></td>
        </tr>
        <?php 
				$count1=1;
				$query2="select * from ".$tblpref."content_master WHERE cms_parent = '$parent_row[cms_id]' ORDER BY cms_id";
				if(!($result2=mysql_query($query2))){echo mysql_error($query2); exit;}
				if(mysql_num_rows($result2)>0)
				{
				while($child_row=mysql_fetch_array($result2)) 
				{
				?>
        <tr width="100%">
          <td width="10%" class="tbborder">&nbsp;&nbsp;&nbsp;<?php echo "<b>".$count."</b>.".$count1;?></td>
          <td class="tbborder" align="left" width="20%"><?=$child_row[cms_title]?></td>
          <td class="tbborder" align="left"><?=$path.$child_row[cms_sitelink]."?cid=".$child_row[cms_id]?></td>
          <td width="15%" class="tbborder" align="center">
          <a href="cms-add.php?mode=edit&id=<?=$child_row[cms_id]?>&parentid=<?=$child_row[cms_parent]?>" > Edit</a>
          &nbsp;&nbsp;|&nbsp;&nbsp;<a href='submit-cms.php?flag=del&id=<?=$child_row[cms_id]?>' 
          onclick='if(confirm("Are you sure you want to delete a banner.")) return true; else return false;' class="menu"> Delete</a></td>
        </tr>
        <?php 
				$count2=1;
				$query3="select * from ".$tblpref."content_master WHERE cms_parent = '$child_row[cms_id]' ORDER BY cms_id";
				if(!($result3=mysql_query($query3))){echo mysql_error($query3); exit;}
				if(mysql_num_rows($result3)>0)
				{
				while($schild_row=mysql_fetch_array($result3)) 
				{
				?>
        <tr width="100%">
          <td width="10%" class="tbborder">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo "<b>".$count."</b>.".$count1.".".$count2;?></td>
          <td class="tbborder" align="left" width="20%"><?=$schild_row[cms_title]?></td>
          <td class="tbborder" align="left"><?=$path.$schild_row[cms_sitelink]."?cid=".$schild_row[cms_id]?></td>
          <td width="15%" class="tbborder" align="center"><a href="cms-add.php?mode=edit&id=<?=$schild_row[cms_id]?>&parentid=<?=$schild_row[cms_parent]?>" > Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='submit-cms.php?flag=del&id=<?=$schild_row[cms_id]?>' onclick='if(confirm("Are you sure you want to delete this Row.")) return true; else return false;' class="menu"> Delete</a></td>
        </tr>
        <?php $count2++;} } $count1++;} } $count++;}  ?>
        <!--  -->
        <?php } ?>
      </table>
  <tr>
  <? if($txtdate=="")
{?>
  <tr>
    <td colspan="4" align="center" style=" color:#000000; font-size:14px; font-weight:bold; cursor:pointer;"><div id="pageNavPosition"></div></td>
  </tr>
  <? } ?>
  <script type="text/javascript">
        var pager = new Pager('results', 20); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    </script>
  <tr>
</table>
<br />
</td>
</tr>
<?php admin_footer("../../");?>
