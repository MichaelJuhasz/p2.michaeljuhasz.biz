<div class='container'>
	<div class='row'>
		<div id='accordion'>
			<button class='col-md-2 col-md-offset-5 btn btn-info accordion-toggle' data-toggle='collapse' data-parent='#accordion' href='#login'>
				Sign in
			</button>
			<form id='login' class='collapse col-md-1' method = 'POST' action = '/users/p_login'>
				<input type='text' name= 'email' placeholder='Email'>

				<input type = 'password' name = 'password' placeholder = 'Password'>

				<input type='submit' class='btn btn-info' value = 'Log in' >
			</form>
		</div>
	</div>
	<div class='row'>
		<?php if($error == "errorLogin"): ?>
			<div class = 'col-md-3 col-md-offset-5'>
				<p class='error'>Login Failed.  The email or password you enetered was incorrect.</p>
			</div>
		<?php elseif($error == "errorProtected"): ?>
			<div class = 'col-md-3 col-md-offset-5'>
				<p class='error'>You must be logged in to see this content</p>
			</div>	
		<?php endif; ?>
	</div>	
</div>