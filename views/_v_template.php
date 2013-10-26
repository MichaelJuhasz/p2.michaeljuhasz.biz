<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
						
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<div id='menu'>
		<a href='/'>Home</a>

		<!-- Menu for logged in users-->
		<?php if($user): ?>
			<a href='/users/logout'>Logout</a>
			<a href='/users/profile'>Profile</a>

		<!-- Menu for non-logged in -->
		<?php else: ?>
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>

		<?php endif; ?>
	</div>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>