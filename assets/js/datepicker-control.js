$(document).ready(function() {
	var fun = function(data) {
		disabledDates = JSON.parse(data);
		createDatepicker();
	}
	$.get("input/date_data", fun);
	
});

var disabledDates;

function createDatepicker() {
	// Create datepicker
	$("#datepicker").datepicker({
		altField: "#kuupäev",
		dateFormat: "dd/mm/yy",
		minDate: 0,
		maxDate: 31,
		beforeShowDay: getDateData
	});
	// Disable typing input
	$('#kuupäev').attr('readonly', true);
	// Change tooltip
	$("#date-tooltip-nojs").hide();
	$("#date-tooltip-js").show();
}

function getDateData(date) {
	var dateStr = date.getFullYear() + "-";
	if (date.getMonth() < 9) {
		dateStr += "0";
	}
	dateStr += (date.getMonth() + 1) + "-"; // offset fix (getMonth returns 0 - 11)
	if (date.getDate() < 10) {
		dateStr += "0";
	}
	dateStr += date.getDate();
	for (var i = 0; i < disabledDates.length; i++) {
		if (disabledDates[i] == dateStr) {
			return [false];
		}
	}
	return [true];
}