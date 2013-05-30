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
		bugName = $('#addBugForm>input[name=name]').val();
		
		if(!bugName)
			return false;

		$.ajax({
			type: "POST",
			url: '/dashboard/add/bug',
			data: $('#addBugForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
				insertTaskTo('#bug-list', bugName, data.taskId);
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
		featureName = $('#addFeatureForm>input[name=name]').val();

		if(!featureName)
			return false;

		$.ajax({
			type: "POST",
			url: '/dashboard/add/feature',
			data: $('#addFeatureForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
				insertTaskTo('#feature-list', featureName, data.taskId);
			},
			error: function(xhr, textStatus, error) {
				showAlert('error', error);
			}
		});

		return false;
	});
});