function insertRecord(selector, record) {
	backlogItem = $($('#backlog-item').html());
	backlogItem.children('li>span').text(record.text);
	backlogItem.prependTo(selector);
}

$(function() {
	/**
	 * Добавляем запись в беклог
	 */
	$('#addBacklogForm').submit(function() {
		var record = $('#addBacklogForm :input[name=record]').val();
		
		if(!record) {
			return false;
		}

		$.ajax({
			type: "POST",
			url: $('#addBacklogForm').attr('action'),
			data: $('#addBacklogForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
				insertRecord('#backlog', data);
			},
			error: function(xhr, textStatus, error) {
				showAlert('error', error);
			}
		});

		return false;
	});
});