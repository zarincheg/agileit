function showAlert(type, message) {
	alert = $($('#alert-'+type).html());
	alert.children('span').text(message);
	alert.appendTo('.alert-holder');
	alert.addClass('in');
	window.setTimeout(function(){alert.alert('close')}, 2000);
}

$(function() {
	$('ul.main-nav a[href="'+location.pathname+'"]').parent().addClass('active');

	$('#project-toggle span').text($('#projects-list li.selected a').text());
});