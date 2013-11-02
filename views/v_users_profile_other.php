
<div class="container">
	<div id="profile_and_add" class="col-md-10"> 
		<div class="row">
			<div class="col-md-5" id="profile">
			<h1>
				<?=$user[0]['first_name'];?> <?=$user[0]['last_name'];?>
			</h1>

			<?php if(isset($connections[$user[0]['user_id']])): ?>
	       			<p><a href='/posts/unfollow/<?=$post['post_user_id']?>'>Unfollow</a></p>

	    	<?php else: ?>
	        		<p><a href='/posts/follow/<?=$post['post_user_id']?>'>Follow</a></p>
	    	<?php endif; ?>

			<p> 
				<?=$user[0]['bio'];?>
			</p>
			<p> 
				<?=$user[0]['location'];?> - <a href='http://<?=$user[0]['website'];?>'><?=$user[0]['website'];?></a>
			</p>	
		</div>
	</div>
</div>
