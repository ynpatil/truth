<html>
<head>
<title>Scroller</title>
<link rel="StyleSheet" href="css/examples.css" type="text/css"  media="screen" charset="utf-8" />
<script type="text/javascript" src="js/jquery-1.js"> </script>
<script type="text/javascript" src="js/jquery-impromptu.js"> </script>
<script type="text/javascript" src="js/web.js"> </script>

<?
include("common/config.php");

$queservices="SELECT * FROM ".$tblpref."expert_servies WHERE exps_id='$serid'";
if (!($servresult = mysql_query($queservices))) { echo "FOR QUERY: $queservices<BR>".mysql_error();exit;}
$rowserv = mysql_fetch_array($servresult);

$queserup="SELECT * FROM ".$tblpref."exp_ser_docup WHERE esdoc_service_id='$serid'";
if (!($serupresult = mysql_query($queserup))) { echo "FOR QUERY: $queserup<BR>".mysql_error();exit;}
?>

<Script>
var pic = new Array()

function banner(name, width, link){
	this.name = name
	this.width = width
	this.link = link
   }


pic[0] = new
banner('tjtmp/<?=$rowserv[exps_image_one]?>   height=90  border=0' ,231,"javascript:gallery('<? echo 'tjtmp/'.$rowserv[exps_image_one]?>');" )

<? if($rowserv[exps_image_two] !=""){ ?>
pic[1] = new
banner('tjtmp/<?=$rowserv[exps_image_two]?>   height=90  border=0' ,231,"javascript:gallery('<? echo 'tjtmp/'.$rowserv[exps_image_two]?>');" )
<? } ?>
<?
$count=2;
while($rowup = mysql_fetch_array($serupresult))
{

	$serv = explode(".",$rowup[esdoc_upload]);
	if($serv[1]=="JPG" || $serv[1]=="jpg" || $serv[1]=="jpeg" || $serv[1]=="gif" || $serv[1]=="png" )
	{
	
?>
pic[<?=$count?>] = new
banner('tjtmp/<?=$rowup[esdoc_upload]?>   height=90  border=0' ,231,"javascript:gallery('<? echo 'tjtmp/'.$rowup[esdoc_upload]?>');" )

<?  } $count++; } ?>
var speed = 15

var kk = pic.length
var ii
var hhh
var nnn
var myInterval
var myPause
var mode = 0

var imgArray = new Array(kk)
var myLeft = new Array(kk)

for (ii=0;ii<kk;ii++){
imgArray[ii] = new Image()
imgArray[ii].src = pic[ii].name
imgArray[ii].width = pic[ii].width

	hhh=0 
	for (nnn=0;nnn<ii;nnn++){
		hhh=hhh+pic[nnn].width
	}
	myLeft[ii] = hhh
}

function ready(){
	for (ii=0;ii<kk;ii++){ 
		if (document.images[ii].complete == false){
			return false	
			break
		}
	}
return true
}

function startScrolling(){
	if (ready() == true){		
		window.clearInterval(myPause)
		myInterval = setInterval("autoScroll()",speed)	
	}
}

function autoScroll(){
	for (ii=0;ii<kk;ii++){
		myLeft[ii] = myLeft[ii] - 1
		
	if (myLeft[ii] == -(pic[ii].width)){
		hhh = 0
		for (nnn=0;nnn<kk;nnn++){
			if (nnn!=ii){
				hhh = hhh + pic[nnn].width
			}			
		}
		myLeft[ii] =  hhh
	}
		
				
		document.images[ii].style.left = myLeft[ii]
	}
	mode = 1
}

function stop(){
	if (mode == 1){
		window.clearInterval(myInterval)
	}
	if (mode == 0){
		window.clearInterval(myPause)
	}	
}

function go(){
	if (mode == 1){
		myInterval = setInterval("autoScroll()",speed)
	}
	if (mode == 0){
		myPause = setInterval("startScrolling()",3000)
	}	
}

myPause = setInterval("startScrolling()",3000)
</Script><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style><body >

<Script>
for (ii=0;ii<kk;ii++){
document.write('<a href = ' + pic[ii].link + ' target="_parent"><img space=0 hspace=0 vspace=0 border=0 height=100 style=position:absolute; top:0;left:' + myLeft[ii]  + '; src=' + pic[ii].name + ' onMouseOver=stop() onMouseOut=go()></a>')
}
</Script>
</body>

</html>