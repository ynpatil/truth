function errmsg() {

	var txt='Sorry please login As the Member !!!' ;
	function mycallbackform(v,m,f){
			var e = "";
			if(v == "Hello") {
			   		 							
				if (e == "") 
				{
					login('Member');
				}
			}
		}

		$.prompt(txt,{
			callback: mycallbackform,
		  buttons: { "Login": 'Hello',"Close":false }
		  
		});	
}
///script for validating username
validateuname = function(value)
{
		var url;
		url="validatename.php?value="+value;
											
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
					  return false;  
				 }
			}
		  }
		  xmlHttp.onreadystatechange=function()
		  {
			if(xmlHttp.readyState==4)
			{
				result = xmlHttp.responseText;
				document.getElementById('euid').style.display = "block";
				document.getElementById('euid').src = result;
			}
		  }
		  xmlHttp.open("Get",url,true);
		  xmlHttp.send(null);	
}


function login(val){

		var txt = '<p align="center" class="head_o"><h1>' + val + ' Login</h1></p>'+
		'<div align="center"><div class="field"><label for="uname">User Email Id :</label><input type="text" name="urname" id="urname" value="" style="width:180px;"></div>'+
		'<div class="field"><label for="upass">Password :</label><input type="password" name="pass" id="pass" value="" style="align:left; width:180px;"></div></div>';
				
		function mycallbackform(v,m,f){
					var e = "";					
					if(v == "Hello") {
				    		 if(f.urname=="")
									e += "Please enter user name<br />";
								
								if(f.pass=="")
									e += "Please enter password.<br />";
							
								if (e == "") 
								{
									var url;
									if(val=="Expert")
									{
										url="truth-junction-expert-loginpop.php";
									}

									if(val=="Member")
									{
										url="truth-junction-mem-loginpop.php";
									}
									
									url=url+"?username="+f.urname+"&password="+f.pass+"&val="+ val;
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
															  return false;  
														 }
													}
												  }
												if(val == "Expert") 
												{
												  xmlHttp.onreadystatechange=function()
												  {
													if(xmlHttp.readyState==4)
													{
														xx=xmlHttp.responseText;

														result = xx.indexOf(".");
														
														if (result > 1)
														{ 
															window.location.href="truth-junction-expert-index.php";
														}
														else
														{
															$.prompt(xx);
														}
														
													}
												  }
												  xmlHttp.open("Get",url,true);
												  xmlHttp.send(null);	
												}
												else {
										xmlHttp.onreadystatechange=function()
										{
											if(xmlHttp.readyState==4)
											{
												xx=xmlHttp.responseText;

												result = xx.indexOf(".");
														
												if (result > 1)
												{
													window.location.href="truth-junction-member-index.php";
												}
												else
												{
													$.prompt(xx);
												}
											}		
										 }
										 xmlHttp.open("Get",url,true);
										  xmlHttp.send(null);	
										 }
										  
								}
								else
								{
										if(f.urname == "" && f.pass == "")
											$.prompt("Enter Login Details!");	
										else if(f.urname == "")
											$.prompt("Enter User Name!");	
										else if(f.pass == "")
											$.prompt("Enter Password!");										
											
								}
						 
					}
					
					else if (v == "Bye")
					{
						if(val=="Expert")
						{
							var txt = '<p align="center" class="head_o"><h1>'+val+' Forgot Password </h1></p>'+
									'<div align="center"><div class="field"><label for="uname">Email Id </label><input type="text" name="furname" id="furname" value="" style="width:180px;"></div></div>';			
									
							$.prompt(txt,{ callback: mycallbackform1,
										buttons: { "Password Retrieved": 'Hello', "Close": 'Bye'}
									});
						}

						if(val=="Member")
						{
							var txt = '<p align="center" class="head_o"><h1>Member Forgot Password </h1></p>'+
									'<div align="center"><div class="field"><label for="uname">Email Id </label><input type="text" name="furname" id="furname" value="" style="width:180px;"></div><div class="field"><label  style="width:178px;">Select your secret Question </label><select name="squest" id="squest"  onchange="empty(this.id);" style="width:182px;"><option value="">Choose a question ...</option><option value="What is the name of your best friend from childhood?">What is the name of your best friend from childhood?</option><option value="What was the name of your first teacher?">What was the name of your first teacher?</option><option value="What is the name of your manager at your first job?">What is the name of your manager at your first job?</option><option value="What was your first phone number?">What was your first phone number?</option><option value="What is your vehicle registration number?">What is your vehicle registration number?</option></select></div><div class="field"><label for="uname">Your Answer </label><input type="text" name="answer" id="answer" value="" style="width:180px;"></div></div>';			
									
							$.prompt(txt,{ callback: mycallbackform2,
										buttons: { "Password Retrieved": 'Hello', "Close": 'Bye'}
									});
						}
						
					}
					
					else if (v == "reg") {			
							window.location.href="truth-junction-memreg.php";
					}
		}

		$.prompt(txt,{
			
		      callback: mycallbackform,
		  buttons: { "Login": 'Hello', "Forgot Password" : 'Bye',Close:false}, focus: 0

		});		

		function mycallbackform1(v,m,f){
					if (v == "Hello") 
					{
							if (f.furname != "") 
							{
										
								var url;
								url="forget.php";
								url=url+"?uname="+f.furname;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
											xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
										}
										 catch (e) {      
											  alert("Your browser does not support AJAX!");
											  return false;  
										 }
									}
								  }
								  xmlHttp.onreadystatechange=function()
								  {
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
								$.prompt("Please Enter User Name!");
							}
							
					}
		}

		function mycallbackform2(v,m,f){
					if (v == "Hello") 
					{
							if (f.furname != "") 
							{
										
								var url;
								url="forgetmeber.php";
								url=url+"?uname="+f.furname+"&quest="+f.squest+"&answer="+f.answer;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
											xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
										}
										 catch (e) {      
											  alert("Your browser does not support AJAX!");
											  return false;  
										 }
									}
								  }
								  xmlHttp.onreadystatechange=function()
								  {
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
								$.prompt("Please Enter User Name!");
							}
							
					}
		}

	
}


function frmmssage(flag){
		
		var txt = 'Your registration request has been sent successfully. Please wait for your account activation.';			
		
		function mycallbackform(v,m,f){
			var e = "";
			if(v == "Hello") {
			   		 							
				if (e == "") 
				{
					window.location.href = "index.php";
				}
			}
		}

		$.prompt(txt,{
		      callback: mycallbackform,
		  buttons: { "OK": 'Hello'}
		  
		});	
}

function logintype(){

		var txt = '<div class="title"></div>';
			
		function mycallbackform(v,m,f){
					var e = "";
					if(v == "exp") {
				    		 							
					if (e == "") 
					{		
						login('Expert');									
					}						
					}
					if(v == "mem") 
					{
						login('Member');
					}
					if (v == "reg") {
							window.location.href = "truth-junction-memreg.php";
					}
		}

		$.prompt(txt,{
		      callback: mycallbackform,
		  buttons: { "Expert Login": 'exp',  "Member Login":'mem', "Member Register":'reg', Close: false}

		});	
}


function forgot() {

	var txt = '<p align="center" class="head_o"><h1>Expert Forgot Password </h1></p>'+
									'<div align="center"><div class="field"><label for="uname">User Name </label><input type="text" name="furname" id="furname" value="" style="width:180px;"></div></div>';
									
		$.prompt(txt,{ callback: mycallbackform1,
						buttons: { "Password Retrieved": 'Hello', "Close": 'Bye'}
					});

		function mycallbackform1(v,m,f){
					if (v == "Hello") 
					{
							if (f.furname != "") 
							{
										
								var url;
								url="forget.php";
								url=url+"?uname="+f.furname;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
									}
									catch (e){    
										try	{     	
											xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
										}
										 catch (e) {      
											  alert("Your browser does not support AJAX!");
											  return false;  
										 }
									}
								  }
								  xmlHttp.onreadystatechange=function()
								  {
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
								$.prompt("Please Enter User Name!");
							}
							
					}
		}
	
}

function forgotmem() {

	var txt = '<p align="center" class="head_o"><h1>Member Forgot Password </h1></p>'+
									'<div align="center"><div class="field"><label for="uname">Email Id </label><input type="text" name="furname" id="furname" value="" style="width:180px;"></div><div class="field"><label for="uname">Select your secret Question </label><select name="squest" id="squest" class="regist" onchange="empty(this.id);" style="width:182px;"><option value="">Choose a question ...</option><option value="What is the name of your best friend from childhood?">What is the name of your best friend from childhood?</option><option value="What was the name of your first teacher?">What was the name of your first teacher?</option><option value="What is the name of your manager at your first job?">What is the name of your manager at your first job?</option><option value="What was your first phone number?">What was your first phone number?</option><option value="What is your vehicle registration number?">What is your vehicle registration number?</option></select></div><div class="field"><label for="uname">Your Answer </label><input type="text" name="answer" id="answer" value="" style="width:180px;"></div></div>';			
									
							$.prompt(txt,{ callback: mycallbackform2,
										buttons: { "Password Retrieved": 'Hello', "Close": 'Bye'}
									});

		function mycallbackform2(v,m,f){
					if (v == "Hello") 
					{
							if (f.furname != "") 
							{
										
								var url;
								url="forgetmeber.php";
								url=url+"?uname="+f.furname+"&quest="+f.squest+"&answer="+f.answer;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
											xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
										}
										 catch (e) {      
											  alert("Your browser does not support AJAX!");
											  return false;  
										 }
									}
								  }
								  xmlHttp.onreadystatechange=function()
								  {
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
								$.prompt("Please Enter User Name!");
							}
							
					}
		}

	
}


gallery = function(img)
{
	var formstr='<div style="padding-top:20px; padding-left:30px;" align="center"><img src="'+img+'" alt=""  width="400" height="400"/></div>'
	
		jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
			if (v) {
				if (e == "") {	
				
				}
			else{
				jQuery('<div class="errorBlock" style="display: none;">'+ e +'</div>').prependTo(m).show('slow');
			}
			return false;
		}
		else return true;
	}
	},
	state1: {
		html: '<div id="response" style="text-align:center;"></div>',
		focus: 1,
		buttons: { Back: false, Done: true },
		submit: function(v,m,f){
		if(v)
			return true;
			
		jQuery.prompt.goToState('state0');
		return false;
			}
		}
	};
	$.prompt(jqistates);	
}

