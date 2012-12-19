<?
include("../common/app_function.php");
include("../common/config.php");
admin_header("../","Admin");

/**
 * The letter l (lowercase L) and the number 1
 * have been removed, as they can be mistaken
 * for each other.
 */

function createRandomPassword() {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}
// Usage
$password = createRandomPassword();

$update="update ".$tblpref."admin set 
password ='$password',
logincount ='0'
where admin_id ='1' ";
if(!($result_up = mysql_query($update))){ echo $update.mysql_error();  exit; }

$query="select * from ".$tblpref."admin where admin_id ='1' ";
if(!($result=mysql_query($query))){echo $query.mysql_error(); exit;}
$row=mysql_fetch_array($result);

$username =$row[username];
$password =$row[password];
$email =$row[email];


$msg="<H3>Login Details</H3>Hello Admin,<BR><BR>This is your new login information.<BR><BR>Username : <b>$username</b<BR>Password : <b>$password</b><BR><BR>Thanks<BR>$sitename";
//echo $msg;

  $mesheader ="Return-Path: <$webmastername>\n";
  $mesheader .= "From: Dumafm Admin \n";
  $mesheader .= "MIME-Version: 1.0\n";
  $mesheader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  
  @mail($email,"Changed Password inaction of intrusion attack!",$msg,$mesheader);
  @mail("pratiknaik1@gmail.com","Changed Password inaction of intrusion attack!",$msg,$mesheader);

?> 
<td align="center" valign="top" width="100%" >
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td>
	<table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	<td  align="center" style="padding-top:120px" class="warning">Admin Panel is Locked to Prevent Unauthorized Access.<br>(Username and Password has been sent to Admin Email ID.)
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
<?admin_footer("../");?>