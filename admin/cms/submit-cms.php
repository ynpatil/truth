<?php

include("../../common/app_function.php");
include("../../common/config.php");
$content=addslashes($linkcontect);
$curdate=date("Y-m-d");

if($flag=="del")
{
	$query="Delete from ".$tblpref."content_master where cms_id='$id'";
	if(!($result=mysql_query($query))){echo mysql_error($query); exit;}
	
	header("Location:index.php?flag=del");
	exit;
}

if($id=="")
	{
		if($cmscat != "" && $parent =="") {
			$qadd="INSERT INTO ".$tblpref."content_master set 
			cms_title='$name',
			cms_desc='$content',
			cms_page_title='$wtitle',
			cms_date='$curdate',
			cms_sitelink='truth-junction-content.php'";
		}

		else if($cmscat == "" && $parent !="") {
			if($parent != "Course") {
				$parent = explode("_", $parent);
				$type = $parent[0];
				$parent = $parent[1];
			}
			else {
				$type = $parent;
			}
		
			$qadd="INSERT INTO ".$tblpref."content_master set 
			cms_title='$name',
			cms_desc='$content',
			cms_date='$curdate',
			cms_sitelink='truth-junction-content.php',
			cms_parent='$parent'";
		}
		else {
			header("Location:cms-add.php?flag=one");
			exit;
		}
			if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
			header("Location:index.php?flag=add");
			exit;		
	}
if($id!="")
	{
	
			if($cmscat != "" && $parent =="") {
			$qadd="UPDATE ".$tblpref."content_master set 
			cms_title='$name',
			cms_desc='$content',
			cms_page_title='$wtitle',
			cms_date='$curdate',
			cms_sitelink='truth-junction-content.php' where cms_id='$id'";
		}
		else if($cmscat == "" && $parent !="") {
		
			if($parent != "Course") {
				$parent = explode("_", $parent);
				$type = $parent[0];
				$parent = $parent[1];
			}
			else{
				$type = $parent;
			}
			$qadd="UPDATE ".$tblpref."content_master set 
			cms_title='$name',
			cms_desc='$content',
			cms_date='$curdate',
			cms_sitelink='truth-junction-content.php',
			cms_parent='$parent' where cms_id='$id'";
		}
		else {
			header("Location:cms-add.php?flag=one");
			exit;
		}
		
		if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
		header("Location:index.php?flag=edit");
		exit;
	}

?>