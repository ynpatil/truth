<?php 
	include("common/config.php");
	include("common/app_function.php");

	$memsur = $_REQUEST['value'];

	$query = "select mem_first_name,mem_sur_name,mem_id from ".$tblpref."member_reg where mem_sur_name LIKE '%$memsur%'  AND mem_id!=1 AND mem_status='Active'";

	if(!($res = mysql_query($query))){	echo $query.mysql_error();	exit(); }
?>
<select name="refname" id="refname" class="regist" onchange="changeref(this.value);">
<option value="1">Truth-Junction</option>
<?
while($row = mysql_fetch_array($res)){
$qcount = "select count(mem_refname) from ".$tblpref."member_reg where mem_id = '$row[mem_id]'";
if(!($countres = mysql_query($qcount))){	echo $qcount.mysql_error();	exit(); }
$resnumrow = mysql_num_rows($countres);
if($resnumrow < 35)
{
?>
<option value="<?=$row[mem_id]?>"><? echo $row[mem_first_name]." ".$row[mem_sur_name];?></option>
<?  }
} 
?>
</select>
