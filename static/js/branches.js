function setStatus(branch, status) {
	$.ajax({
		type: "POST",
		url: '/branch/'+branch+'/status/'+status,
		dataType: 'json',
		success: function(data, textStatus) {
			showAlert('success', textStatus);
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});
}