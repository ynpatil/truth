<?
include("../../common/config.php");

if($mode=="del")
{
				   
		$query="DELETE FROM ".$tblpref."services_category  where cat_id ='$id'";
		if(!($result=mysql_query($query))){echo mysql_error($query); exit;}
		
		header("Location:index.php?flag=del");
		exit;

}
$name=addslashes($name);
if($id=="")
{
		$query="SELECT * FROM ".$tblpref."services_category  WHERE cat_name ='".trim($name)."'";
		if (!($rs=mysql_query($query))) { echo $query.mysql_error(); exit; }
		$recordcount=mysql_num_rows($rs);
		if($recordcount > 0) 
		{
			header("location:pub_cat_add.php?flag=exist");
			exit;
		}

		$query_add="INSERT INTO ".$tblpref."services_category SET
		cat_name='$name'";
		if(!($result_add=mysql_query($query_add))){echo $query_add.mysql_error(); exit;}
		header("Location:index.php?flag=add");
		exit;

}
if($id!="")
{
		$query="SELECT * FROM ".$tblpref."services_category  WHERE cat_name ='".trim($name)."' AND cat_id!='$id'";
		if (!($rs=mysql_query($query))) { echo $query.mysql_error(); exit; }
		$recordcount=mysql_num_rows($rs);
		if($recordcount > 0) 
		{
			header("location:pub_cat_add.php?flag=exist");
			exit;
		}

		$qadd="UPDATE ".$tblpref."services_category set
		cat_name='$name'
		where cat_id= '$id'";
		if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
		header("Location:index.php?flag=edit");
		exit;
}
?>