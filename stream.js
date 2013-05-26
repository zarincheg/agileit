function insertNote(selector, note) {
	noteItem = $($('#note-item').html());
	noteItem.children('dd>span').text(note.text);
	noteItem.children('dt>span').text(note.author);
	noteItem.children('dt>em').text(note.date);
	noteItem.appendTo(selector);
}

$(function() {
	/**
	 * Добавляем запись в поток мыслей
	 */
	$('#addNoteForm').submit(function() {
		Note = $('#addNoteForm :input[name=note]').val();
		
		if(!Note) {
			return false;
		}

		$.ajax({
			type: "POST",
			url: '/rest.php',
			data: $('#addNoteForm').serialize(),
			dataType: 'json',
			success: function(data, textStatus) {
				showAlert('success', textStatus);
				insertNote('#notes', data);
			},
			error: function(xhr, textStatus, error) {
				showAlert('error', error);
			}
		});

		return false;
	});
});