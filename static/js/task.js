function closeTask() {
	$.ajax({
		type: "PUT",
		url: '/task/'+$('#task-actions').attr('data-task-id')+'/close',
		dataType: 'json',
		success: function(data, textStatus) {
			showAlert('success', textStatus);
			console.log(data);

			if(data.success) {
				var btn = $('#task-actions>button.btn-success');
				btn.removeClass('btn-success');
				btn.addClass('btn-danger');
				btn.text('Open');
				$('#task-actions').attr('data-task-status', 'close');
			}
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});
}

function openTask() {
	$.ajax({
		type: "PUT",
		url: '/task/'+$('#task-actions').attr('data-task-id')+'/open',
		dataType: 'json',
		success: function(data, textStatus) {
			showAlert('success', textStatus);
			console.log(data);

			if(data.success) {
				var btn = $('#task-actions>button.btn-danger');
				btn.removeClass('btn-danger');
				btn.addClass('btn-success');
				btn.text('Close');
				$('#task-actions').attr('data-task-status', 'open');
			}
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});
}

function statusHandler() {
	var taskStatus = $('#task-actions').attr('data-task-status'); 

	if(taskStatus == 'open') {
		closeTask();
	} else if(taskStatus == 'close') {
		openTask();
	}
}

$(function() {
	$('#task-actions>button:nth-child(1)').click(statusHandler);
});