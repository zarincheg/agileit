/**
 * Добавление записи в беклог
 */
function insertRecord(selector, record) {
	backlogItem = $($('#backlog-item').html());
	backlogItem.children('li>span').text(record.text);
	backlogItem.prependTo(selector);
}

/**
 * Удаление записи из беклога
 */
function removeRecord(record) {
	$.ajax({
		type: "GET",
		url: '/backlog/remove/' + record.attr('data-id'),
		dataType: 'json',
		success: function(data, textStatus) {
			showAlert('success', textStatus);
			record.remove();
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});
}

/**
 * Увеличение рейтинга записи беклога(повышение приоритета)
 */
function backlogUp(a) {
	var el = $(a).parent();
	var id = el.attr('data-id');
	var currRating = el.attr('data-rating');
	var prevRating = el.prev().attr('data-rating');

	$.ajax({
		type: "GET",
		url: '/backlog/up/' + id,
		dataType: 'json',
		success: function(data, textStatus) {
			showAlert('success', textStatus);
			
			if(++currRating >= prevRating) {
				var clone = el.clone();
				clone.attr('data-rating', currRating);
				clone.insertBefore(el.prev());
				el.remove();
			} else {
				el.attr('data-rating', currRating);
			}
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});
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

	$('.icon-remove').click(function(o) {
		var record = $(o.currentTarget).parent();
		var alert = $($('#confirm-remove').html());
		
		alert.appendTo('.alert-holder');
		alert.addClass('in');
		alert.children('p.confirm-buttons').children('a.btn-danger').click(function() {
			removeRecord(record);
			alert.alert('close');
		});

		alert.children('p.confirm-buttons').children('a.btn-cancel').click(function() {
			alert.alert('close');
		});
	});
});