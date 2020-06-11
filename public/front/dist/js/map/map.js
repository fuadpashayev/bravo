window.addEventListener('DOMContentLoaded', function () {
	'use strict'; 

if (document.querySelector('#map') !== null) {
	initMap();
}

if (document.querySelector('#map1') !== null) {
	initInnerMap();
}
function initMap() {
		var myLatlng = new google.maps.LatLng(40.410519, 49.867317);
		var pos1 = new google.maps.LatLng(40.399763, 49.852098);
		var pos2 = new google.maps.LatLng(40.443026, 49.942817);

		var mapOptions = {
			zoom: 12,
			center: myLatlng
		}
		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		var marker = new google.maps.Marker({
			position: pos1,
			map: map,
			icon: './images/main/icon/pin.svg',
		});

		var marker = new google.maps.Marker({
			position: pos2,
			map: map,
			icon: './images/main/icon/pin.svg',
		});

}

function initInnerMap() {
	var myLatlng = new google.maps.LatLng(40.399763, 49.852098);
	var pos1 = new google.maps.LatLng(40.399763, 49.852098);


	var mapOptions = {
		zoom: 17,
		center: myLatlng
	}
	var map = new google.maps.Map(document.getElementById('map1'), mapOptions);

	var marker = new google.maps.Marker({
		position: pos1,
		map: map,
		icon: './images/main/icon/pin.svg',
	});

}


});