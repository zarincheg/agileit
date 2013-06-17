/**
 * Добавление баг-репорта
 */
function addBug() {
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

			taskItem = $($('#task-item').html());
			taskItem.children('a').attr('href', '/task/'+data.taskId).text(bugName);
			taskItem.appendTo('#bug-list');
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});

	return false;
}

/**
 * Добавление задачи для нового функционала
 */
function addFeature() {
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
			
			taskItem = $($('#task-item').html());
			taskItem.children('a').attr('href', '/task/'+data.taskId).text(featureName);
			taskItem.appendTo('#feature-list');
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});

	return false;
}

$(function() {
	$('#addBugForm').submit(addBug);
	$('#addFeatureForm').submit(addFeature);
});