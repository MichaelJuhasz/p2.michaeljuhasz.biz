<div id="signin_button" class="blue_button">Sign in</div>

<form method = "POST" action = "/users/p_login">
	<input type='text' name= 'email' placeholder='Email'>

	<input type = 'password' name = 'password' placeholder='Password'>

	<?php if($error == "errorP"): ?>
		<div class = 'error'>
			Login Failed.  The password you enetered was incorrect.
		</div>
	<?php elseif($error == "errorE"): ?>
		<div class = 'error'>
			Login Failed.  Email address not registered.
		</div>
	<?php endif; ?>

	<input type='submit' value = 'Sign in' >
</form>


<div id="signup_button" class="blue_button">Sign up</div>

<form method='POST' action='/users/p_signup' id="signup_form">

	<input type='text' name='first_name' placeholder='First name'>

	<input type='text' name='last_name' placeholder='Last name'>

	<input type='text' name='email' placeholder='Email address'>

	<input type='password' name='password' placeholder='Password'>s

	<input type='submit' value='signup'>
</form>