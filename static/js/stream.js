/**
 * Добавление записи в поток
 */
function addStreamItem() {
	var note = $('#addNoteForm :input[name=note]').val();

	if(!note) {
		return false;
	}

	$.ajax({
		type: "POST",
		url: $('#addNoteForm').attr('action'),
		data: $('#addNoteForm').serialize(),
		dataType: 'json',
		success: function(note, textStatus) {
			showAlert('success', textStatus);

			noteItem = $($('#note-item').html());
			noteItem.children('dd>span').text(note.text);
			noteItem.children('dt>span').text(note.author);
			noteItem.children('dt>em').text(note.date);
			noteItem.prependTo('#notes');
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});

	return false;
}

$(function() {
	$('#addNoteForm').submit(addStreamItem);
});