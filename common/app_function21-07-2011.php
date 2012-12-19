<?php
function index_header($title){ session_start(); include("config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to :: Truth Junction :: <?=$title?></title>
<link href="images/truth-logo.ico" rel="shortcut icon" type="image/x-icon" />
<link href="css/style.css" type="text/css" rel="stylesheet"/>
<!-- CSS and SCRIPT used for header menu start here-->
<link rel="stylesheet" type="text/css" href="css/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="css/ddlevelsmenu-topbar.css" />
<script type="text/javascript" src="ddlevelsfiles/ddlevelsmenu.js"></script>

<link href="css/examples.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/jquery-impromptu.js"></script>
<script type="text/javascript" src="js/web.js"></script>

<script type="text/javascript">
function validatesearch(){
	if(document.search.txtsearch.value=="" || document.search.txtsearch.value == "Please Enter Search Text")
	{
		document.search.txtsearch.style.backgroundColor ="#F0D4D3";
		document.search.txtsearch.value="Please Enter Search Text";
		document.search.txtsearch.focus();
		return false;
	}
}
function empty(){
	document.search.txtsearch.value="";
	return false;
}
</script>
<script type="text/javascript">
ddlevelsmenu.setup("ddtopmenubar", "topbar")
</script>
</head>
<body>
<div class="main">
	<!-- BOF Header, Login & Search sec -->
	<div class="header-login">
    	<div class="logo-bg"><a href="index.php"><img src="images/logo.jpg" alt="logo" title="Truth Junction"/></a></div>
        <div class="login-bg">
        	<div class="strip-bg">
            	<div class="icon">
					<? if($_SESSION[exp_id]=="" AND $_SESSION[mem_id]=="" ) { ?>
                	<a href="#" onclick="javascript:logintype();"><img src="images/icon-login.jpg" alt="icon-login" title="Login"/></a>
                    <a href="#" onclick="javascript:login('Expert');"><img src="images/icon-experts.jpg" alt="icon-experts" title="Experts"/></a>
                    <a href="#" onclick="javascript:login('Member');"><img src="images/icon-member.jpg" alt="icon-member" title="Members"/></a>
					<? } ?>

                    <a href="truth-junction-contactus.php"><img src="images/icon-contact.jpg" alt="icon-contact" title="Contact Us"/></a>
                    <a href="index.php"><img src="images/icon-home.jpg" alt="icon-home" title="Home"/></a>
                </div>
                <div class="clear"></div>
                <div class="search-sec">
				<form name="search" action="truth-junction-sitesearch.php" method="POST" onsubmit="return validatesearch();">
                	<input type="text" name="txtsearch"  align="top" class="inpt-txt" onclick="return empty();"/><input type="image" align="top" src="images/btn-search.jpg" title="Search"/>
				</form>
                </div>
                 <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- EOF Header, Login & Search sec -->
	<!-- BOF Top navigation -->
    <div style="background:url(images/nav-bg.jpg) 0 0 repeat-x; height:38px; width:100%;">
        <div id="ddtopmenubar" class="slidetabsmenu">
          <ul>
			<li><a href="index.php"><span>Home</span></a></li>
			<? show_menu(2, $connection, $db, $tblpref ); ?>
			<? if($_SESSION[exp_id]=="") { ?>
            <li><a <? if($_SESSION[mem_id]=="") { ?> href="#" onclick="errmsg();" <? } else { ?>href="truth-junction-services.php" <? } ?>><span>Services</span></a></li>
			<? } ?>
            <? show_menu (3, $connection, $db, $tblpref ); ?>
            <li><a href="truth-junction-faq.php"><span>FAQ</span></a></li>
			<? if($_SESSION[exptype]=="") { ?>
            <li><a href="#" onclick="javascript:logintype();"><span>Login</span></a></li>
			<? } ?>
            <li class="no-img"><a href="truth-junction-contactus.php"><span>Contact US</span></a></li> 
          </ul>
    	</div>
		<? if($_SESSION[exp_id]!="") { ?>
        <div style="float:right; padding:5px 6px 4px 0px;"><a href="truth-junction-expert-index.php"><img src="images/btn-page.jpg" alt="page" title="My Page"/></a></div>
		<? } ?>
		<? if($_SESSION[mem_id]!="") { ?>
        <div style="float:right; padding:5px 6px 4px 0px;"><a href="truth-junction-member-index.php"><img src="images/btn-page.jpg" alt="page" title="My Page"/></a></div>
		<? } ?>
    </div>

    <!-- BOF Content Area -->
   <div class="content-area">
    	<div class="left-sec">
        	<div class="sub-left">
            	<!-- BOF Banner Area -->
            	<div class="banner"><img src="images/banner-img1.jpg" alt="banner-img" title="Banner"/></div>
                <div class="clear"></div>
                <!-- EOF Banner Area -->
<? }
function index_footer(){ include("config.php");?>
 <div class="right-sec">
        	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="redround-box-bg" align="left">
            <tr>
        		<td valign="top">
                  <div class="redround-box-t">
                  	<div class="pad8" style="padding-bottom:50px;">
                        <h2><span>Login</span></h2>
                        <!-- BOF Members Login -->
                        <div>
                        <h2 style="margin:12px 0;">Members Login</h2>
						<form action="truth-junction-member-login.php" method="POST" >
                        <table width="99%" cellpadding="0" cellspacing="0" border="0" style="padding-left:8px;">
						<? if($_REQUEST[msgmem]=="wrg" || $_REQUEST[msgmem]=="inactive") {?>
						<tr><td colspan="2" align="center" class="error">Invalid Member Login Detail</td></tr>
						<? } ?>
                        <tr>
                        	<td width="100" align="left" style="padding:8px 0;">User Name :</td>
                            <td><input type="text" name="username" style="background-color:#eee; border:1px solid #d1cfcf; width:148px; height:20px;"/></td>
                        </tr>
                        <tr>
                        	<td style="padding:8px 0;">Password :</td>
                            <td><input type="password" name="password" style="background-color:#eee; border:1px solid #d1cfcf; width:148px; height:20px;"/></td>
                        </tr>
                        <tr>
                        	<td style="padding:10px 0;">&nbsp;</td>
                            <td><input type="image" src="images/btn-login.jpg"/></td>
                        </tr>
                        <tr>
                        	<td style="padding:10px 0;" class="more"><a href="truth-junction-memreg.php">Register Now</a></td>
                            <td align="right" class="forget"><a href="javascript:forgotmem();">Forget Password ?</a></td>
                        </tr>
                        </table>
						</form>
                        </div>
                        <!-- EOF Members Login -->
                        
                        <div style="background:url(images/seprator-div.jpg) 0 0 repeat-x; height:22px; width:100%; margin:30px 0;"></div>
                        
                        <!-- BOF Experts Login -->
                        <div>
                        <h2 style="margin:12px 0;">Experts Login</h2>
						<form action="truth-junction-expert-login.php" method="POST" >
                        <table width="99%" cellpadding="0" cellspacing="0" border="0" style="padding-left:8px;">
						<? if($_REQUEST[msg]=="wrg" || $_REQUEST[msg]=="inactive") {?>
						<tr><td colspan="2" align="center" class="error">Invalid Expert Login Detail</td></tr>
						<? } ?>

                        <tr>
                        	<td width="100" align="left" style="padding:8px 0;">User Name :</td>
                            <td><input type="text" name="username" style="background-color:#eee; border:1px solid #d1cfcf; width:148px; height:20px;" value=""/></td>
                        </tr>
                        <tr>
                        	<td style="padding:8px 0;">Password :</td>
                            <td><input type="password" name="password" style="background-color:#eee; border:1px solid #d1cfcf; width:148px; height:20px;" value=""/></td>
                        </tr>
                        <tr>
                        	<td style="padding:10px 0;">&nbsp;</td>
                            <td><input type="image" src="images/btn-login.jpg"/></td>
                        </tr>
                        <tr>
                        	<td style="padding:10px 0;">&nbsp;</td>
                            <td align="right" class="forget"><a href="#" onclick="forgot();">Forget Password ?</a></td>
                        </tr>
                        </table>
						</form>
                        </div>
                        <!-- EOF Experts Login -->
                        
                    </div>
                  </div>
                </td>
            </tr>
            </table>
        </div>
      <div class="clear"></div>
    </div>
    <!-- BOF Content Area -->
    
    <!-- BOF Footer Area -->
    <div class="foot-area">
    	<div class="foot-nav">
             <ul>
                <li><a href="index.php">Home</a><span>|</span><a href="truth-junction-content.php?cid=2">About us</a><span>|</span><a <? if($_SESSION[mem_id]=="") { ?> href="javascript:errmsg();"  <? } else { ?>href="#" <? } ?>>Services</a><span>|</span><a href="truth-junction-content.php?cid=3">Commission Income</a><span>|</span><a href="truth-junction-faq.php">FAQ</a><span>|</span><a href="#" onclick="javascript:logintype();">Login</a><span>|</span><a href="truth-junction-contactus.php">Contact Us</a></li>
            </ul>
          <div class="clear"></div>  
        </div>
        
        <div class="copyright">
        	<p class="left">Copyright &copy; 2011, All Rights Reserved.</p>
            <p class="right"><a onclick="window.open(this.href,'newwin'); return false;" href="http://www.weblogic.co.bw/">Designed and Developed by Weblogic</a></p>
        </div>
        <div class="clear"></div>
    </div>
    <!-- BOF Footer Area -->
    
    <div class="clear"></div>
</div>

</body>
</html>
<? }
function index_footer_mem_exp()
{
 include("config.php");?>
 <div class="right-sec">
        	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="redround-box-bg" align="left">
            <tr>
        		<td valign="top">
                  <div class="redround-box-t">
                  	<div class="pad8" style="padding-bottom:50px;">
                        <h2><span>My Expert Panel</span></h2>
              			<table width="100%">
						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('prof')"><strong>Update Profile</strong></a></td></td></tr>
						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('serv')" ><strong>Service Posted</strong></a></td></td></tr>
						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="logout.php"><strong>Logout</strong></a></td></td></tr>
						</table>
                    </div>
                  </div>
                </td>
            </tr>
            </table>
        </div>

		 <div class="right-sec">
        	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="redround-box-bg" align="left">
            <tr height="330">
        		<td valign="top">
                  <div class="redround-box-t">
                  	<div class="pad8" style="padding-bottom:50px;">
                        
					<table width="100%">
					<tr>
					<td height="22" align="left" style="padding-left:10px;">
					<?
					$queryexp="select * from ".$tblpref."expert where exp_id='$_SESSION[exp_id]'"; 
					if(!($resultexp=mysql_query($queryexp))){ echo $queryexp.mysql_error(); exit;}
					$row_expert=mysql_fetch_array($resultexp);	

					?>
					<h4> You are the expert of 
					<? 
					$querycat="SELECT * FROM ".$tblpref."services_category WHERE cat_id = '$row_expert[exp_service_area_id]'";
					if(!($resultcat=mysql_query($querycat))){ echo $querycat.mysql_error(); exit;}
					$resultcat = mysql_fetch_array($resultcat);
					echo $resultcat[cat_name]; ?>
					!!!!</h4>
						</td></tr>
						</table>
                    </div>
                  </div>
                </td>
            </tr>
            </table>
        </div>
      <div class="clear"></div>

    </div>
    <!-- BOF Content Area -->
    
    
    <!-- BOF Footer Area -->
    <div class="foot-area">
    	<div class="foot-nav">
            <ul>
                <li><a href="index.php">Home</a><span>|</span><a href="truth-junction-content.php?cid=2">About us</a><span>|</span><a href="truth-junction-content.php?cid=3">Commission Income</a><span>|</span><a href="truth-junction-faq.php">FAQ</a><span>|</span><a href="truth-junction-contactus.php">Contact Us</a><span>|</span><a href="truth-junction-expert-index.php">My Page</a></li>
            </ul>
          <div class="clear"></div>  
        </div>
        
        <div class="copyright">
        	<p class="left">Copyright &copy; 2011, All Rights Reserved.</p>
            <p class="right"><a onclick="window.open(this.href,'newwin'); return false;" href="http://www.weblogic.co.bw/">Designed and Developed by Weblogic</a></p>
        </div>
        <div class="clear"></div>
    </div>
    <!-- BOF Footer Area -->
    
    <div class="clear"></div>
</div>

</body>
</html>
<script type="text/javascript">
change = function(flag) {

	$("#expertpanel").toggle("slow");

	setTimeout("changedetail('"+flag+"')", 1000);

	$("#expertpanel").toggle("slow");
	
	setTimeout("scrollf()", 1000);
}


changedetail = function(flag)
{

	if(flag=='prof')
	{
		$.ajax({ 
		type: "POST",
		url: "profile-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}

	if(flag=='serv')
	{
		$.ajax({ 
		type: "POST",
		url: "services-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}

}

scrollf = function() {
$("#expertpanel").html("<div style='width:469px; height: 409px; margin:0px; background:url(images/blkbg.jpg) no-repeat left top; padding:160px 140px 0 140px;'><img src='images/loading.gif'/></div>");
}
</script>

<? }
function index_footer_member()
{
 include("config.php");?>
 <div class="right-sec">
        	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="redround-box-bg" align="left">
            <tr>
        		<td valign="top">
                  <div class="redround-box-t">
                  	<div class="pad8" style="padding-bottom:3px;">
                        <h2><span>My Member Panel</span></h2>
              			<table width="100%">

						<tr bgcolor="#F6462E"><td align="center">
						<?
						$query="select mem_upload from ".$tblpref."member_reg where mem_id='$_SESSION[mem_id]'"; 
						if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
						$row_add=mysql_fetch_array($result);
						if($row_add[mem_upload]=="")
						{
						?>
						<img src="tjtmp/no-img.jpg" width="180" height="160" alt="">
						<? } else { ?>
						<img src="tjtmp/<?=$row_add[mem_upload]?>" width="180" height="160" alt="">
						<? } ?>

						</td></tr>

						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('prof')"><strong>Update Profile</strong></a></td></tr>

						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('pay')"><strong>Payment history</strong></a></td></tr>

						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('com')"><strong>Commission history</strong></a></td></tr>

						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('due')"><strong>Payments Due </strong></a></td></tr>

						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="#" onclick="change('ref')"><strong>Referred Members  </strong></a></td></tr>
					
						<tr bgcolor="#F6462E"><td height="22" align="left" style="padding-left:10px;"><a style="color:white;" href="logout.php"><strong>Logout</strong></a></td></tr>
						</table>
                    </div>
                  </div>
                </td>
            </tr>
            </table>
		
	  <? if($serviceid!="") { ?>       
      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="redround-box-bg" align="left">
            <tr height="330">
        		<td valign="top">
                  <div class="redround-box-t">
                  	<div class="pad8" style="padding-bottom:10px;">
					  <h2><span>Document Download</span></h2>
                        
						<table width="100%">
						<? 	
						$queser="SELECT * FROM ".$tblpref."exp_ser_docup WHERE esdoc_service_id='$serviceid' ORDER BY esdoc_date DESC";
						if (!($servres = mysql_query($queser))) { echo "FOR QUERY: $queser<BR>".mysql_error();exit;}
						
						?>
						<tr>
						<td align="left" style="padding-left:10px;">
						<!-- 	<?=$rowser[esdoc_upload]?> -->
						<table width="98%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                        	<td valign="top" class="light-bluebg" width="48%">
                                            	<table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                	<td><h3 class="icon-posting">Posting</h3></td>
                                                </tr>
                                                <tr>
                                                	<td valign="top" class="post-date">
                                                        <ul>
														<?
														while($rowser = mysql_fetch_array($servres))
														{	
															$txtdate1[] = $rowser[esdoc_date];
														?>
								<li><a href="download.php?doc=<?=$rowser[esdoc_upload]?>"><?=$rowser[esdoc_name]?></a></li>
															
														<? } ?>
                                                            
                                                    	</ul>
                                                    </td>
                                                </tr>
                                                </table>
                                            </td>

                                            <td valign="top" class="light-bluebg">
                                            	<table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                	<td><h3 class="date">Date</h3></td>
                                                </tr>
                                                <tr>
                                                	<td valign="top" class="post-date">
                                                        <ul>
                                                        <?
														if(is_array($txtdate1))
														{
														foreach($txtdate1 AS $val)
														{
														?>
														<li>
														<? $txtd = explode(" ",$val);
															echo dateformate($txtd[0]);
														?></li>
														<? } } ?>
                                                           
                                                    	</ul>
                                                    </td>
                                                </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </table>
						</td></tr>
						
						</table>
                    </div>
                  </div>
                </td>
            </tr>
            </table>
		<? } ?>
        </div>
      <div class="clear"></div>

    </div>
    <!-- BOF Content Area -->
    
    
    <!-- BOF Footer Area -->
    <div class="foot-area">
    	<div class="foot-nav">
            <ul>
                <li><a href="index.php">Home</a><span>|</span><a href="truth-junction-content.php?cid=2">About us</a><span>|</span><a href="#">Services</a><span>|</span><a href="truth-junction-content.php?cid=3">Commission Income</a><span>|</span><a href="truth-junction-faq.php">FAQ</a><span>|</span><a href="truth-junction-contactus.php">Contact Us</a><span>|</span><a href="truth-junction-member-index.php">My Page</a></li>
            </ul>
          <div class="clear"></div>  
        </div>
        
        <div class="copyright">
        	<p class="left">Copyright &copy; 2011, All Rights Reserved.</p>
            <p class="right"><a onclick="window.open(this.href,'newwin'); return false;" href="http://www.weblogic.co.bw/">Designed and Developed by Weblogic</a></p>
        </div>
        <div class="clear"></div>
    </div>
    <!-- BOF Footer Area -->
    
    <div class="clear"></div>
</div>

</body>
</html>
<script type="text/javascript">
change = function(flag) {

	$("#expertpanel").toggle("slow");

	setTimeout("changedetail('"+flag+"')", 1000);

	$("#expertpanel").toggle("slow");
	
	setTimeout("scrollf()", 1000);
}


changedetail = function(flag)
{

	if(flag=='prof')
	{
		$.ajax({
		type: "POST",
		url: "member-profile-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}

	if(flag=='pay')
	{
		$.ajax({
		type: "POST",
		url: "mem-payment-history-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}

	if(flag=='com')
	{
		$.ajax({
		type: "POST",
		url: "mem-commission-history-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}
	if(flag=='due')
	{
		$.ajax({
		type: "POST",
		url: "mem-due-payment-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}
	
	if(flag=='ref')
	{
		$.ajax({
		type: "POST",
		url: "mem-referred-mem-ajax.php",
		cache: false,
		success: function(msg){
			$("#expertpanel").html(msg);
		}
		});
	}

}

scrollf = function() {
$("#expertpanel").html("<div style='width:469px; height: 409px; margin:0px; background:url(images/blkbg.jpg) no-repeat left top; padding:160px 140px 0 140px;'><img src='images/loading.gif'/></div>");
}
</script>

<?php
}
function admin_header($path='',$title=''){?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to the Truth-Junction~: Admin : <?=$title?> :~</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=$path?>css/master.css" rel="stylesheet" type="text/css">
<link href="<?=$path?>images/truth-logo.ico" rel="shortcut icon" type="image/x-icon" />

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
     }
-->
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="background:url(<?=$path?>images/header-bg.jpg) 0 0 repeat-x; height:136px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"  style="background:url(<?=$path?>images/header-logo-bg.jpg) 0 0 no-repeat; height:136px;">
          <tr>
            <td  align="center" valign="middle"><img src="<?=$path?>images/logo.jpg" alt="" /></td>
			 <td width="380" align="left" valign="middle">&nbsp;</td>
            <td width="624" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
        <td bgcolor="#d0d0d0" height="5"></td>
      </tr>
  <tr>
    <td align="left" valign="top" height="100%" >
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
<? } function admin_nav($path=''){
session_start();$usertype=$_SESSION[user_type];?>
<td width="240"  align="left" valign="top"  bgcolor="#E63A22"><table  height="100%" border="0" cellspacing="0" cellpadding="0" width="100%" >
  <tr>
    <td width="22%" height="375" align="left" valign="top" bgcolor="#E63A22">
	<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
    <tr><td>&nbsp;</td></tr>
        <tr>
          <td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="navlinks"><a href="<?=$path?>admin/home.php" class="navlinks">Home</a></td>
              </tr>
          </table></td>
        </tr>
        
		<tr>
          <td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><b>Website Administrators</b></td>
              </tr>
          </table></td>
        </tr>
		  
		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/admin_info.php" class="navlinks">Admin Info </a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
		
        <tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/cms/index.php" class="navlinks"><b>Content Management System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/category/index.php" class="navlinks"><b>Service Area Mgmt System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/expert/index.php" class="navlinks"><b>Expert Mgmt System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/service-posting/index.php" class="navlinks"><b>Service Posting Mgmt System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/subscriptionfee/index.php" class="navlinks"><b>Subscription Fees Mgmt System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/member/index.php" class="navlinks"><b>Member Management System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><a href="<?=$path?>admin/faq/index.php" class="navlinks"><b>FAQ Management System</b></a></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="text4"><b>Reports</b></td>
              </tr>
          </table></td>
        </tr>
		  
		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/reportdeactive/index.php" class="navlinks">Deactivated Members List</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
		

		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/reportmember/index.php" class="navlinks">Full Members List</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center" valign="top"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/reportcur-month/index.php" class="navlinks">Payment Receivable in Current month from old Members</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
		
		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center" valign="top"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/reportsel-month/index.php" class="navlinks">Payment Received from New Membership in selected Month</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center" valign="top"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/report-month/index.php" class="navlinks">Payment Received in Selected month</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center" valign="top"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/comission-month/index.php" class="navlinks">Commissions Payable in Current month</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>

		<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center" valign="top"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="<?=$path?>admin/comission-selected-month/index.php" class="navlinks">Commission Paid in Selected Month</a></td>
                    </tr>
                </table></td>
          </tr>
          </table></td>
        </tr>

	<!-- 	<tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td width="91%" align="right" class="nav" height="30">
				<table width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="center" valign="top"><img src="<?=$path?>images/arrow2.gif"></td>
                      <td width="91%" class="navlinks" align="left">
                     <a href="#" class="navlinks">CSV for Commission Payment</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>  -->
			
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" align="center"><img src="<?=$path?>images/arrow1.gif" ></td>
                <td width="91%" class="navlinks"><a href="<?=$path?>admin/logout.php" class="navlinks"><b>Logout</b></a></td>
              </tr>
          </table></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>

    </table></td>
  </tr>
</table></td>
<td  align="left" valign="top">
	
<?}
function admin_footer($path=''){
?>		
</td>
</tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
 <tr>
        <td bgcolor="#d0d0d0" height="5"  colspan="2" ></td>
      </tr>
      <tr>
        <td align="left" valign="middle" bgcolor="#E63A22"  height="25" style="padding-left:25px; " class="text4">Copyright&nbsp;&copy;&nbsp;2011&nbsp;All Right Reserved. </td>
     
        <td align="right" valign="middle"   bgcolor="#E63A22" style="padding-right:25px; "><a href="http://www.weblogic.co.bw/" target="$_BLANK" class="footerlink">Designed and Developed by Weblogic</a></td>
      </tr>
    </table></td>
  </tr>
  
</table>
</body>
</html>
<?}
function pagination($strsql_pag, $current_page=0, $link_pag=null, $more_querystr=null, $page_size=0)
{
	global $sitefont,$sitefontweight ;

	if (($page_size+0)==0)
		$page_size=10;
	if ($link_pag == null or $link_pag == "")
		$link_pag=$PHP_SELF ;

	if ($more_querystr != null or $more_querystr != "")
		$more_querystr="&" . $more_querystr ;

	// COUNT
	if (!($result_pag = mysql_query($strsql_pag))){echo "SQL: ".$strsql_pag."<br>ERROR: ".mysql_error();exit;}

	$row_pag = mysql_fetch_array($result_pag);
	$ex_count=mysql_num_rows($result_pag);

	$no_page=ceil($ex_count/$page_size);

	if ($current_page>0)
		$show_from=($current_page-1)*$page_size;
	else
		$show_from=0;
	

	if( $ex_count>$page_size )
	{
		$diplay_string = "<TABLE cellPadding=0 cellspacing=0 width=50% size=0 align=center ><form Name='frmGotoPage'  id='frmGotoPage' method ='post' action ='". $link_pag ."?wew=qwq".$more_querystr ."' onsubmit='return validate();'><TR >";

		if(($current_page + 0)<=0)
			$current_page=1;
		else if (($current_page + 0)>$no_page)
			$current_page=$no_page + 0;
		else
			$current_page=ceil($current_page) + 0;

		if ($current_page  != 1 )
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=>        <a title='Go to the first page' class=Link-TableHeader target=_self href='". "". $link_pag ."?page=1".$more_querystr ."'><b>First</b></a></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle class=tab><b>First</b></TD>";

		if ($current_page  !=1 )
			$diplay_string = $diplay_string . "        <TD align=middle width='10%' bgcolor=>        <a title='Go to the previous page' target=_self href='". "". $link_pag ."?page=".($current_page -1).$more_querystr ."'><b>Prev</b></a></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=><b>Prev</b></font></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle class='tab'><b>Next</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD width='10%' align=middle bgcolor=>$no_pages	<a title='Go to the next page' target=_self href='". $link_pag ."?page=" .($current_page + 1) . $more_querystr. "'><b>Next</b></a></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle class='tab'><b>Last</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD align=middle width='10%' bgcolor=> 	<a title='Go to the last page' target=_self href='". $link_pag ."?page=" .$no_page . $more_querystr. "'><b>Last</b></a></TD>";

		$diplay_string=$diplay_string . "	</TR></form></TABLE>	";

	}

	// make string eg. [1-20 OF 290]
	if ($ex_count > 0)
	{
		$last_record_no = $show_from + $page_size;
		if ($last_record_no > $ex_count)
			$last_record_no = $ex_count;

		$first_record_no = ($show_from+1);
	}
	else
	{
		$last_record_no = 0;
		$first_record_no = 0;
	}


	$return_this = $show_from .",". $page_size ."~". $diplay_string ."~ [ ". $first_record_no . "-". $last_record_no ." OF ". $ex_count ." ] ";

	return  $return_this;

}
//////END generation of pageing code

////// start function to display error
function displayerror($title,$errorno,$errordesc,$links,$reporterror)
{
		global $sitefont ,$sitefontweight;

    //Dim arrlinks 'Array to stores hyperlink text and Url
    //Dim intI 'Counter for For loop
    print "<body>";
    print "<center>";
    print "<table border=1 cellspacing=0 cellpadding=1 width=90%> ";
    print "  <tr bgcolor=#FF4E37>";
    print "    <td><font color=#FFFFFF face='$sitefont' ><b>".$title."</b></font></td>";
    print "  </tr>";
    print "  <tr>";
    print "    <td><br>";
    print "<font face='$sitefont' size='$sitefontweight' ><b> &nbsp;An error occurred during this process.</b></font><br><br>";
    print "<font face='$sitefont' size='$sitefontweight' >".$errorno."&nbsp;"."</font>";
    print "<font face='$sitefont' size='$sitefontweight' >".$errordesc."</font>";
    //$err.$clear;

    $arrlinks=explode(",",$links);
    //echo "<br>".$arrlinks[0]."<p>".$arrlinks[1]."<p>".$arrlinks[2]."<p>".$arrlinks[3];//exit;

    print "<ul>";

    //Loop to show all hyperlinks
    for ($intI=0; ($intI<=count($arrlinks)-1);$intI=$intI+2){
      print "<li><font face=$sitefont size=$sitefontweight><b><a href='".$arrlinks[$intI+1]."'>".$arrlinks[$intI]."</a></font></li>";
    }

    //Condition checks if reporterror is one then show "Report This error" hyperlink
    //if cint(reporterror) = 1 then
    //        Response.Write "<li><a href='#'>Report This error</a></li>"
    //end if
    print "</ul>";
    print "</td>";
    print "</tr>";
    print "</table>";
    print "</center>";
}//end sub

function dateformate($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
$txtdate=$date1[2]."-".$date1[1]."-".$date1[0];
return $txtdate;
}

function dateformate1($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
if($date1[1]=="01"){$date1[1]="January";}
if($date1[1]=="02"){$date1[1]="February";}
if($date1[1]=="03"){$date1[1]="March";}
if($date1[1]=="04"){$date1[1]="April";}
if($date1[1]=="05"){$date1[1]="May";}
if($date1[1]=="06"){$date1[1]="June";}
if($date1[1]=="07"){$date1[1]="July";}
if($date1[1]=="08"){$date1[1]="August";}
if($date1[1]=="09"){$date1[1]="September";}
if($date1[1]=="10"){$date1[1]="October";}
if($date1[1]=="11"){$date1[1]="November";}
if($date1[1]=="12"){$date1[1]="December";}
$txtdate=$date1[2]." ".$date1[1]." ".$date1[0];
return $txtdate;
}

function date_month($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
if($date1[1]=="01"){$date1[1]="January";}
if($date1[1]=="02"){$date1[1]="February";}
if($date1[1]=="03"){$date1[1]="March";}
if($date1[1]=="04"){$date1[1]="April";}
if($date1[1]=="05"){$date1[1]="May";}
if($date1[1]=="06"){$date1[1]="June";}
if($date1[1]=="07"){$date1[1]="July";}
if($date1[1]=="08"){$date1[1]="August";}
if($date1[1]=="09"){$date1[1]="September";}
if($date1[1]=="10"){$date1[1]="October";}
if($date1[1]=="11"){$date1[1]="November";}
if($date1[1]=="12"){$date1[1]="December";}
return substr($date1[1],0,3);
}

function dateDiff($start, $end) {

$start_ts = strtotime($start);

$end_ts = strtotime($end);

$diff = $end_ts - $start_ts;

return round($diff / 86400);

}


function GetCategoryname($catid){
$tblpref="gips_";
//couse name from category id
$queryy="SELECT * FROM ".$tblpref."course_cat WHERE cat_id='".$catid."'";
if(!($resultt=mysql_query($queryy))){echo mysql_error(); exit;}
$rows=mysql_fetch_array($resultt);
return $rows[cat_title];
}

function imageresize($width, $height, $target) 
{ 
	//takes the larger size of the width and height and applies the  
	//formula accordingly...this is so this script will work  
	//dynamically with any size image 

	if ( ($width < $target) && ($height < $target) ) { 
		$percentage = 1; 
	} else if ($width > $height) { 
		$percentage = ($target / $width); 
	} else { 
		$percentage = ($target / $height); 
	} 

	//gets the new value and applies the percentage, then rounds the value 
	$width = round($width * $percentage); 
	$height = round($height * $percentage); 

	//returns the new sizes in html image tag format...this is so you 
	//can plug this function inside an image tag and just get the 
	return "width=\"$width\""; 
}

function FindMonth($dateyear,$datemonth,$diff)
{
	if($diff==2)
	{
		$i = 1;
	}
	else
	{
		$i = 0;
	}

	while($i < $diff)
	{
		if($datemonth<13)
		{
			$len = strlen($datemonth);
			switch($len)
			{
				case 1:
				$datem = "0".$datemonth;
				break;		
				default:
				$datem = $datemonth;
				break;
			}
			$monthdate = date_month1($datem);
			$Dateformate[] = $datem." ".$monthdate." ".$dateyear;
		}
		else{

			$datemonth = $datemonth - 11;
			$dateyear = $dateyear + 1;

			$len = strlen($datemonth);
			switch($len)
			{
				case 1:
				$datem = "0".$datemonth;
				break;
				default:
				$datem = $datemonth;
				break;
			}

			$monthdate = date_month1($datem);
			$Dateformate[] = $datem." ".$monthdate." ".$dateyear;
		}
		
		$i++;
		$datemonth++;
	
	}
		return $Dateformate;
}

	function dateDiff1($start, $end) {

	$start_ts = strtotime($start);

	$end_ts = strtotime($end);

	$diff = $end_ts - $start_ts;

	return round($diff / 2628000);

	}

	function date_month1($datem='')
	{

	if($datem=="01"){$datem="January";}
	if($datem=="02"){$datem="February";}
	if($datem=="03"){$datem="March";}
	if($datem=="04"){$datem="April";}
	if($datem=="05"){$datem="May";}
	if($datem=="06"){$datem="June";}
	if($datem=="07"){$datem="July";}
	if($datem=="08"){$datem="August";}
	if($datem=="09"){$datem="September";}
	if($datem=="10"){$datem="October";}
	if($datem=="11"){$datem="November";}
	if($datem=="12"){$datem="December";}
	return $datem;
	}

function comissionpaid($regdate,$memberid)
{
	$CurDate = date('Y-m-d h:i:s');
	$Curdate = explode(" ",$CurDate);
	$cdate = explode("-",$Curdate[0]);

	$memregdate = explode(" ",$regdate);
	$date = explode("-",$memregdate[0]);

	$dif =  dateDiff1($memregdate[0],$Curdate[0]);/* Find the difference between Two date*/
	$dif = $dif + 2;							  /* Add upper limit and  Lower limit for MONTH*/

	$DateFormate = FindMonth($date[0],$date[1],$dif);

	if(count($DateFormate)>=1)
	{
		for($i=0;$i<=count($DateFormate)-1;$i++)
		{	
			if($i%2==0)
			{
				$bgcolor = "light";
				$RecordBG[] = $bgcolor;
			}
			else
			{
				$RecordBG[] = "";
			}
			$dateformonth = explode(" ",$DateFormate[$i]);
			$MonthRecored[] = $dateformonth[1]." ".$dateformonth[2]; //Date Column1 (Month row)
			$month = $dateformonth[0]+1;
							
			if($month<13)
			{
				$emonth = $month;
				$eyear = $dateformonth[2];

				$smonth = $emonth -1;
				$syear = $dateformonth[2];
			}
			else
			{
				$emonth = $month - 12;
				$eyear = $dateformonth[2]+1;

				$smonth = $month - 1;
				$syear = $dateformonth[2];
			}

			$datestart = $syear."-".$smonth."-01 00:00:01";

			$dateend = $eyear."-".$emonth."-01 00:00:01";

			$queryph="select * from ".$tblpref."payment where pay_member_id='$memberid' AND pay_date < '$dateend' AND pay_date > '$datestart' ";

			if(!($resultph=mysql_query($queryph))){ echo $queryph.mysql_error(); exit;}
			$rowph = mysql_fetch_array($resultph);
			$paynumrow = mysql_num_rows($resultph);

			if($paynumrow > 0)
			{
			   $txtdate = explode(" ",$rowph[pay_date]);
			   $date = dateformate1($txtdate[0])."<br>"; //date for that month Column 1
			   //$RecordDate[] = $date.$txtdate[1];
			   $RecordPaynow[] = "Paid";
			}
			else
			{
				$RecordPaynow[] = "UnPaid";
				//$RecordDate[] = "Carry Forward";
			}

			$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date < '$dateend' ORDER BY subfee_id DESC";
			if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit;}
			$rowsubfee = mysql_fetch_array($resubfee);
			$rowsf = $rowsubfee[subfee_subfees] + $rowsubfee[subfee_contactfee];

			$RecordSubFee[] = number_format($rowsf,2); //subscription fee for that month Column 2

			$selrefmem = "select * from ".$tblpref."member_reg WHERE mem_refname ='$memberid' AND mem_date < '$dateend'";
			if(!($resrefmem=mysql_query($selrefmem))){echo $selrefmem.mysql_error();exit;}
			$numrefmem = mysql_num_rows($resrefmem);
			$RecordMemRef[] = $numrefmem;   //No Of referer Member for that month Column 3

			$com = $numrefmem*100;
			$RecordCommision[] = number_format($com,2); //commission at that month column 4

			$txttotal = $com - $rowsf;
			if($txttotal < 0)
			{
				$txttotal = $txttotal*(-1);
														
				if($paynumrow>0)
				{
					$total = $total + $txttotal;
					$cost =  number_format($total,2);
					$RecordPaid[] = "<b>".$cost."(Paid)</b>"; // Total Paid at that month column 5
					$total = 0;
				}
				else
				{
					$total = $total + $txttotal;
					$unpaid = number_format($total,2);
					$RecordPaid[] = $unpaid."()";
				}
			}
			else
			{
				$RecordPaid[] = "0.00";
			}

			$txttotal = $com - $rowsf;
			if($txttotal > 0)
			{
				$RecordTotal[] = number_format($txttotal,2);
			}
			else
			{
				$RecordTotal[] = "0.00";
			}

		} 
	}

}
function outstandingdue($regdate,$memberid)
{
				include("config.php");
				$CurDate = date('Y-m-d h:i:s');
				$Curdate = explode(" ",$CurDate);
				$cdate = explode("-",$Curdate[0]);

				$memregdate = explode(" ",$regdate);
				
				$date = explode("-",$memregdate[0]);

				$dif =  dateDiff1($memregdate[0],$Curdate[0]);
											/* Find the difference between Two date*/
				$dif = $dif + 2;			/* Add upper limit and  Lower limit for MONTH*/

				$DateFormate = FindMonth($date[0],$date[1],$dif); // Number of Month from registration date
				
				if(count($DateFormate)>=1)
				{
				for($i=0;$i<=count($DateFormate)-1;$i++)
				{	
				
				$dateformonth = explode(" ",$DateFormate[$i]);
				$MonthRecored[] = $dateformonth[1]." ".$dateformonth[2]; 
														//Date Column1 (Month row)
				$month = $dateformonth[0]+1;
								
				if($month<13)
				{
					$emonth = $month;
					$eyear = $dateformonth[2];

					$smonth = $emonth -1;
					$syear = $dateformonth[2];
				}
				else
				{
					$emonth = $month - 11;
					$eyear = $dateformonth[2]+1;

					$smonth = $month - 1;
					$syear = $dateformonth[2];
				}

				$datestart = $syear."-".$smonth."-01 00:00:01";

				$dateend = $eyear."-".$emonth."-01 00:00:01";

				$queryph="select * from ".$tblpref."payment where pay_member_id='$memberid' AND pay_date > '$datestart' AND pay_date < '$dateend' ORDER BY pay_id DESC";

				if(!($resultph=mysql_query($queryph))){ echo $queryph.mysql_error(); exit;}
				$rowph = mysql_fetch_array($resultph);
				$paynumrow = mysql_num_rows($resultph);

				if($paynumrow > 0)
				{
				   $txtdate = explode(" ",$rowph[pay_date]);
				   $date = dateformate1($txtdate[0]);
				   $RecordPaynow[] = "Paid";
					
				}
				else
				{
					$RecordPaynow[] = "UnPaid";
				}

				$querysubf="SELECT * FROM ".$tblpref."subscriptionfee WHERE subfee_date < '$dateend' ORDER BY subfee_date DESC limit 0,1";
				if(!($resubfee=mysql_query($querysubf))){ echo $querysubf.mysql_error(); exit();}
				$rowsubfee = mysql_fetch_array($resubfee);
				
				$rowsf = $rowsubfee[subfee_subfees] + $rowsubfee[subfee_contactfee];

				$RecordSubFee[] = number_format($rowsf,2); 		//subscription fee for that month Column 2

				$selrefmem = "select * from ".$tblpref."member_reg WHERE mem_refname ='$memberid' AND mem_date < '$dateend'";
				if(!($resrefmem=mysql_query($selrefmem))){echo $selrefmem.mysql_error();exit;}
				$numrefmem = mysql_num_rows($resrefmem);

				$RecordMemRef[] = $numrefmem;
										//No Of referer Member for that month Column 3
				$com = $numrefmem*100;
				$RecordCommision[] = number_format($com,2); 
										//commission at that month column 4

				$txttotal = $com - $rowsf;
			
				if($txttotal < 0)
				{
					$txttotal = $txttotal*(-1);
															
					if($paynumrow>0)
					{						
						$total = $total + $txttotal;
						$unpaid = number_format($total,2);
						$RecordPaid[] = $unpaid;				
					}
					else
					{			
						$totalun = $totalun + $txttotal;
						$unpaid= number_format($totalun,2);
						$RecordPaidun[] = $unpaid;					
					}
				}

				if($txttotal > 0)
				{
					$RecordTotal[] = number_format($txttotal,2);
				}
				else
				{
					$RecordTotal[] = "0.00";
				}

				} 
				}
			
				$Recordtot = count($RecordPaidun);
				if($RecordPaidun[$Recordtot-1]=="")
				{
					echo   "P 0.00";
				}
				else
				{
					echo   "P ".$RecordPaidun[$Recordtot-1];
				}

}
function show_menu ($parent_id=0, $db, $connection, $tblpref, $count=0) {

				
				$querycms="select * from ".$tblpref."content_master where cms_id ='$parent_id' order by cms_id"; 
				if(!($resultcms=mysql_query($querycms))){ echo $querycms.mysql_error(); exit;}
				$num_row = mysql_num_rows($resultcms);
				$rowcms = mysql_fetch_array($resultcms);
//				$count_id++;
?>					<li><a href="<?=$rowcms[cms_sitelink]?>?cid=<?=$rowcms[cms_id]?>" rel="ddsubmenu<?=$rowcms[cms_id]?>"><span><?=$rowcms[cms_title]?></span></a>
<?
				$querycms2="select * from ".$tblpref."content_master where cms_parent ='".$rowcms[cms_id]."' order by cms_id"; 
				if(!($resultcms2=mysql_query($querycms2))){ echo $querycms2.mysql_error(); exit;}
				$num_row2 = mysql_num_rows($resultcms2);
				if($num_row2 >0){
						

?>						<ul id="ddsubmenu<?=$rowcms[cms_id]?>" class="ddsubmenustyle">
<?					while($rowcms2 = mysql_fetch_array($resultcms2))
					{
						show_menu($rowcms2[cms_id], $db, $connection, $tblpref, $count_id); 
					} 
?>						</ul>	 
<?				}
?>					</li>
<?
}?>
