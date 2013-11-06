$(document).ready(function(){
	if (($window).width() >= 768){
		$('#logo').html("<img src='/images/logo.png' />");
	} else if (($window).width() >= 480){
		$('#logo').html("<img src='/images/logoSmall.png' />");
	}
}