<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>twenty twenty-five</title>
	<meta name="author" content="Colin" />
	<!-- Date: 2011-09-29 -->
	
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	<script src="js/bg_full.js"></script>
				
	<link rel=stylesheet href="style/style.css" />
	
	<script type=text/javascript>
		
		function golink(target) {
			if(target == 'nowhere') {
				$('#content_shim').hide('fast');
				$('#content').hide('fast');
				return;
			}
			$('#content_shim').hide('fast');
			$('#content').hide('fast',function () {
					
					$('#content').html($('.'+target).html());
					$('#content').show('fast');
					$('#content_shim').show('fast');				
			});			
		}
		
	</script>
	
	
</head>
<body>
	
<img onClick="golink('nowhere')" src="/images/activate.jpg" id="bg" alt="">

<div id="header">
	<img  onClick="golink('nowhere')" src="/images/2025.png" />
	
	<ul> 
		<li onClick="golink('about-text')">about 2025</li>
		<li onClick="golink('latest-text')">latest</li>
		<li onClick="golink('bios-text')">bios</li>
		<li onClick="golink('contact-text')">contact</li>	
	</ul>
	
</div>

<div id=content>
		
</div> 

<div class='about-text hiding'>

	<h1>Hi.</h1>
	<p>Welcome to twenty twenty-five. What do we do? We don't even know. Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.Welcome to twenty twenty-five. What do we do? We don't even know.</p>
	<p>Here is some extra texty text yeahh</p>
	
</div>

<div class='latest-text hiding'>
	<h1>A crazy app we made</h1>
	<p>IT does some crazy things</p>
	<p>Man let me tell you it is so crazy yo</p>
	
</div>

<div class='bios-text hiding'>
	<h1>Employee A</h1>
	<p>I never liked him very much</p>
	<h1>Employee B</h1>
	<p>I never liked him very much either</p>
		
</div>

<div class='contact-text hiding'>
	<h1>Phone us</h1>
	<p>We have a phone</p>
	<p>etc</p>
</div>


<div id="shim"> </div>
<div id="content_shim"> </div>
</body>
</html>
