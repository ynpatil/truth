<?php  session_start();
   include("../../common/config.php");

	$txtdate11=date("Y-m-d");

	$content=addslashes($linkcontect);
	
	if($txtmode=="add")
	{
		//add new record txtmode  is a hidden text box in cms_add.php
		$name=addslashes($txtname);
		
		$query="SELECT * FROM ".$tblpref."content_master WHERE cms_title='$txtname' AND cms_type='faq'";
		if(!($result=mysql_query($query))){echo $query.mysql_error(); exit;}
		$row_count=mysql_num_rows($result);
		if($row_count >0)
		{
			header("LOCATION:index.php?flag=exits");
			exit;
		}
		else
		{
			$qadd="INSERT INTO ".$tblpref."content_master (cms_title,cms_desc,cms_date,cms_type) VALUES('$name','$content','$txtdate11','faq')";
			if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
			
			$faq_id=mysql_insert_id();
		
			header("Location:index.php?flag=add&mode=$status");
			exit;
		}
	}

	if($txtmode=="edit")
	{
		//update record txtmode,$txtid  are hidden text boxes in cms_add.php
			$name=addslashes($txtname);
			$name1=addslashes($txtname1);
			$name2=addslashes($txtname2);
			//$venue=trim($txtvenue);
			$qadd="UPDATE ".$tblpref."content_master SET 
			cms_title='$name',
			cms_desc='$content',
			cms_type='faq',
			cms_date='$txtdate11'
			WHERE cms_id='$txtid'";
			if(!($res=mysql_query($qadd))){echo $qadd.mysql_error(); exit;}
		 
			header("Location:index.php?flag=edit&mode=$status");
			exit;		
	}
	
	if($mode=="del")
	{
		$query="DELETE FROM ".$tblpref."content_master WHERE cms_id ='$did'";
		if(!($result=mysql_query($query))){echo mysql_error($query); exit;}
	
		header("Location:index.php?flag=del&mode=$status");
		exit;
	}
	?>
		