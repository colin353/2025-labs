
<!DOCTYPE html> 
<html> 

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Single page template</title> 
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
	<script src="<?php echo BASE_URL; ?>js/jquery-1.6.2.min.js"></script>
<script src="<?php echo BASE_URL; ?>js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<link rel=stylesheet href="<?php echo BASE_URL; ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" />
			
<link rel=stylesheet href="<?php echo BASE_URL; ?>style/style.css" />
<link rel="shortcut icon" href="/favicon.png" />
<script src="<?php echo BASE_URL; ?>js/functions.js" type=text/javascript></script>
<script type=text/javascript>
	function goto(address) {
		window.location = address;
	}	
	request_q = <?php if(isset($_REQUEST['q'])) echo $_REQUEST['q']; else echo 0; ?>;
	BASE_URL = '<?php echo BASE_URL; ?>';
</script>
</head> 

<body>

<div data-role="page">


<img style="margin-left: auto; margin-right: auto; margin-top: 10px; margin-bottom: 20px; width:90%;" src="/images/2025.png" />
	