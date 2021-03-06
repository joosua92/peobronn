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
	$('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function() {
	// Submit registration form with AJAX
	$("#register-form").submit(function(event){
		event.preventDefault();
		var formData = $("#register-form").serialize();
		formData += "&ajax=true";
		var fun = function(data) {
			var returnData = JSON.parse(data);
			showAlert(returnData.alertType, returnData.alertMessage);
		};
		$.post("input/register", formData, fun);
	});
	
	// Submit login form with AJAX
	$("#login-form").submit(function(event){
		event.preventDefault();
		var formData = $("#login-form").serialize();
		formData += "&ajax=true";
		var fun = function(data) {
			var returnData = JSON.parse(data);
			if (returnData.hasOwnProperty("redirect")) {
				window.location.href = returnData.redirect;
			}
			else {
				showAlert(returnData.alertType, returnData.alertMessage);
			}
		};
		$.post("input/login", formData, fun)
	});
	
	// Log user out
	$("#logout-form").submit(function(event){
		event.preventDefault();
		var fun = function(data) {
			var returnData = JSON.parse(data);
			if (returnData.logoutStatus == "google") {
				googleSignOut();
				window.location.href = returnData.redirect;
			}
			else {
				window.location.href = returnData.redirect;
			}
		};
		var data = "ajax=true";
		$.post("input/logout", data, fun);
	});
	
	// Submit reservation form with AJAX
	$("#reserv-form").submit(function(event){
		event.preventDefault();
		var formData = $("#reserv-form").serialize();
		formData += "&ajax=true";
		var fun = function(data) {
			var returnData = JSON.parse(data);
			showAlert(returnData.alertType, returnData.alertMessage);
		};
		$.post("input/reserv", formData, fun);
	});
	
	// Delete user
	$("#delete-user-form").submit(function(event){
		event.preventDefault();
		var fun = function(data) {
			var returnData = JSON.parse(data);;
			if (returnData.accountType == "google" && returnData.alertType == "success") {
				googleSignOut();
			}
			window.location.href = returnData.redirect;
		};
		var formData = $("#delete-user-form").serialize();
		formData += "&ajax=true";
		$.post("input/delete_account", formData, fun);
	});
});

$(document).ready(function() {
	var fun = function() {
		location.reload();
	}
	$("#est-flag").click(function() {
		$.post("input/set_language/est", fun);
	});
	$("#eng-flag").click(function() {
		$.post("input/set_language/eng", fun);
	});
});

function showAlert(type, message) {
	// Shows the message in an alert box of specified type (in case #alert-box exists)
	var alertBox = $("#alert-box");
	alertBox.html(message);
	alertBox.removeClass("alert-success");
	alertBox.removeClass("alert-info");
	alertBox.removeClass("alert-warning");
	alertBox.removeClass("alert-danger");
	alertBox.addClass("alert-" + type);
	alertBox.show();
}

function onSignIn(googleUser) {
	var idToken = googleUser.getAuthResponse().id_token;
	//var targetUrl = "https://" + window.location.host + "/input/google_login";
	var targetUrl = "input/google_login";
	var sendData = "idToken=" + idToken;
	var fun = function(data) {
		var returnData = JSON.parse(data);
		if (returnData.loginStatus == "success") {
			window.location.href = returnData.redirect;
		}
		else if (returnData.loginStatus == "already in") {
			window.location.href = returnData.redirect;
		}
		else {
			showAlert(returnData.alertType, returnData.alertMessage);
			googleSignOut();
		}
	}
	$.post(targetUrl, sendData, fun);
}

function googleSignOut() {
	var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut();
	auth2.disconnect();
}

function onGoogleLoad() {
    gapi.load('auth2', function() {
		gapi.auth2.init();
    });
}
