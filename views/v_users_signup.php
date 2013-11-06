<div class='container'>
	<div class='row'>
		<div id='logo' class='col-md-4 col-md-offset-3 center'>
			<img src='/images/logo.png' alt='SOAPBOX' />
		</div>	
	</div>
	<div class='row'>	
		<div id='signup-menu'>
			<form class=' col-md-2 col-md-offset-2' method='POST' action='/users/p_signup'>
				<div id='signup' class='collapse'>
					<input type='text' name='first_name' placeholder='First Name' required>

					<input type='text' name='last_name' placeholder='Last Name' required>

					<input type='text' name='email' placeholder='Email' required>

					<input type='password' name='password' placeholder='Password' required>

					<input id='signUpButton' type='submit' class='btn btn-info' value='Sign up'>
				</div>
			</form>
			<a class='col-md-2 btn btn-info accordion-toggle' data-toggle='collapse' data-parent='#signup-menu' href='#signup'>
				Sign up
			</a>	 

		</div>
		<?php if($error == "errorEmail"): ?>
			<div class='row'>
				<div class = 'col-md-3 col-md-offset-7'>
					<p class='error'>The email you entered is already in our system.</p>
				</div>
			</div>	
		<?php endif; ?>
	


