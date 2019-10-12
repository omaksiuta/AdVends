function sweet_dessert_googlemap_init(dom_obj, coords) {
	"use strict";
	if (typeof SWEET_DESSERT_STORAGE['googlemap_init_obj'] == 'undefined') sweet_dessert_googlemap_init_styles();
	SWEET_DESSERT_STORAGE['googlemap_init_obj'].geocoder = '';
	try {
		var id = dom_obj.id;
		SWEET_DESSERT_STORAGE['googlemap_init_obj'][id] = {
			dom: dom_obj,
			markers: coords.markers,
			geocoder_request: false,
			opt: {
				zoom: coords.zoom,
				center: null,
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI: false,
				panControl: true,
				zoomControl: true, //zoom
				mapTypeControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: SWEET_DESSERT_STORAGE['googlemap_styles'][coords.style ? coords.style : 'default'],
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		};
		
		sweet_dessert_googlemap_create(id);

	} catch (e) {
		
		dcl(SWEET_DESSERT_STORAGE['strings']['googlemap_not_avail']);

	};
}

function sweet_dessert_googlemap_create(id) {
	"use strict";

	// Create map
	SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].map = new google.maps.Map(SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].dom, SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].opt);

	// Add markers
	for (var i in SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers)
		SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].inited = false;
	sweet_dessert_googlemap_add_markers(id);
	
	// Add resize listener
	jQuery(window).resize(function() {
		if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].map)
			SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].map.setCenter(SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].opt.center);
	});
}

function sweet_dessert_googlemap_add_markers(id) {
	"use strict";
	for (var i in SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers) {
		
		if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].inited) continue;
		
		if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].latlng == '') {
			
			if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].geocoder_request!==false) continue;
			
			if (SWEET_DESSERT_STORAGE['googlemap_init_obj'].geocoder == '') SWEET_DESSERT_STORAGE['googlemap_init_obj'].geocoder = new google.maps.Geocoder();
			SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].geocoder_request = i;
			SWEET_DESSERT_STORAGE['googlemap_init_obj'].geocoder.geocode({address: SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].address}, function(results, status) {
				"use strict";
				if (status == google.maps.GeocoderStatus.OK) {
					var idx = SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].geocoder_request;
					if (results[0].geometry.location.lat && results[0].geometry.location.lng) {
						SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = '' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();
					} else {
						SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = results[0].geometry.location.toString().replace(/\(\)/g, '');
					}
					SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].geocoder_request = false;
					setTimeout(function() { 
						sweet_dessert_googlemap_add_markers(id); 
						}, 200);
				} else
					dcl(SWEET_DESSERT_STORAGE['strings']['geocode_error'] + ' ' + status);
			});
		
		} else {
			
			// Prepare marker object
			var latlngStr = SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].latlng.split(',');
			var markerInit = {
				map: SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].map,
				position: new google.maps.LatLng(latlngStr[0], latlngStr[1]),
				clickable: SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].description!=''
			};
			if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].point) markerInit.icon = SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].point;
			if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].title) markerInit.title = SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].title;
			SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].marker = new google.maps.Marker(markerInit);
			
			// Set Map center
			if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].opt.center == null) {
				SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].opt.center = markerInit.position;
				SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].map.setCenter(SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].opt.center);				
			}
			
			// Add description window
			if (SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].description!='') {
				SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].infowindow = new google.maps.InfoWindow({
					content: SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].description
				});
				google.maps.event.addListener(SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].marker, "click", function(e) {
					var latlng = e.latLng.toString().replace("(", '').replace(")", "").replace(" ", "");
					for (var i in SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers) {
						if (latlng == SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].latlng) {
							SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].infowindow.open(
								SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].map,
								SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].marker
							);
							break;
						}
					}
				});
			}
			
			SWEET_DESSERT_STORAGE['googlemap_init_obj'][id].markers[i].inited = true;
		}
	}
}

function sweet_dessert_googlemap_refresh() {
	"use strict";
	for (id in SWEET_DESSERT_STORAGE['googlemap_init_obj']) {
		sweet_dessert_googlemap_create(id);
	}
}

function sweet_dessert_googlemap_init_styles() {
    "use strict";
	// Init Google map
	SWEET_DESSERT_STORAGE['googlemap_init_obj'] = {};
	SWEET_DESSERT_STORAGE['googlemap_styles'] = {
		'default': []
	};
	if (window.sweet_dessert_theme_googlemap_styles!==undefined)
		SWEET_DESSERT_STORAGE['googlemap_styles'] = sweet_dessert_theme_googlemap_styles(SWEET_DESSERT_STORAGE['googlemap_styles']);
}