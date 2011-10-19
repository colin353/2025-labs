<?php include("header.php"); 

if(isAuthenticated()) header('Location: /collaborate/')

?>

	
<script type=text/javascript>
	
var menuitem = 0;
	
/*function golink(target) {
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
}*/
colors = Array(5);
colors[0] = "#DDDDDD";
colors[1] = "#FFDDAA";
colors[2] = "#AADDAA";
colors[3] = "#DDAAAA";
colors[4] = "#AAAADD";
	
function golink(target) {
	if(target == menuitem) return;
	
	$('body').animate({
			'background-color':colors[target]
		},'slow');
	
	
	
	if(target == 0) {
		/*$('#content_shim').hide('fast');
		$('#content').hide('fast');*/
		
		
		
		for(i=1;i<=4;i++) {
			$('div.menuitem'+i).animate({ 
				top: -100
			},500,function() {
				$('#login_box').show('fast');
				$('#login_shim').show('fast');
			});
		}
		
		menuitem = 0;
		return;
	}
	
		
	
	for(i=1;i<=4;i++) {
		$('div.menuitem'+i).animate({ 
			top: 150 - .9*$(window).height(),
			left: 40+(i-target)*0.8*$(window).width() 
		},400);
	}
	
	$('#login_box').hide('fast');
	$('#login_shim').hide('fast');

	

	menuitem = target;			
}
</script>
	
	
</head>
<body>
	
<!--img onClick="golink(0)" src="/images/activate.jpg" id="bg" alt=""-->

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

<div id=supersuperdiv>
<div id=superdiv>
	<div onClick="golink(1)" class='menuitem1'><?php echo INDEX_ABOUT; ?></div>
	<div onClick="golink(2)" class='menuitem2'><?php echo INDEX_LATEST; ?></div>
	<div onClick="golink(3)" class='menuitem3'>
		<?php
		
		$us = mysql_query('select * from users order by rand()');
		while($u = mysql_fetch_assoc($us)) {
			echo "<h1>".$u['user_realname']."</h1>";		
			echo "<p>".$u['user_publicdesc']."</p>";		
		}
		
		
		?>
	</div>
	<div onClick="golink(4)" class='menuitem4'><?php echo INDEX_CONTACT; ?></div>
</div>
</div>
<div id="shim"> </div>

<script>
	function doStuff() {
		for(i=1;i<=4;i++) {
			if(menuitem == 0) { 
				$('div.menuitem'+(i)).css('top',-100);		
				$('div.menuitem'+(i)).css('left',40+(i-1)*0.8*$(window).width());
			} else {
				for(i=1;i<=4;i++) {
					$('div.menuitem'+i).animate({ 
					top: 150,
					left: 40+(i-target)*0.8*$(window).width() 
				},400);
			}
				
			}
			
			$('div.menuitem'+(i)).css('width',0.6*$(window).width());	
			$('div.menuitem'+(i)).css('height',0.6*$(window).height());	
		}
		
	}
	$(window).resize(function() {
                doStuff();
        }).trigger("resize");
        
        doStuff();
</script>

<?php include("footer.php"); ?>

