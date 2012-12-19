<?php
session_start();
include("common/config.php");
include ("common/app_function.php");

$txtdate = date('Y-m-d h:i:s');

if($mode=="del")
{		   
	$query="DELETE FROM ".$tblpref."exp_ser_docup where esdoc_id ='$id'";
	if(!($result=mysql_query($query))){echo mysql_error($query); exit;}
	header("Location:truth-junction-service-upload.php?flag=del&expid=$expid&name=$name");
	exit;
}

if($id!="")
{
	$qadd="INSERT INTO ".$tblpref."exp_ser_docup set 
	esdoc_expert_id='$_SESSION[exp_id]',
	esdoc_service_id='$id',
	esdoc_name='$txtsername',
	esdoc_date ='$txtdate'";
	if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
	$eid = mysql_insert_id();

	if($_FILES["uploaddoc"]["name"]!="") 
	{
			$fileload = $_FILES["uploaddoc"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="docservice_".$id.".".$file_ext[1];
			$destpath="tjtmp/".$myattach;

			copy($_FILES["uploaddoc"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."exp_ser_docup SET esdoc_upload ='".$myattach."' WHERE esdoc_id =".$eid;
			if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
	}
	
	header("Location:truth-junction-service-upload.php?flag=add&expid=$id&name=$txtname");
	exit;
}


?>