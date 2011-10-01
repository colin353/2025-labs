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
		var menuitem = 0;
		
		function golink(target) {
			if(target == menuitem) return;
			if(target == 0) {
				$('#content_shim').hide('fast');
				$('#content').hide('fast');
				menuitem = 0;
				return;
			}
			$('#content_shim').hide('fast');
			$('#content').hide('fast',function () {
					
					$('#content').html($('.menuitem'+target).html());
					$('#content').show('fast');
					$('#content_shim').show('fast');				
			});
			menuitem = target;			
		}
		
	</script>
	
	
</head>
<body>
	
<img onClick="golink(0)" src="/images/activate.jpg" id="bg" alt="">

<div id="header">
	<img  onClick="golink(0)" src="/images/2025.png" />
	
	<ul> 
		<li onClick="golink(1)">about 2025</li>
		<li onClick="golink(2)">latest</li>
		<li onClick="golink(3)">bios</li>
		<li onClick="golink(4)">contact</li>	
	</ul>
	
</div>

<div id=content>
		
</div> 

<div class='menuitem1 hiding'>

	<h1>Hi.</h1>
	<p>Welcome to 2025 laboratories.</p>
	<p>We are an engineering collective interested in software, electronics, robotics, and the future. </p>
	
</div>

<div class='menuitem2 hiding'>
	<h1>A crazy app we made</h1>
	<p>IT does some crazy things</p>
	<p>Man let me tell you it is so crazy yo</p>
	
</div>

<div class='menuitem3 hiding'>
	<h1>Employee A</h1>
	<p>I never liked him very much</p>
	<h1>Employee B</h1>
	<p>I never liked him very much either</p>
		
</div>

<div class='menuitem4 hiding'>
	<h1>Phone us</h1>
	<p>We have a phone</p>
	<p>etc</p>
</div>


<div id="shim"> </div>
<div id="content_shim"> </div>
</body>
</html>
