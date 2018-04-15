$(document).ready( function() {
	poll();
	$("#notification-close").click(function() {
		$("#notification-bar").hide();
	});
});

function poll() {
	$.ajax({
		type: "GET",
		url: "polling/reservationsRemoved",
		async: true,
		cache: false,
		timeout: 60000,
		success: function(data) {
			var returnData = JSON.parse(data);
			if (returnData.anyRemoved) {
				showRemoved(returnData.removedReservations);
				setTimeout(
					poll,
					5000);
			} else {
				setTimeout(
					poll,
					1000);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + " (" + errorThrown + ")");
            setTimeout(
                poll,
                10000);
        }
	});
};

function showRemoved(reservations) {
	var count = reservations.length;
	var outputText = "";
	var lang = document.getElementsByTagName('html')[0].getAttribute('lang');
	if (count == 1) {
		if (lang == "en") {
			outputText += "1 new available time: ";
		} else {
			outputText += "1 uus aeg on vaba: ";
		}
	} else {
		if (lang == "en") {
			outputText += count + " new available times: ";
		} else {
			outputText += count + " uut aega on vabad: ";
		}
	}
	for (var i = 0; i < reservations.length; i++) {
		if (i != 0) {
			outputText += ", ";
		}
		var reservation = reservations[i];
		outputText += reservation.kuupäev + " " + reservation.kellaaeg;1
	}
	$("#notification-text").text(outputText);
	$("#notification-bar").show();
}