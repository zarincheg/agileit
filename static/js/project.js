/**
 * Добавление проекта
 */
function addProject() {
	var note = $('#addProjectForm :input[name=teammates]').val();

	if(!note) {
		return false;
	}

	$.ajax({
		type: "POST",
		url: $('#addProjectForm').attr('action'),
		data: $('#addProjectForm').serialize(),
		dataType: 'json',
		success: function(note, textStatus) {
			showAlert('success', textStatus);
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});

	return false;
}

$(function() {
	$('#addProjectForm').submit(addProject);
});