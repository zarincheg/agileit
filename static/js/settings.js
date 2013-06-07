$(function() {
	/**
	 * Сохраняем настройки
	 */
	$('#settingsForm').submit(function() {
		var repo = $('#settingsForm :input[name=repo]').val();
		var path = $('#settingsForm :input[name=path]').val();

		if(!repo || !path) {
			return false;
		}

		$.ajax({
			type: "POST",
			url: $('#settingsForm').attr('action'),
			data: $('#settingsForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
			},
			error: function(xhr, textStatus, error) {
				showAlert('error', error);
			}
		});

		return false;
	});
});