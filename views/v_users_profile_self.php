
<div class="container" id="profile">
	<div class="row"> 
		<div class="col-md-3">
			<h1>
				<a href="#" id="first_name" name="first_name" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->first_name ?></a>
		 		<a href="#" id="last_name" name="last_name" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->last_name ?></a>
		 	</h1>

		 	<?php if(isset($connections[$user->user_id])): ?>
	       		<p><a href='/posts/unfollow/<?=$post['post_user_id']?>'>Unfollow</a></p>

	    	<?php else: ?>
	        	<p><a href='/posts/follow/<?=$post['post_user_id']?>'>Follow</a></p>
	    	<?php endif; ?>

			<p>
				<a href="#" id="bio" name="bio" data-type="textarea" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->bio ?></a>
			</p>	
			<p>
				<a href="#" id="location" name="location" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->location ?></a>
				-
				<a href="#" id="website" name="website" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->website?></a>
			</p>
		</div>
	</div>
</div>

<link href="/../bootstrap3-editable/css/bootstrap-editable.css"/> 
<script src="/../bootstrap3-editable/js/bootstrap-editable.js"></script>

