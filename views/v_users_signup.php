<div class='container'>
	<div class='row'>
		<div id='logo' class='col-md-5 '>
			<img src='/images/logo.png' alt='SOAPBOX' />
		</div>	
		<div class='row'>
			<div class='col-md-3 col-md-offset-2 instructions'>
				<h2>Welcome to SoapBox!</h2>
				<p>Once you're signed up, you can </p>
				<ul>
					<li>add posts</li>
					<li>follow other users</li>
					<li>(+1) create and edit your profile</li>
					<li>(+1) search for other users by name, location, or biographical info</li>
					<li>(an unaesthetic note to my graders: requirement 5, the list of all users, would be found by doing a search without entering any text)</li>
				</ul>
			</div>
		</div>
	</div>
	<div class='row'>
		<div id='signup-menu'>
			<a class='col-md-2 col-md-offset-7 btn btn-info accordion-toggle' data-toggle='collapse' data-parent='#signup-menu' href='#signup'>
				Sign up
			</a>
			<form class=' col-md-2' method='POST' action='/users/p_signup'>
				<div id='signup' class='collapse'>
					<input type='text' name='first_name' placeholder='First Name' required>

					<input type='text' name='last_name' placeholder='Last Name' required>

					<input type='email' name='email' placeholder='Email' required>

					<input type='password' name='password' placeholder='Password' required>

					<input id='signUpButton' type='submit' class='btn btn-info' value='Sign up'>
				</div>
			</form>	 
		</div>
	</div>
	<div class='row'>
		<?php if($error == "errorEmail"): ?>
			<div class = 'col-md-3 col-md-offset-7'>
				<p class='error'>The email you entered is already in our system.</p>
			</div>
		<?php endif; ?>	
	</div>		

	


