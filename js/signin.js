$(document).ready(function(){
	if ($(window).width() >= 480){
		$('#logo').html("<img src='/images/logo.png' />");
	} else {
		$('#logo').html("<img src='/images/logoSmall.png' />");
	}
});