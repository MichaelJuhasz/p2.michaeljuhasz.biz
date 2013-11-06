<div class='row'>	
	<div id='signin'>
		<a class='col-md-2 col-md-offset-7 btn btn-info accordion-toggle ' data-toggle='collapse' data-parent='#signin' href='#login'>
			Log in
		</a>
		<form id='login' class='collapse col-md-1 ' method = 'POST' action = '/users/p_login'>
			<input type='text' name= 'email' placeholder='Email'>

			<input type = 'password' name = 'password' placeholder = 'Password'>

			<input type='submit' class='btn btn-info' value = 'Log in' >
		</form>
	</div>
	<div class='row'>
		<?php if($error == "errorLogin"): ?>
			<a class = 'col-md-3 col-md-offset-7'>
				<p class='error'>Login Failed.  The email or password you enetered was incorrect.</p>
			</a>
		<?php elseif($error == "errorProtected"): ?>
			<div class = 'col-md-3 col-md-offset-7'>
				<p class='error'>You must be logged in to see this content</p>
			</div>	
		<?php endif; ?>
	</div>
</div>			
