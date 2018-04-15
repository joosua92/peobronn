$(document).ready(function() {
	var fun = function(data) {
		var returnData = JSON.parse(data);
		draw_charts(returnData);
	};
	$.post("input/get_visitor_stats", fun);
});

function draw_charts(data) {
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawCharts);
	var lang = document.getElementsByTagName('html')[0].getAttribute('lang');
	
	function drawCharts() {
		drawBrowserChart();
		drawCountryChart();
		drawTimeChart();
	}
	
	function drawBrowserChart() {
		var browsers = data.browsers;
		var chartData = [["Browser", "Count"]];
		$.map(browsers, function(value, index) {
			chartData.push([index, value]);
		});
        var options = {
			title: 'Veebilehitsejad',
			width: 500,
			height: 400,
			titleTextStyle: {fontSize: 20}
        };
		if (lang == 'en') {
			options.title = "Web browsers";
		}
		chartData = google.visualization.arrayToDataTable(chartData);
        var chart = new google.visualization.PieChart(document.getElementById('browser-piechart'));
        chart.draw(chartData, options);
	}
	
	function drawCountryChart() {
		var countries = data.countries;
		var chartData = [["Country", "Count"]];
		$.map(countries, function(value, index) {
			chartData.push([index, value]);
		});
        var options = {
			title: 'Riigid',
			width: 500,
			height: 400,
			titleTextStyle: {fontSize: 20}
        };
		if (lang == 'en') {
			options.title = "Countries";
		}
		chartData = google.visualization.arrayToDataTable(chartData);
        var chart = new google.visualization.PieChart(document.getElementById('country-piechart'));
        chart.draw(chartData, options);
	}
	
	function drawTimeChart() {
		var visit_times = data.visit_times;
		var chartData = [["Time range", "Count"]];
		$.map(visit_times, function(value, index) {
			chartData.push([index, value]);
		});
        var options = {
			title: 'Külastamise ajad',
			width: 500,
			height: 400,
			titleTextStyle: {fontSize: 20}
        };
		if (lang == 'en') {
			options.title = "Visit times";
		}
		chartData = google.visualization.arrayToDataTable(chartData);
        var chart = new google.visualization.PieChart(document.getElementById('time-piechart'));
        chart.draw(chartData, options);
	}
}