<?php	
	session_start();
	include("common/config.php");
	include ("common/app_function.php");

	index_header($row_cms->cms_title);	
?>
<div id="expertpanel">
			<div class="head-title-bg">
				<p><img src="images/head-txt.jpg" alt="head-txt" title=""/></p>
			</div>
              <div style="width:696px;">
               	<table  cellpadding="0" cellspacing="0" border="0" align="center" class="pad-left">
                    <tr>
                   	  <td valign="top" class="round-box-bg">
                       	<div class="round-box-t">
                                <div class="pad8">
                                	<h2><span>Services Offered</span></h2>
									<div class="services">
										<ul>
											<li class="icon-unemployment"><a href="javascript:servfunc(1);" >Unemployment and Entrepreneurship</a></li>
											<li class="icon-financial"><a href="javascript:servfunc(2);">Financial Advices</a></li>
											<li class="icon-fashion"><a href="javascript:servfunc(3);">Fashion</a></li>
											<li class="icon-sport"><a href="javascript:servfunc(4);">Sports</a></li>
											<li class="icon-life"><a href="javascript:servfunc(5);">Life Coaching</a></li>
											<li class="icon-relation"><a href="javascript:servfunc(6);">Relationships</a></li>
											<li class="icon-family"><a href="javascript:servfunc(7);">Family Planning</a></li>
											<li class="icon-daily-life"><a href="javascript:servfunc(8);">Daily Life</a></li>
										</ul>
									</div>
                                </div>
                            <div class="clear"></div>
                        </div>
                        </td>
                        
                        <td>&nbsp;</td>
                        
                        <td valign="top" class="round-box-bg">
						<div id="servicepanel">
                       	  <div class="round-box-t">
                                <div class="pad8">
                                	<h2><span>Latest Experts Postings</span></h2>
									
                                    <div style="padding:10px 0 0 10px;">
                                    
                                    	<table width="98%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                        	<td valign="top" class="light-bluebg">
                                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-bottom:43px;">
                                                <tr>
                                                	<td><h3 class="icon-posting">Posting</h3></td>
                                                </tr>
                                                <tr>
                                                	<td valign="top" class="post-date">
													<ul>
													<?
													$queservices="SELECT serv.exps_name,serv.exps_date,serv.exps_id FROM ((truth_expert AS expt LEFT JOIN truth_expert_servies AS serv ON expt.exp_id=serv.exps_expert_id) LEFT JOIN truth_services_category AS cat ON expt.exp_service_area_id=cat.cat_id) where expt.exp_status = 'Active' AND serv.exps_status='Active' ORDER BY serv.exps_date DESC LIMIT 0,6";
													if (!($servresult = mysql_query($queservices))) { echo "FOR QUERY: $queservices<BR>".mysql_error();exit;}
													while($rowserv = mysql_fetch_array($servresult))
													{
														$txtdate[] = $rowserv[exps_date]; 
													?>
													<li><a <? if($_SESSION[mem_id]=="") { ?> href="javascript:errmsg();"  <? } else { ?>href="truth-junction-servies-view.php?serviceid=<? echo $rowserv[exps_id]?>" <? } ?>><? echo $rowserv[exps_name]?></a></li>
													<? } ?>
													</ul>
                                                    </td>
                                                </tr>
                                                </table>
                                            </td>
                                            
                                            <td width="2%"></td>
                                            
                                            <td valign="top" class="light-bluebg">
												
                                            	<table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                	<td><h3 class="date">Date</h3></td>
                                                </tr>
                                                <tr>
                                                	<td valign="top" class="post-date">
                                                        <ul>
														<?
														if(is_array($txtdate))
														{
														foreach($txtdate AS $val)
														{
														?>
														<li><a <? if($_SESSION[mem_id]=="") { ?> href="javascript:errmsg();"  <? } else { ?>href="#" <? } ?>><? $txtd = explode(" ",$val);
														echo dateformate1($txtd[0]);
														?></a></li>
														<? } } ?>
                                                    	</ul>
                                                    </td>
                                                </tr>
                                                </table>
												

                                            </td>
                                        </tr>
                                        </table>
                                    </div>
                                </div>
                            	<div class="clear"></div>
                          </div>
						  </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div> </div>
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

<script type="text/javascript">
servfunc = function(flag) {

	$('#servicepanel').fadeOut('slow');
	setTimeout("servicedetail('"+flag+"')", 500);
	
	$('#servicepanel').fadeIn('slow');		
	setTimeout("timespan()", 500);
}

servicedetail = function(flag)
{
		$.ajax({ 
		type: "POST",
		url: "latest-services-index-post.php",
		cache: false,
		data: "cat="+flag, 
		success: function(msg){
			$("#servicepanel").html(msg);
		}
		});
}
timespan = function() {
}
</script>