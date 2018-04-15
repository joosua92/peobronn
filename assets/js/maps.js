function initMap() {
	var lang = document.getElementsByTagName('html')[0].getAttribute('lang');
	var asukoht = {lat: 59.4323471, lng: 24.7380838 };

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 4,
		center: asukoht
	});
	
	var kirjeldus = "<strong>Meie asukoht</strong>";
	if (lang == "en") {
		kirjeldus = "<strong>Our location</strong>";
	}
	var marker = "";
	if (lang == "en") {
		marker = new google.maps.Marker({
			position: asukoht,
			map: map,
			title: 'Click, to zoom fast!'
		});
	} else {
		marker = new google.maps.Marker({
			position: asukoht,
			map: map,
			title: 'Vajuta, et zoomida kiirelt!'
		});
	}
	var markeriinfo = new google.maps.InfoWindow({
		content: kirjeldus
	});

	marker.addListener('click', function() {
	markeriinfo.open(map, marker);
	map.setZoom(17);
	map.setCenter(marker.getPosition());
	});
}
