<div class='container'>
	<div class='row'>
		<div class='col-md-5 logo'>
			<img src='/images/logo.svg' />
		</div>
	</div>	
	<div id='accordion' class='row'>
		<button class='col-md-2 col-md-offset-5 btn btn-info accordion-toggle' data-toggle='collapse' data-parent='#accordion' href='#signup'>
			Sign up
		</button>	 
		<form class=' col-md-1' method='POST' action='/users/p_signup'>
			<div id='signup' class='collapse'>
				<input type='text' name='first_name' placeholder='First Name'>

				<input type='text' name='last_name' placeholder='Last Name'>

				<input type='text' name='email' placeholder='Email'>

				<input type='password' name='password' placeholder='Password'>

				<input id='signUpButton' type='submit' class='btn btn-info' value='Sign up'>
			</div>
			
		</form>
	</div>
	<?php if($error == "errorEmail"): ?>
		<div class='row'>
			<div class = 'col-md-3 col-md-offset-5'>
				<p class='error'>The email you entered is already in our system.</p>
			</div>
		</div>	
	<?php endif; ?>
</div>

<!--<script>
$(document).ready(function(){
	$('#signup').bind('expand' function(){
		$('#signUpButton').removeClass("accordion-toggle")
						  .removeAttr("data-toggle")
						  .removeAttr("data-parent")
						  .removeAttr("href");
	});
});
</script> -->