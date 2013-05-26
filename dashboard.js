function insertTaskTo(selector, name, id) {
	taskItem = $($('#task-item').html());
	taskItem.children('a').attr('href', '/task/'+id).text(name);
	taskItem.appendTo(selector);
}

$(function() {
	/**
	 * Добавляем запись о новом баге.
	 */
	$('#addBugForm').submit(function() {
		bugName = $('#addBugForm>input[name=bug]').val();
		
		if(!bugName)
			return false;

		$.ajax({
			type: "POST",
			url: '/rest.php',
			data: $('#addBugForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
				insertTaskTo('#bug-list', bugName, 123);
			},
			error: function(xhr, textStatus, error) {
				showAlert('error', error);
			}
		});

		return false;
	});

	/**
	 * Добавляем задачу для нового функционала
	 */
	$('#addFeatureForm').submit(function() {
		featureName = $('#addFeatureForm>input[name=feature]').val();

		if(!featureName)
			return false;

		$.ajax({
			type: "POST",
			url: '/rest.php',
			data: $('#addFeatureForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
				insertTaskTo('#feature-list', featureName, 567);
			},
			error: function(xhr, textStatus, error) {
				showAlert('error', error);
			}
		});

		return false;
	});
});