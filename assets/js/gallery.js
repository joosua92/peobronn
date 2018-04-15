$(document).ready(function() {
	var hash = document.location.hash;
	if (hash == "#showAll") {
		loadAllGames();
	}
	$("#all-games-button").click(function() {
		loadAllGames();
	});
});

function loadAllGames() {
	var fun = function(data) {
		var returnData = JSON.parse(data);
		var base = 8;
		var lang = document.getElementsByTagName('html')[0].getAttribute('lang');
		for (var i = 0; i < returnData.length; i++) {
			var game = returnData[i];
			var disp = "";
			disp += '<div class="col-lg-3 col-md-4 col-xs-6">';
			disp += '<img class="img-fluid img-thumbnail" src="' + window.location.origin + '/assets/images/mangupildid/' + game.image + '" alt="">';
			disp += '<p class="game-title text-center">';
			disp += game.title;
			disp += '</p>';
			disp += '<p>';
			if (lang == "en") {
				disp += game.english_description;
			} else {
				disp += game.estonian_description;
			}
			disp += '</p>';
			disp += '</div>';
			var clearfixVisible = "";
			if ((i + 1 + base) % 2 == 0) {
				clearfixVisible += ' visible-xs';
			}
			if ((i + 1 + base) % 3 == 0) {
				clearfixVisible += ' visible-md';
			}
			if ((i + 1 + base) % 4 == 0) {
				clearfixVisible += ' visible-lg';
			}
			if (clearfixVisible != "") {
				disp += '<div class="clearfix' + clearfixVisible + '"></div>' + "\n";
			}
			$("#games-gallery").append(disp);
		}
		$("#all-games-button").hide();
		history.replaceState({}, "", "mangud#showAll");
	}
	$.get("input/get_remaining_games", fun);
}