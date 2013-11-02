<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/>	

	<link href="/css/general.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
						
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<div class='navbar navbar-inverse navbar-fixed-top' role ='navigation' id='menu'>
		<div class='container'>
			<ul class='nav navbar-nav'>

				<!-- Menu for logged in users-->
				<?php if($user): ?>
					<li><a href='/users/profile'><?=$user->first_name;?></a></li>
					<li><a href='/users/logout'>Logout</a></li>

				<!-- Menu for non-logged in -->
				<?php else: ?>
					<li><a href='/users/signup'>Sign up</a></li>
					<li><a href='/users/login'>Log in</a></li>

				<?php endif; ?>

				<li>
					<form id='searchbar' method='POST' action='/users/p_search'>
						<input type='text' name='search' placeholder="Search by name or email">
						<input type='submit' value='Search'>
					</form>
				</li>
			</ul>
		</div>
	</div>
	
	<!--<?php for ($i = 1; $i < 5; $i++) {
		if(isset(${$content.$i})) echo ${$content.$i}; 
		};?>-->
	<?php if(isset($content1)) echo $content1; ?>
	<?php if(isset($content2)) echo $content2; ?>
	<?php if(isset($content3)) echo $content3; ?>		

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>