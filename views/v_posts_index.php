	<div id='post_container'>
		<header class='row'>
			<div class='col-md-3'>Posts</div>
		</header>
		<?php foreach($posts as $post): ?>
			<article class='post row'>
				<div class='col-md-7'>
				    <h1><a href="/users/profile/<?=$post['post_user_id'];?>"><?=$post['first_name']?> <?=$post['last_name']?></a></h1>

				    <?php if(isset($connections[$post['post_user_id']])): ?>
		       			<p><a href='/posts/unfollow/<?=$post['post_user_id']?>'>Unfollow</a></p>

		    		<?php else: ?>
		        		<p><a href='/posts/follow/<?=$post['post_user_id']?>'>Follow</a></p>
		    		<?php endif; ?>

				    <p><?=$post['content']?></p>

				    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
				        <?=Time::display($post['created'])?>
				    </time>
				</div>
			</article>

		<?php endforeach; ?> 
	</div>	
</div>
</div>
	
