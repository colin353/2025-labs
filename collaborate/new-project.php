<h1>Create new project</h1>
<form method=post action=action.php class=inputForm>
<p>Project name: </p><input type=text placeholder="Title of the project." name=project_name value="" /></span><br />
<p>Project description: </p><textarea placeholder="Brief description of the project." name=project_description value=""></textarea>
<p>Elevator pitch: </p><textarea placeholder="Explanation of why 2025 should participate in this project." class=big name=project_salespitch value=""></textarea></p>
<input type=hidden name=create value=true />
<input type=hidden name=project_unique value=<?php echo rand().rand(); ?> />
<input type=submit value="Create Project"/>
</form>