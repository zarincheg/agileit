/**
 * Добавление баг-репорта
 */
function addBug() {
	bugName = $('#addBugForm input[name=name]').val();
		
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

			$('#addBugForm input[name=name]').val('');
			$('#addBugForm textarea[name=details]').text('');
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
	var featureName = $('#addFeatureForm input[name=name]').val();

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

			$('#addFeatureForm input[name=name]').val('');
			$('#addFeatureForm textarea[name=details]').val('');
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

	$('#bugs-chart').highcharts({
		chart: {
			zoomType: 'xy'
		},
		legend: {
			enabled: false
		},
		colors : ['#da532c', '#00a300', '#b91d47', '#2d89ef', '#2b5797', '#603cba', '#9f00a7', '#1e7145'],
		title: { text: '' },
		xAxis: {
			categories: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ]
		},
		yAxis: [{
			min: 0,
			title: { text: '' }
		},{
			min: 0,
			title: { text: '' },
			opposite: true,
			gridLineWidth: 0
		}],
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			type: "column",
			name: 'Opened',
			data: [4, 2, 1, 7, 5, 11, 2]

		},{
			type: "column",
			name: 'Closed',
			data: [1, 3, 5, 9, 1, 4, 4]

		},{
			type: 'spline',
			yAxis: 1,
			name: 'Commits',
			data: [83, 78, 98, 93, 106, 84, 105]
		}]
	});

	$('#features-chart').highcharts({
		chart: {
			zoomType: 'xy'
		},
		legend: {
			enabled: false
		},
		colors : ['#da532c', '#00a300', '#00aba9', '#2d89ef', '#2b5797', '#603cba', '#9f00a7', '#1e7145'],
		title: { text: '' },
		xAxis: {
			categories: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ]
		},
		yAxis: [{
			min: 0,
			title: { text: '' }
		},{
			min: 0,
			title: { text: '' },
			opposite: true,
			gridLineWidth: 0
		}],
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			type: "column",
			name: 'Opened',
			data: [4, 2, 1, 7, 5, 11, 2]

		},{
			type: "column",
			name: 'Closed',
			data: [1, 3, 5, 9, 1, 4, 4]

		},{
			type: 'spline',
			yAxis: 1,
			name: 'Commits',
			data: [83, 78, 98, 93, 106, 84, 105]
		}]
	});

	$('tspan:contains(Highcharts.com)').remove();
});