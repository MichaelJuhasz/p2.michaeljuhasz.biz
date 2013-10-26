<pre>
<?php print_r($users);?>
</pre>
<?php foreach($users as $userR): ?>
    
    <!-- Print this user's name -->
    <?=$userR['first_name']?> <?=$userR['last_name']?>

    <!-- If there exists a connection with this user, show a unfollow link -->
    <? if(isset($connections[$userR['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <? else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <? endif; ?>

    <br><br>

<?php endforeach; ?>