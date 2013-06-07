/**
 * Увеличение рейтинга записи беклога(повышение приоритета)
 */
function backlogUp(o) {
	var el = $(o.currentTarget).parent();
	var id = el.attr('data-id');
	var currRating = el.attr('data-rating');
	var prevRating = el.prev().attr('data-rating');
console.log(el);
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

/**
 * Добавление записи в беклог
 */
function addBacklogItem() {
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
			backlogItem = $($('#backlog-item').html());
			backlogItem.children('li>span').text(data.text);
			backlogItem.prependTo('#backlog');
		},
		error: function(xhr, textStatus, error) {
			showAlert('error', error);
		}
	});

	return false;
}

/**
 * Удаление записи из беклога с предварительным отображением подтверждения
 */
function removeBacklogItem(o) {
	var record = $(o.currentTarget).parent();
	var alert = $($('#confirm-remove').html());
	
	alert.appendTo('.alert-holder');
	alert.addClass('in');
	alert.children('p.confirm-buttons').children('a.btn-danger').click(function() {
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
		alert.alert('close');
	});

	alert.children('p.confirm-buttons').children('a.btn-cancel').click(function() {
		alert.alert('close');
	});
}

$(function() {
	/**
	 * Назначение обработчиков событий
	 */
	$('#addBacklogForm').submit(addBacklogItem);
	$(document).on('click', '.icon-thumbs-up', backlogUp);
	$(document).on('click', '.icon-remove', removeBacklogItem);
});