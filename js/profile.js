// $("#edit_toggle").click(function(){
// 	$("#hidden-form").slideToggle("slow");
// 	});

$(document).ready(function(){
	$.fn.editable.defaults.mode = 'inline';
	$("#bio").editable();
	$("#location").editable();
	$("#website").editable();
	$("#first_name").editable();
	$("#last_name").editable();
});
