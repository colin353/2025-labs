<?php 

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location: /m');

include("header.php");
require('include/qrlogin.php'); 

if(isAuthenticated()) header('Location: /collaborate/');
$ref = "/";
if(isset($_SESSION['deauthenticated'])) {
	$ref = $_SESSION['ref'];	
} else $ref = "/";


// qrlogin session start!

$qrlogin_creds = create_browsersession();


?>

<script src="/js/jquery.qtip.min.js"> </script>
<script type=text/javascript>

// Create the tooltips only on document load
$(document).ready(function() 
{
   // Match all link elements with href attributes within the content div
   $('#login_box').qtip(
   {
      content: { 
      	text: 'Verified? <br />Sign in with your phone! <br /> <img src=/qr.php?q=<?php echo $qrlogin_creds['l']; ?> />',
      	prerender: true
      	}, // Give it some content, in this case a simple string
      	show: 'mouseover',
      	style: {
      		tip: {
      			corner: 'leftMiddle',
      			color: '#555555'
      		}
      	},
      	position: {
      corner: {
         target: 'rightMiddle',
         tooltip: 'leftMiddle'
      }
   }
   });
   
   $('#username_text').focus(function() {
   		$('#login_box').qtip('show');
   })
   
   function listen() {
    $.get("/comet.php?q=<?php echo $qrlogin_creds['l']; ?>", {}, function(data) {
        if(data == '') listen(); // then launch again
        else {
        	$.post("<?php echo BASE_URL . "login.php"; ?>",{a: "<?php echo $qrlogin_creds['l']; ?>", b: data},function () {
        		//alert(data);
				window.location = "/";       		
        	});       	
        }
    });
};

listen();   
});

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
colors[1] = "#AACCDD";
colors[2] = "#AADDAA";
colors[3] = "#DDAAAA";
colors[4] = "#EECC99";
	
function golink(target) {
	if(target == menuitem) return;
	
	$('body').animate({
			'background-color':colors[target]
		},'slow');
	
	$('#login_box').qtip('hide');
	
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
			<input autofocus id=username_text type=text placeholder="username" name=username />
			<input type=password placeholder="password" name=password />
			<input type=hidden name=direct value='<?php echo $ref; ?>' />
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
			echo "<h1><a class=secretlink href='mailto:".$u['user_email']."'>".$u['user_realname']."</a></h1>";		
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

