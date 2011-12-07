<?php

include('../include/init.php');
if(isAuthenticated()) header('Location: /collaborate/');
$ref = "/";
if(isset($_SESSION['deauthenticated'])) {
	$ref = $_SESSION['ref'];	
} else $ref = "/";



?>

<!DOCTYPE html> 
<html> 

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Single page template</title> 
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
</head> 


<body> 

<div data-role="page">

	<img style="margin-left: auto; margin-right: auto; margin-top: 10px; margin-bottom: 20px; width:90%;" src="/images/2025.png" />
	<div data-role="header">
		<h1>Hi.</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<p>Welcome to 2025 laboratories.</p>
		<p>We are an engineering research and development group interested in software, visualization, electronics, robotics, and the future. </p>
	</div><!-- /content -->
	
	<div data-role="header">
		<h1>Login here.</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<form id=login_form action='/collaborate/login.php' method='post'>
			<input autofocus id=username_text type=text placeholder="username" name=username />
			<input type=password placeholder="password" name=password />
			<input type=hidden name=direct value='<?php echo $ref; ?>' />
			
			<input type="submit" value="Login" />
		</form>
	</div><!-- /content -->
	
	
	
</div><!-- /page -->

</body>
</html>
