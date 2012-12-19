<?php
session_start();
include("common/config.php");
include ("common/app_function.php");

$txtdate = date('Y-m-d h:i:s');
$content = addslashes($linkcontect);

if($mode=="del")
{		   
	$query="DELETE FROM ".$tblpref."expert_servies where exps_id ='$id'";
	if(!($result=mysql_query($query))){echo mysql_error($query); exit;}

	$querydoc="DELETE FROM ".$tblpref."exp_ser_docup where esdoc_service_id ='$id'";
	if(!($resultdoc=mysql_query($querydoc))){echo mysql_error($querydoc); exit;}
	
	header("Location:truth-junction-exp-service.php?flag=del");
	exit;
}

if($id=="")
{
	$qadd="INSERT INTO ".$tblpref."expert_servies set 
	exps_expert_id='$_SESSION[exp_id]',
	exps_date='$txtdate',
	exps_name='$txtsername',
	exps_desc ='$content',
	exps_status ='Active'";
	if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
	$id = mysql_insert_id();

	if($_FILES["txtserviceimage1"]["name"]!="") 
	{
			$fileload = $_FILES["txtserviceimage1"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="serv_img1_exp_".$id.".".$file_ext[1];
			$destpath="tjtmp/".$myattach;

			copy($_FILES["txtserviceimage1"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."expert_servies SET exps_image_one ='".$myattach."' WHERE exps_id =".$id;
			if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
	}
	if($_FILES["txtserviceimage2"]["name"]!="") 
	{
			$fileload = $_FILES["txtserviceimage2"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="serv_img2_exp_".$id.".".$file_ext[1];
			$destpath="tjtmp/".$myattach;

			copy($_FILES["txtserviceimage2"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			$updatepicture = "UPDATE ".$tblpref."expert_servies SET exps_image_two ='".$myattach."' WHERE exps_id =".$id;
			if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
	}

	header("Location:truth-junction-exp-service.php?flag=add");
	exit;
}
else
{
		$qadd="UPDATE ".$tblpref."expert_servies set
		exps_name='$txtsername',
		exps_desc='$content'
		where exps_id='$id'";
		if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); 
		exit;}

		if($_FILES["txtserviceimage1"]["name"]!="") 
		{
				$fileload = $_FILES["txtserviceimage1"]["name"];
				$file_ext = explode(".",$fileload);
				$myattach="serv_img1_exp_".$id.".".$file_ext[1];
				$destpath="tjtmp/".$myattach;

				copy($_FILES["txtserviceimage1"]["tmp_name"],$destpath) or die("Unable to upload doc file");
				$updatepicture = "UPDATE ".$tblpref."expert_servies SET exps_image_one ='".$myattach."' WHERE exps_id =".$id;
				if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
		}
		if($_FILES["txtserviceimage2"]["name"]!="") 
		{
				$fileload = $_FILES["txtserviceimage2"]["name"];
				$file_ext = explode(".",$fileload);
				$myattach="serv_img2_exp_".$id.".".$file_ext[1];
				$destpath="tjtmp/".$myattach;

				copy($_FILES["txtserviceimage2"]["tmp_name"],$destpath) or die("Unable to upload doc file");
				$updatepicture = "UPDATE ".$tblpref."expert_servies SET exps_image_two ='".$myattach."' WHERE exps_id =".$id;
				if(!($result = mysql_query($updatepicture))){echo $updatepicture.mysql_error();exit;}
		}

		header("Location:truth-junction-exp-service.php?flag=edit");
		exit;
}


?>