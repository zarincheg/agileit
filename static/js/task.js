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
	$('button').popover();

	$('#comment-btn').on('shown.bs.popover', function () {
		$('#comment-btn>span').toggleClass('glyphicon-comment').toggleClass('glyphicon-floppy-save');
		$('div.popover').css({"left": '70pt', "max-width": '500pt'});
		$('div.popover>div.arrow').css({"left": '40pt'});
		$('div.popover-content').html('<textarea class="stream" rows="5" style="width: 400pt;border:1pt solid #ccc;"></textarea>');
	});

	$('#comment-btn').on('hidden.bs.popover', function () {
		$('#comment-btn>span').toggleClass('glyphicon-comment').toggleClass('glyphicon-floppy-save');
	});

	$('#branch-btn').on('shown.bs.popover', function () {
		$('#branch-btn>span')
			.toggleClass('octicon')
			.toggleClass('glyphicon')
			.toggleClass('octicon-git-branch')
			.toggleClass('glyphicon-floppy-save');
		$('div.popover').css({"left": '115pt', "max-width": '500pt'});
		$('div.popover>div.arrow').css({"left": '40pt'});
		$('div.popover-content').html('<input type="text" class="form-control" placeholder="Enter a branch name" style="width: 400pt;border:1pt solid #ccc;"></textarea>');
	});

	$('#branch-btn').on('hidden.bs.popover', function () {
		$('#branch-btn>span')
			.toggleClass('octicon')
			.toggleClass('glyphicon')
			.toggleClass('octicon-git-branch')
			.toggleClass('glyphicon-floppy-save');
	});
});