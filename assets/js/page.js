$(document).ready(function() {
	// Set active navitem
	var navItems = document.getElementById("navbar").childNodes;
	for (var i = 0; i < navItems.length; i++) {
		if (navItems[i].nodeName != "LI") {
			continue;
		}
		var itemPage = navItems[i].firstChild.getAttribute("href").split("/");
		itemPage = itemPage[itemPage.length - 1];
		var currentPage = window.location.pathname.split("/");
		currentPage = currentPage[currentPage.length - 1];
		if (itemPage == currentPage) {
			navItems[i].setAttribute("class", "active");
		}
	}
});

$(document).ready(function() {
	// Submit registration form with AJAX
	$("#register-form").submit(function(event){
		event.preventDefault();
		var formData = $("#register-form").serialize();
		var fun = function(data) {
			var returnData = JSON.parse(data);
			showAlert(returnData.alertType, returnData.message);
		};
		$.post("input/register", formData, fun)
	});
});

function showAlert(type, message) {
	// Shows the message in an alert box of specified type (incase "#alert-box" exists)
	var alertBox = $("#alert-box");
	alertBox.html(message);
	alertBox.removeClass("alert-success");
	alertBox.removeClass("alert-info");
	alertBox.removeClass("alert-warning");
	alertBox.removeClass("alert-danger");
	alertBox.addClass("alert-" + type);
	alertBox.show();
}

/* VALIDATION SHOULD MOVE TO PHP, DELETE THIS AFTER
function validateRegistration() {
	// Check if registartion form fields have proper values
	// eesnimi
	var eesnimi = $("#eesnimi").val();
	var pattern = /^[a-zA-ZõäöüÕÄÖÜ -]+$/;
	if (eesnimi.length == 0) {
		showAlert("danger", "Eesnimi on nõutud.");
		return false;
	}
	if (!pattern.test(eesnimi)) {
		showAlert("danger", "Eesnimi ei sobi.");
		return false;
	}
	// perenimi
	var perenimi = $("#perenimi").val();
	pattern = /^[a-zA-ZõäöüÕÄÖÜ-]+$/;
	if (perenimi.length == 0) {
		showAlert("danger", "Perenimi on nõutud.");
		return false;
	}
	if (!pattern.test(perenimi)) {
		showAlert("danger", "Perenimi ei sobi.");
		return false;
	}
	// email
	var email = $("#email").val();
	// telefon
	var telefon = $("#telefon").val();
	// salasõna
	var salasõna = $("#salasõna").val();
	// kordaSalasõna
	var kordaSalasõna = $("#korda-salasõna").val();
	
	//return true;
	showAlert("success", "KÕIK KORRAS");
	return false;
}*/
