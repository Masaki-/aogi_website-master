var styleallay =
[
  {
    "stylers": [
      { "lightness": 1 },
      { "gamma": 1 },
      { "hue": "#0091ff" },
      { "saturation": -30 }
    ]
  }
];

  var flagIcon_front = new google.maps.MarkerImage(templatePath + "/images/about/map_pin.png");
    flagIcon_front.size = new google.maps.Size(82, 77);
    flagIcon_front.anchor = new google.maps.Point(41, 50);
    flagIcon_front.scaledSize = new google.maps.Size(82, 77);

var mapCanvasYoyogi;
var mapCanvasYokohama;
var mapCanvasSendai;

function intialize() {

	mapCanvasYoyogi = new google.maps.Map(document.getElementById("school_map"), {
		center : new google.maps.LatLng(35.6845771,139.7007181),
		zoom : 17,
		scrollwheel: false,
		styles: styleallay
	});
	var markerYoyogi = new google.maps.Marker({
		position : new google.maps.LatLng(35.6845771,139.7007181),
		map: mapCanvasYoyogi,
		icon: flagIcon_front,
	});

  mapCanvasYokohama = new google.maps.Map(document.getElementById("yokohama_map"), {
    center : new google.maps.LatLng(35.4687561,139.6172775),
    zoom : 17,
    scrollwheel: false,
    styles: styleallay
  });
  var markerYokohama = new google.maps.Marker({
    position : new google.maps.LatLng(35.4687561,139.6172775),
    map: mapCanvasYokohama,
    icon: flagIcon_front,
  });

  mapCanvasSendai = new google.maps.Map(document.getElementById("sendai_map"), {
    center : new google.maps.LatLng(38.2633352,140.8784663),
    zoom : 17,
    scrollwheel: false,
    styles: styleallay
  });
  var markerSendai = new google.maps.Marker({
    position : new google.maps.LatLng(38.2633352,140.8784663),
    map: mapCanvasSendai,
    icon: flagIcon_front,
  });

}

google.maps.event.addDomListener(window, "load", intialize);