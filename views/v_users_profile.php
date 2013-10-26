
<h1>Hi, <?=$user->first_name?></h1>

<div> 
	<p><a href="#" id="first_name" name="first_name" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->first_name ?></a> <a href="#" id="last_name" name="last_name" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->last_name ?></a></p>
	<p><a href="#" id="bio" name="bio" data-type="textarea" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->bio ?></a></p>
	<p><a href="#" id="location" name="location" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->location ?></a></p>
	<p><a href="#" id="website" name="website" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->website?></a></p>
</div>

<link href="/../bootstrap3-editable/css/bootstrap-editable.css"/> 
<script src="/../bootstrap3-editable/js/bootstrap-editable.js"></script>

