<?include ("../common/app_function.php");
admin_header("../","Login");
?>
<body onload="document.login.username.focus()">
<td align="center" valign="top" width="100%" >
        <table width="350" border="0" cellspacing="0" cellpadding="0" >
		<tr><td height="30">&nbsp;</td></tr>
          <tr> 
            <td  bgcolor="#F3452D" align="center" class="text4" height="25">Administrator Login</td>
          </tr>
          <tr> 
            <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td class="warning" bgcolor="#d0d0d0" align="center">&nbsp;
				  <?if($_GET[flag]=="wrong"){echo "Invalid Username / Password";}?>
				  <?if($_GET[flag]=="invalid"){echo "Invalid Code";}?>
				  <?if($_GET[flag]=="sent"){echo "Your password has been mailed to you.";}?>
				  </td>
                </tr>
                
                <tr> 
                  <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <FORM METHOD=POST ACTION="submit_login.php" name="login" onsubmit='return validateform1();'>
				  
                      <tr> 
                        <td bgcolor="#F3452D" style="padding-left:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <tr><td width="40%"> 
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td  height="40" align="right" class="text4">Username</td>
                                    <td width="9%">&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td width="68%" class="text4"><input type="text" name="username" id="username" onChange="empty(this.id);"><br><label id="eusername" class="error"></label></td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td align="right" class="text4">Password&nbsp;</td>
                                    <td width="9%" >&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td class="text4"><input type="password" name="password" id="password" onChange="empty(this.id);"><br><label id="epassword" class="error"></label></td>
                            </tr>

							<tr><td> 
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td  height="40" align="right" class="text4">Enter Given Text</td>
                                    <td width="9%" >&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td width="68%"><input type="text" name="captcha" id ="captcha" class="captcha" ></td>
                            </tr>
								<tr >
							
								<td style="padding-left:100px" width="73%" align="center" valign="middle" colspan=2><IMG SRC="../common/antispamex01.php" BORDER="0" ALT=""></td>
							</tr>

                          </table></td>
                         </tr>

                      <tr> 
                        <td bgcolor="#F3452D">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="2" align="center">
								<input name="submit" type="submit" value="Login">
								</td>
                            </tr>
							<tr> 
                              <td width="45%" style="padding-left:10px;" align="left" class="text4"><a href="../index.php" class="footerlink" >Home</a></td>
                              <td width="55%" align="right" style="padding-right:10px;" class="text4"><a href="forgot_pass.php" class="footerlink">Forgot Your Password</a>
							  </td>
                            </tr>
                          </table></td>
				  </FORM>
                      </tr>
                    </table></td>
                </tr>
                
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="150">&nbsp;</td>
    </tr>
<?admin_footer("../");?>
