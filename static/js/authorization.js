function auth() {
	$.ajax({
		method: 'POST',
		url: $('#authForm').attr('action'),
		data: $('#authForm').serialize(),
		dataType: 'json',
		success: function(data, textStatus) {
			showAlert('success', textStatus);
			setTimeout(function() { window.location = '/dashboard' }, 1000);
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});
	return false;
}

$(function() {
	$('#authForm').submit(auth);
});