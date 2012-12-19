// JavaScript Document
$(document).ready(function() {
	//if submit button is clicked
	$('#submit').click(function () {

		var condition = true;

		//Get the data from all the fields
		var sname   = $('#sname');
		var email 	= $('#email');
		var tel		= $('#tel');
		var subject	= $('#subject');
		var message	= $('#message');
		var captcha	= $('#captcha');

		//If error found, add hightlight class to the text field
		if (sname.val() == '') 
		{
			document.getElementById('ename').style.display = "block";
			document.images.ename.src = "images/no.gif";
			condition =  false;
		
		}
		if(sname.val() != '')
		{
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(sname.val().match(alphaExp)))
			{
				document.images.ename.src = "images/no.gif";
				condition =  false;
			}
		}
		if (tel.val() == '') 
		{
			document.getElementById('etel').style.display = "block";
			document.images.etel.src = "images/no.gif";
			condition =  false;
		}

		if(tel.val() != '')
		{				
			var numericExpression = /^[0-9---+]+$/;
			if (!(tel.val().match(numericExpression)))
		    {				
				document.images.etel.src = "images/no.gif";
				condition =  false;
			}			
		}
		
		if (email.val()=='')
		{
			document.getElementById('eemail').style.display = "block";
			document.images.eemail.src = "images/no.gif";
			condition =  false;
		}
		
		if(email.val()!='')
		{	
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!(email.val().match(emailExp)))
			{
				document.images.eemail.src = "images/no.gif";
				condition = false;
			}
		}
	
		if (subject.val()=='') 
		{
			document.getElementById('esubject').style.display = "block";
			document.images.esubject.src = "images/no.gif";
			condition =  false;
		}		
		
		if (message.val()=='') 
		{
			document.getElementById('emessage').style.display = "block";
			document.images.emessage.src = "images/no.gif";
			condition =  false;
		}

		if (captcha.val()=='') 
		{
			document.getElementById('ecaptcha').style.display = "block";
			document.images.ecaptcha.src = "images/no.gif";
			
			condition =  false;
		}		
		if(condition == true) {

			//organize the data properly
			var data = 'sname=' + sname.val() +'&tel=' + tel.val() +'&email=' + email.val() + '&subject=' + subject.val() + '&message=' + encodeURIComponent(message.val()) +'&captcha='+ captcha.val();
				
			//show the loading sign
			$('.loading').show();

				var xmlHttp;
					try
					{  
					// Firefox, Opera 8.0+, Safari 
						 xmlHttp=new XMLHttpRequest();  
					}
					catch (e)
					{ 
					 // Internet Explorer  
						try
						{    
							xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
						}
						catch (e)
						{    
							try
							{     	
								xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
							}
							 catch (e)
							 {      
								  alert("Your browser does not support AJAX!");
								  return flase;
							 }
						}
					  }
				var url="truth-junction-cont-submit.php?"+data;
				xmlHttp.onreadystatechange=function()
				{	
					if(xmlHttp.readyState==4)
					{
						x=xmlHttp.responseText;
						result = x.indexOf(".");
						if (result > 1) {
							$('.form').fadeOut('slow');					
							//show the success message
							$('.done').fadeIn('slow');
						}
						else
						{
							$('.loading').hide();
							document.getElementById('ecaptcha').style.display = "block";
							document.images.ecaptcha.src = "images/no.gif";
						}
					}
				}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
				return false;
			}
			else
			{					
				//cancel the submit button default behaviours
				return false;
			}
	});	
});	

empty = function(id)
{	
	var obj = document.getElementById(id).value;

	if (id == 'sname')
	{		
		if (obj == "")
		{
			document.getElementById('ename').style.display = "block";
			document.images.ename.src = "images/no.gif";
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(document.getElementById('sname').value.match(alphaExp)))
			{
				document.getElementById('ename').style.display = "block";
				document.images.ename.src = "images/no.gif";
			}
			else
			{
				document.getElementById('ename').style.display = "block";
				document.images.ename.src = "images/yes.gif";
			}
		}
	}

	if(id == 'tel')
	{		
		if(obj == "")
		{
			document.getElementById('etel').style.display = "block";
			document.images.etel.src = "images/no.gif";
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9---+]+$/;
			if (!(document.getElementById('tel').value.match(numericExpression)))
		    {
				document.getElementById('etel').style.display = "block";
				document.images.etel.src = "images/no.gif";
			}
			else
			{
				document.getElementById('etel').style.display = "block";
				document.images.etel.src = "images/yes.gif";
			}
		}
	}

	if(id == 'email')
	{		
		if (obj == "")
		{
			document.getElementById('eemail').style.display = "block";
			document.images.eemail.src = "images/no.gif";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('email').value.match(emailExp)))
			{
				document.getElementById('eemail').style.display = "block";
				document.images.eemail.src = "images/no.gif";
			}
			else
			{
				document.getElementById('eemail').style.display = "block";
				document.images.eemail.src = "images/yes.gif";
			}
		}
	}
	if(id == 'subject')
	{
		document.getElementById('esubject').style.display = "block";
		if (obj == "")
		{			
			document.images.esubject.src = "images/no.gif";
		}
		else 
		{		
			document.images.esubject.src = "images/yes.gif";
		}
	}
	if(id == "message")
	{		
		if(obj == "")
		{
			document.getElementById('emessage').style.display = "block";
			document.images.emessage.src = "images/no.gif";
		}
		else 
		{
			document.getElementById('emessage').style.display = "block";
			document.images.emessage.src = "images/yes.gif";
		}
	}
	if(id == 'captcha')
	{		
		if(obj == "")
		{
			document.getElementById('ecaptcha').style.display = "block";
			document.images.ecaptcha.src = "images/no.gif";
		}
		else
		{
			document.getElementById('ecaptcha').style.display = "block";
			document.images.ecaptcha.src = "images/yes.gif";
		}
	}
}
