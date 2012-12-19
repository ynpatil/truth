<?php
	@reset ($_GET); 
	while (list ($key, $val) = @each ($_GET)) $$key=$val; 

	@reset ($_POST); 
	while (list ($key, $val) = @each ($_POST)) $$key=$val; 

	@reset ($_SESSION); 
	while (list ($key, $val) = @each ($_SESSION)) $$key=$val; 

	@reset ($_COOKIE); 
	while (list ($key, $val) = @each ($_COOKIE)) $$key=$val; 

	//database connections LOCAL
	$hostname="localhost";
	$serveruser="root";
	$serverpass="";
	$databasename="truthjunction";

	//database connections Remote
	/*$hostname="localhost";
	$serveruser="crasaor";
	$serverpass="Bridget108";
	$databasename="crasaor_crasadb";
	*/
	$tblpref="truth_";

	$pagesize=10;
	if(!$connection = mysql_connect($hostname, $serveruser, $serverpass))
		echo mysql_error();
	if(!$db = mysql_select_db($databasename)) 
		echo mysql_error();

	global $siteName,$siteShortName,$sitefont;
	$sitename="www.truth-junction.co.bw";
	$siteShortName="willy";

	$curlanguage="common/". $curlanguage. ".php";
	$path1="http://demo.weblogic.co.bw/local/truth-junction/";
?>