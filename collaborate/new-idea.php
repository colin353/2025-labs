<h1>Create new idea</h1><br />

<form method=post action=<?php echo BASE_URL; ?>action.php class=inputForm>
<p>What is the title of the idea?</p><input name=title type=text placeholder="Write a short idea title." class=big value="" /></p>
<p>What is the idea?</p><textarea name=desc placeholder="Write a description of the idea." value=""></textarea>
<input type=hidden name=create_idea value=true />
<input type=hidden name=idea_unique	 value=<?php echo rand().rand(); ?> /><br />
<input type=submit value="Create idea"/>
</form>