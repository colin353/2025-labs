<?php

$uname = $_SESSION['user_name'];
$userid = $_SESSION['user_id'];
?>
<link rel=stylesheet href="<?php echo BASE_URL; ?>style/taskstyle.css" />
<script>
function goto(arg) {
	window.location = arg;
}

function sort_all_the_things() {
	var id = Array($(".sortabletask ul li").length);
	s = $(".sortabletask ul li:first-child");
	var c=0;
	while(s.length > 0) {
		id[c++] = s.children("input:hidden").val();
		s = s.next("li");
	}
	$.post("ajax/taskify.php",{sort: true, dp: $("#dude-or-project").val(), order: id});
}

function menu(e,a) {
	$(a).siblings().removeClass("selected");
	$(a).addClass("selected");
	if(e==1) $("span.autocomp-keyword").html("did");
	else $("span.autocomp-keyword").html("should");
	oldornew = e;
	reload_ajax();
}

function delete_this_task(a) {
	i = $("#trashul input:hidden").val();
	$.post("ajax/taskify.php",{deleteTask: true, id: i},function() {
		$("#trashul").html("");
	});
	
}

$(function() {
	var availableTaugs = [
		<?php 
		// Grab a list of users!
		
		$v = mysql_query("select * from users");
		while($u = mysql_fetch_assoc($v)) echo '"'.$u['user_name'].'",';
		echo "";
		?>
	];
	$( ".autocomp-name" ).autocomplete({
		source: availableTaugs, delay: 0, autoFocus: true
	});
	var availableTags = [
    <?php      
    // Grab a list of projects!
   
	$v = mysql_query("select * from projects");
	while($u = mysql_fetch_assoc($v)) echo '"'.$u['project_code'].'",';
	?>
	];
	$( ".autocomp-proj" ).autocomplete({
	source: availableTags, delay: 0, autoFocus: true
	}).keypress(function(event) { 
		if(event.which ==13) {
			proj = $(event.target).val();
			pers = $(event.target).siblings('.autocomp-name').val();
			desc = $(event.target).siblings('.autocomp-desc').val();
			$.post("ajax/taskify.php",{ state: oldornew, d : desc, p: proj, u : pers, addTask: true}, function() { 
				reload_ajax();
				$(event.target).siblings('.autocomp-desc').val("");
			} );
		}
	});
	taugs = availableTaugs.concat(availableTags);
	$( ".task-selector" ).autocomplete({
		source: taugs, delay: 0, autoFocus: true
		}).keypress(function(event) { 
			if(event.which ==13) {
				reload_ajax();				
			}
	});

	$("#trashul").sortable({ } );
		
			

});
</script>

<body>
<ul id=trashul></ul>
<h1>Tasks for  <input type=text class="task-selector" style="width: 150px;" value="<?php echo $uname; ?>" /></h1>

<div class=selector>
<span class=selected onClick='menu(0,this);'>to do</span>
<span onClick='menu(1,this)'>completed</span>
</div>

<div class=task_list>
<ul>
<li><input type=checkbox  /><input style="width: 100px;" value="<?php echo $uname; ?>" class="autocomp-name" type=text /> <span class="autocomp-keyword">should</span> <input style="width: 400px;" class="autocomp-desc" type=text /> for <input  style="width: 150px;" class="autocomp-proj" type=text></b></li>
</ul>	
</div>

<div class="task_list sortabletask">
		<ul contenteditable="false">
		<li><input type=checkbox /><b>Someone</b> should fix the to do list for <b>gods sake</b></li>
		</ul>
</div>

<script>

var oldornew = 0;
var week = 0;
function partyzeit() {
	reload_ajax();
	setTimeout("partyzeit",60000);
}
setTimeout("partyzeit",60000);
function reload_ajax() {

	var selector = $(".task-selector").val();
	$.post("ajax/taskify.php",{w: week, u: <?php echo $userid; ?>, getTask: oldornew, s: selector}, function(data) {
		$("div.sortabletask").html(data);
		if(oldornew==0) $('div.sortabletask > ul').sortable({
		    axis: 'y',
		    distance: 30,
		    connectWith: '#trashul',
		    update: sort_all_the_things,
		    start: function() {
				$("#trashul").show('fast');
			},
			stop: function() {
				$("#trashul").hide('fast');
			},
			remove: function(event,ui) { 
				if(!confirm("delete this task?")) 
					$(this).sortable('cancel');
				else delete_this_task(this);
			}
		});
		$("div.sortabletask > ul > li > input:checkbox").bind('change',function () {
			$(this).parent().hide('fast');
			$.post("ajax/taskify.php",{complete: true, id: $(this).siblings("input:hidden").val() });
		});
	});
}
reload_ajax();


	


</script>

</body>
</html>