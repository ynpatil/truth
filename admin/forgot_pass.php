<?include ("../common/app_function.php");
admin_header("../","");
?>
<body onload="document.login.txtuname.focus()">
<td align="center" valign="top" width="100%" bgcolor="">
        <table width="330" border="0" cellspacing="0" cellpadding="0" >
		<tr><td height="30">&nbsp;</td></tr>
		
          <tr> 
            <td  bgcolor="#F3452D" align="center" class="text4" height="25">Forgot Password</td>
          </tr>
		  <tr> 
                  <td class="warning"bgcolor="#D0D0D0">&nbsp;
				  <?if($_GET[flag]=="un"){echo "Username does not Exist!";}?>
				  <?if($_GET[flag]=="en"){echo "E-mail Address does not Exist!";}?>
				  <?if($_GET[flag]=="blank"){echo "Please enter Username or E-mail ID!";}?>
				  </td>
                </tr>
          <tr> 
            <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <FORM METHOD=POST ACTION="submit_forgotpass.php" name="login">
				  
                      <tr> 
                        <td bgcolor="#F3452D" style="padding-left:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <tr><td  > 
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="60" height="40" class="text4">Username</td>
                                    <td width="9%" >&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td width="68%"><input type="text" name="txtuname" value=""></td>
                            </tr>
							<tr><td></td>
                              <td width="68%" align="left" class="text4"><B>OR</B></td>
                            </tr>
                            
                            <tr> 
                              <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="60" class="text4">Email ID&nbsp;</td>
                                    <td width="9%" >&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td><input type="text" name="txtemail" ></td>
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
							<td class="other"><a href="index.php" class="other" style="padding-left:10px;"><input type="submit" name="back" value="Back"></A></td>
                              <td align="center">
							  <input type="submit" name="submit" value="Submit"></td>
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
      <td height="180">&nbsp;</td>
    </tr>
<?admin_footer("../");?>
