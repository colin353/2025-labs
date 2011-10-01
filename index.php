<?php include("header.php"); 

if(isAuthenticated()) header('Location: /collaborate/')

?>

	
<script type=text/javascript>
	
var menuitem = 0;
	
function golink(target) {
	if(target == menuitem) return;
	if(target == 0) {
		$('#login_box').show('fast');
		$('#login_shim').show('fast');
		$('#content_shim').hide('fast');
		$('#content').hide('fast');
		menuitem = 0;
		return;
	}
	$('#login_box').hide('fast');
	$('#login_shim').hide('fast');
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
		<li onClick="golink(1)"><?php echo HEADER_MENU1;?> </li>
		<li onClick="golink(2)"><?php echo HEADER_MENU2;?></li>
		<li onClick="golink(3)"><?php echo HEADER_MENU3;?></li>
		<li onClick="golink(4)"><?php echo HEADER_MENU4;?></li>	
	</ul>
	
</div>

<div id=login_box>
		<span><?php echo HEADER_LOGIN_HERE; ?></span>
		<form id=login_form action='collaborate/login.php' method='post'>
			<input autofocus type=text placeholder="username" name=username />
			<input type=password placeholder="password" name=password />
			<input type="submit" value="Submit the form!" style="position: absolute; top: 0; left: 0; z-index: 0; width: 1px; height: 1px; visibility: hidden;" />
		</form>
</div>
<div id="login_shim"> </div>

<div id=content></div> 

<div class='menuitem1 hiding'><?php echo INDEX_ABOUT; ?></div>
<div class='menuitem2 hiding'><?php echo INDEX_LATEST; ?></div>
<div class='menuitem3 hiding'><?php echo INDEX_BIOS; ?></div>
<div class='menuitem4 hiding'><?php echo INDEX_CONTACT; ?></div>

<div id="shim"> </div>
<div id="content_shim"> </div>

<?php include("footer.php"); ?>

