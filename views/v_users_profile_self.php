
<div class="container">
	<div id="profile_and_add" class="col-md-10"> 
		<div class="row">
			<div class="col-md-5" id="profile">
				<h1>
					<a href="#" id="first_name" name="first_name" title="click on any element in your profile to update it" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->first_name ?></a>
			 		<a href="#" id="last_name" name="last_name" title="click on any element in your profile to update it" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->last_name ?></a>
			 	</h1>

			 	<?php if(isset($connections[$user->user_id])): ?>
		       		<p><a href='/posts/unfollow/<?=$user->user_id?>'>Unfollow</a></p>

		    	<?php else: ?>
		        	<p><a href='/posts/follow/<?=$user->user_id?>'>Follow</a></p>
		    	<?php endif; ?>

				<p>
					<a href="#" id="bio" name="bio" title="click on any element in your profile to update it" data-type="textarea" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->bio ?></a>
				</p>	
				<p>
					<a href="#" id="location" name="location" title="click on any element in your profile to update it" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><?=$user->location ?></a>
					-
					<?php if(strpos($user->website, 'http://') === FALSE): ?>
						<a href='http://<?=$user->website?>'><?=$user->website?></a>
					<?php else: ?>
						<a href='<?=$user->website?>'><?=$user->website?></a>
					<?php endif; ?>	
					<a href="#" id="website" name="website" title="click on any element in your profile to update it" data-type="text" data-pk=<?=$user->user_id?> data-url="../users/p_edit_profile"><img src='/images/editIcon.png'></a>
				</p>
			</div>



