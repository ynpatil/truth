<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");
	
	$query = "SELECT * FROM ".$tblpref."content_master WHERE cms_type = 'faq' ORDER BY cms_date DESC";
	if(!($result = mysql_query($query))) { echo "Query :- " . $query . "<br />Error :- " . mysql_error(); exit; }

	index_header('FAQ');
?>
<script type="text/javascript">
function toggleMenuView(obj) 
{
 var sText = document.getElementById(obj);
 if (sText.className=="hide") sText.className="unhide"
 else sText.className="hide"
};

</script>
<link href="css/sab.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.hide {
	color:black;
	display:none
}
-->
</style>
<div id="expertpanel">
<div class="head-title-bg">
	<div class="crumb">
	<a href="index.php"><strong>Home</strong></a>&nbsp;&raquo; FAQ
	</div></div>

	<div style="width:696px;">
		<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
			<tr>
			<td colspan="3" valign="top" class="round-box-bg-inner">
				<div class="round-box-t-inner">
					<div class="pad8"><h2>FAQ</h2>
					<div style="padding-top:10px;">
					 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="padding:10px;" valign="top"><?php  while($row_faq=mysql_fetch_array($result)){$c++;?>
          <div style="border-bottom:1px solid #eeeeee;">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td background="images/bgline_05.jpg"  style="padding-bottom:10px; background-repeat:repeat-y;"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                    <tr>
                      <td class="greytext3" width="5%" style="padding-left:5px;"><img src="images/questionmark.png" alt="Question" /> </td>
                      <td height="22" style="padding-left:5px;"><a href="#toggleView(q1)" onclick="javascript:toggleMenuView('q<?php  echo $c?>');"  class="apply">
                        <?php  echo stripslashes($row_faq[cms_title])?>
                        </a> </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td valign="top"><div class="hide" id="q<?php  echo $c?>" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr >
                        <td width="5%" style="padding-left:5px;" valign="top" class="text1"><img src="images/answer.gif" alt="Answer" /></td>
                        <td style="padding:0 10px 10px 10px;" class="text1"><?php  echo stripslashes($row_faq[cms_desc])?></td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </td>
      </tr>
    </table>
					</div>
				</div>
			<div class="clear"></div>
			</div>
			</td>
			</tr>
		</table>
	</div>
	</div></div>
	<div class="clear"></div>
</div>
<? 
if($_SESSION[exptype]!="")
{
   if($_SESSION[exptype]=="expert") 
   { 
	   index_footer_mem_exp();
   }
   if($_SESSION[exptype]=="member")
   {
	   index_footer_member();		
   }
}
else
{
	index_footer();
}
?>