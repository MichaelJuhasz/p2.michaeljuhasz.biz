<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/>	

	<link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Quattrocento' rel='stylesheet' type='text/css'>

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
						<link href='http://fonts.googleapis.com/css?family=Quattrocento' rel='stylesheet' type='text/css'>
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	<link href="/css/general.css" rel="stylesheet">
</head>

<body class='anti-bootstrap'>	
	<div class='navbar navbar-inverse navbar-fixed-top' role ='navigation' id='menu'>
		<div class='container'>
			<ul class='nav navbar-nav'>

				<li><a href="/">Logo</a></li>

				<!-- Menu for logged in users-->
				<?php if($user): ?>
					<li><a href='/users/profile'><?=$user->first_name;?></a></li>
					<li><a href='/users/logout'>Logout</a></li>

				<?php endif; ?>

				<li>
					<form id='searchbar' class='navbar-form' role='search' method='POST' action='/users/p_search'>
						<div class='input-group'>
							<input type='text' name='search' class='form-control'>
							<div class='input-group-btn'>
								<button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i></button>
							</div>
						</div>	
					</form>
				</li>
			</ul>
		</div>
	</div>
	
	<!--<?php for ($i = 1; $i < 5; $i++) {
		if(isset(${$content.$i})) echo ${$content.$i}; 
		};?>-->
	<!-- <div class='container'>	 -->
		<?php if(isset($content1)) echo $content1; ?>
		<?php if(isset($content2)) echo $content2; ?>
		<?php if(isset($content3)) echo $content3; ?>		
	<!-- </div>	 -->

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>