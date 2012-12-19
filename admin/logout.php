<?
include("../common/config.php");
	 	
		 $_SESSION[username] = "";
		 @session_destroy();
		 header("location:index.php");
		  exit;

?>