<h1><?php echo COLLAB_NEW_PROJ_HEAD; ?></h1>
<form method=post action=action.php class=inputForm>
<p><?php echo COLLAB_NEW_PROJ_NAME;?></p><input type=text placeholder="<?php echo COLLAB_NEW_PROJ_TITLE2;?>" name=project_name value="" /></span><br />
<p><?php echo COLLAB_NEW_PROJ_DESC; ?></p><textarea placeholder="<?php echo COLLAB_NEW_PROJ_DESC2; ?>" name=project_description value=""></textarea>
<p><?php echo COLLAB_NEW_PROJ_PITCH; ?></p><textarea placeholder="<?php echo COLLAB_NEW_PROJ_PITCH2; ?>" class=big name=project_salespitch value=""></textarea></p>
<input type=hidden name=create value=true />
<input type=hidden name=project_unique value=<?php echo rand().rand(); ?> />
<input type=submit value="<?php echo COLLAB_NEW_PROJ_GO; ?>"/>
</form>