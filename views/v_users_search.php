<div class='container' id='search_results'>
	<?php foreach($results as $user): ?>
		<div class='row'>	
			<div class='col-md-6' id='search_result'>
		    
			    <a href='/users/profile/<?=$user["user_id"];?>'>
			    	<h1>
			    		<?=$user['first_name']?> <?=$user['last_name']?>
			    	</h1>
			    	<p>
			    		<?=$user['bio'];?>	
			    	</p>
			    	<p> 
			    		<?=$user['location'];?>
			    	</p>
			    </a>
			</div>
		</div>
	<?php endforeach; ?>
</div>