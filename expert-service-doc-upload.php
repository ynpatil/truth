<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	include("common/fckeditor/fckeditor_php5.php");

	$query="select * from ".$tblpref."expert_servies where exps_id='$id'"; 
	if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
	$row_add=mysql_fetch_array($result);
?>
<style>
.table-block table{ border-collapse:collapse;}
.table-block table thead{ background-color:#383838; border-collapse:collapse; color:#FFF; line-height:20px; text-align:left;}
.table-block table thead, td.head1,th.head1 { padding:3px 8px 3px 12px; border:1px solid #bbbaba; }
.table-block table thead th.date{ padding-left:12px; text-align:center; width:70px;}
.table-block table tbody tr{ background-color:#cfcfcf; border-collapse:collapse;}
.table-block table tbody tr.light{ background-color:#F5F5F5;}
.warning {font-family: Arial, Arial, helvetica, geneva, sans-serif; font-size: 9pt; font-weight: bold; color: #FF0000}
</style>
<html>
<body>
<FORM NAME="frmserviceadd" METHOD="POST" ACTION="submit-doc-upload.php" enctype="multipart/form-data" onsubmit="return val()" target="_parent">
<div class="table-block" style=" font-size:12px;">
		<table width="100%">
		<thead>
		<tr>
			<th class="head1" align="center" colspan="2">Upload Your Document</th>
		</tr>
		</thead>
		<tbody>
			<tr class="light" height="40">
				<td class="head1" width="30%">Document Name :</td>
				<td class="head1"><input value="<?=$row_add[exps_name]?>" type="text" name="txtsername" id="txtsername" onchange="empty(this.id);">
				<br><label id='etxtsername' class='warning'></label>
				</td>
			</tr>

			
			<tr class="light" height="40">
				<td class="head1">Upload Document :</td>
				<td class="head1"><input type="file" name="uploaddoc">
				<?if($row_add[exps_image_one] !=""){?>						
				<a href="#" ONCLICK="open('tjtmp/<?=$row_add[exps_image_one]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')">View Image<a> 
				<?}?><br>
				<label class='warning'>Picture should be less than 1 MB </label>
				</td>
			</tr>
		

			<tr class="light" height="40">
				<td class="head1" colspan="2" align="center">
				<input type="hidden" value="<?=$expid?>" name="id" >
				<input type="hidden" value="<?=$name?>" name="txtname" >
				<input type="submit" value="Submit" name="submit"></td>
			</tr>
		</tbody>
		</table>
 </div>
 </form>
 </body>
 </html>

<script language="javascript">
empty = function (id)
{
	eid = "e" + id;
	var obj = document.getElementById(id).value;
	
 	if (obj != "")
	{
		document.getElementById(eid).innerHTML = "";
		return;
	}	
	else
	{
		document.getElementById(eid).innerHTML = "Please Enter!";	
		document.getElementById(id).focus();
	}
}
function val()
{
	var warning = true;
	if (document.frmserviceadd.txtsername.value=="")
	{ 	
  		document.getElementById('etxtsername').innerHTML = "Please Enter Document Name !";
		document.frmserviceadd.txtsername.focus();
		warning =  false;
	}
		
	return warning;
}
</script>
