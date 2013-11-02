
<?php foreach($results as $user): ?>

    <!-- Print this user's name -->
    <a href='/users/profile/<?=$user["user_id"];?>'>
    	<h1>
    		<?=$user['first_name']?> <?=$user['last_name']?>
    	</h1>
    	<p>
    		<?=$user['bio'];?>	
    	</p>
    </a>

<?php endforeach; ?>