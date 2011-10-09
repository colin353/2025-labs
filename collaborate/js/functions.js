function addNewThing() {
	$('#new_status_update').show('fast');	
	$('#the_data').focus();	
}

function addNewResource() {
	$('#new_resource').show('fast');		
	$('#the_resource_title').focus();
}

function new_status() {
	$.post(BASE_URL+'action.php',{status: true, p: request_q, q: $("#the_data").val()}, function(data) {
	  			window.location.reload(true);
		 }
	);
	return false;
}
function new_resource() {
	$.post(BASE_URL+'action.php',{resource: true, p: request_q,t:$("#the_resource_title").val(), q: $("#the_resource_data").val()}, function(data) {
	  			window.location.reload(true);
		 }
	);
	return false;
}

function actionMenu(url)  {
	window.location = url;	
}

function newTaskSubmit(arg) {
	$.post(BASE_URL+'action.php',{newtask: true, u: $("#select"+arg).val(), m: arg, t: $("#todo_entry"+arg).val(), q: $("#the_resource_data").val()}, function(data) {	  			
	  	
	  			window.location.reload(true);
		 }
	);
	return false;
}
function newMilestoneSubmit(arg) {
	$.post(BASE_URL+'action.php',{newmilestone: true, p : request_q, t:$("#newmilestone").val()}, function(data) {
	  			window.location.reload(true);
		 }
	);
	return false;
}

function task_delete(cht) {
		$.post(BASE_URL+'action.php',{deletetask: true, id : cht}, function(data) {
	  			//alert(data);
	  			window.location.reload(true);
		 });
}

function delete_milestone(cht) {
		$.post(BASE_URL+'action.php',{deletemilestone: true, id : cht}, function(data) {
	  			//alert(data);
	  			window.location.reload(true);
		 });
}

function chTask(cht) {
	if($("#check"+cht).is(':checked'))  // Check'd
		$("#task"+cht).css('text-decoration','line-through');
	else $("#task"+cht).css('text-decoration','none');
	
	$.post(BASE_URL+'action.php',{complete_task: true, t:cht, s: $("#check"+cht).is(':checked')}, function(data) {
	  			
		 }
	);
}

function addMeToProject(q,r) {
		$.post(BASE_URL+'action.php',{addmetoproject: true, id: q, rol : r}, function(data) {
	  			
	  			window.location.reload(true);
		 }
	);
}
