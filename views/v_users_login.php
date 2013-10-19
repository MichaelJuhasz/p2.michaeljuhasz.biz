<form method = "POST" action = "/users/p_login">
	<label for = 'email'>Email</label>
	<input type='text' name= 'email' id = 'email'>
	<br><br>

	<label for = 'password'>Password</label>
	<input type = 'password' name = 'password' id = 'password'>

	<br><br>

	<?php if($error == "errorP"): ?>
		<div class = 'error'>
			Login Failed.  The password you enetered was incorrect.
		</div>
	<?php elseif($error == "errorE"): ?>
		<div class = 'error'>
			Login Failed.  Email address not registered.
		</div>
	<?php endif; ?>

	<input type='submit' value = 'Log in' >
</form>