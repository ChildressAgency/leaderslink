jQuery(document).ready(function($){
  $(window).scroll(function(){
    if($(document).scrollTop()){
      $('body').addClass('small-header');
    }
    else{
      $('body').removeClass('small-header');
    }
  });

  if(typeof $.fn.lightSlider == 'function'){
    $('#sliderBar .slider-bar').lightSlider({
      item:3,
      loop:true,
      slideMargin:0,
      pager:false,
      responsive:[
        {
          breakpoint:991,
          settings:{
            item:2
          }
        },
        {
          breakpoint:767,
          settings:{
            item:1
          }
        }
      ]
    });

    $('#testimonialSlider').lightSlider({
      item:1,
      loop:true,
      pager:false,
      controls:false,
      auto:true,
      keyPress:true,
      adaptiveHeight:true,
      pause:5000,
      onAfterSlide:function(el){
        $(window).trigger('resize').trigger('scroll');
      }
    });
  }

  //$('.acf-map').each(function(){
    //map = new_map($(this));
  //  map = project_map($(this));
	//});
});

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

google.maps.event.addDomListener(window, 'load', initialize);

//function project_map($el){

  var overlay;
USGSOverlay.prototype = new google.maps.OverlayView();

// Initialize the map and the custom overlay.

//var myLatlng = new google.maps.LatLng(39.335851, -98.313712)  //somewhere in Kansas
//var myLatlng = new google.maps.LatLng(39.5, -98.35); //wiki center
var myLatlng = new google.maps.LatLng(37.09024,-95.712891)
//var myLatlng2 = new google.maps.LatLng(60, 24);
//function initialize() {

function initialize(){
  var mapOptions = {
    zoom: 4,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    backgroundColor: '#FFF',
    disableDefaultUI: true,
    draggable: true,
    scaleControl: false,
    scrollwheel: false,
    styles: [
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "landscape",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "road",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "administrative",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "administrative",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "elementType": "labels",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
  }
]
  };

  //var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var map = new google.maps.Map(document.getElementById('projectMap'), mapOptions);

  /*
  geocoder = new google.maps.Geocoder();
  function codeAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }

  codeAddress('Turku')
  codeAddress('Naantali')
  codeAddress('Oulu')
  codeAddress('Imatra')
  codeAddress('Mannerheimintie 2, Helsinki')
*/

  var $markers = $('#projectMapMarkers').find('.marker');
  map.markers = [];
  $markers.each(function(){
    //add_marker($(this), map);
    	var latlng = new google.maps.LatLng( $markers.attr('data-lat'), $markers.attr('data-lng') );
    // create marker
    var marker = new google.maps.Marker({
      position	: latlng,
      icon: 'images/leaderslink-marker.png',
      map			: map
    });
    // add to array
    map.markers.push( marker );
    // if marker contains HTML, add it to an infoWindow
    if( $markers.html() )
    {
      // create info window
      var infowindow = new google.maps.InfoWindow({
        content		: $marker.html()
      });
      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open( map, marker );
      });
    }
  });

  //var swBound = new google.maps.LatLng(25.82, -124.39);
  //var neBound = new google.maps.LatLng(49.38, -66.94);
 
 var swBound = new google.maps.LatLng(24.82, -127.39);
 var neBound = new google.maps.LatLng(48.38, -68.94);

  //var swBound = new google.maps.LatLng(25.82, -125.39);
  //var neBound = new google.maps.LatLng(48.38, -68.94);
  //var neBound = new google.maps.LatLng(70.138358, 29.874602);
  var bounds = new google.maps.LatLngBounds(swBound, neBound);

  //var srcImage = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Finland_Regions_Map.svg/2000px-Finland_Regions_Map.svg.png';
  var srcImage = 'images/us-map.jpg'

  overlay = new USGSOverlay(bounds, srcImage, map);
}
// [END region_initialization]

// [START region_constructor]
/** @constructor */
function USGSOverlay(bounds, image, map) {

  // Initialize all properties.
  this.bounds_ = bounds;
  this.image_ = image;
  this.map_ = map;

  // Define a property to hold the image's div. We'll
  // actually create this div upon receipt of the onAdd()
  // method so we'll leave it null for now.
  this.div_ = null;

  // Explicitly call setMap on this overlay.
  this.setMap(map);
}
// [END region_constructor]

// [START region_attachment]
/**
 * onAdd is called when the map's panes are ready and the overlay has been
 * added to the map.
 */
USGSOverlay.prototype.onAdd = function() {

  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = '100%';
  img.style.height = '100%';
  img.style.position = 'absolute';
  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayLayer.appendChild(div);
};
// [END region_attachment]

// [START region_drawing]
USGSOverlay.prototype.draw = function() {

  // We use the south-west and north-east
  // coordinates of the overlay to peg it to the correct position and size.
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  // Retrieve the south-west and north-east coordinates of this overlay
  // in LatLngs and convert them to pixel coordinates.
  // We'll use these coordinates to resize the div.
  var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
  var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

  // Resize the image's div to fit the indicated dimensions.
  var div = this.div_;
  div.style.left = sw.x + 'px';
  div.style.top = ne.y + 'px';
  div.style.width = (ne.x - sw.x) + 'px';
  div.style.height = (sw.y - ne.y) + 'px';
};
// [END region_drawing]

// [START region_removal]
// The onRemove() method will be called automatically from the API if
// we ever set the overlay's map property to 'null'.
USGSOverlay.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};
// [END region_removal]

//}

function new_map( $el ) {
	// var
	var $markers = $el.find('.marker');
  // vars
  var styledMapType = new google.maps.StyledMapType(
  [
  {
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#ffffff"
      },
      {
        "visibility": "on"
      },
      {
        "weight": 8
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.neighborhood",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffffff"
      },
      {
        "visibility": "on"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#ffffff"
      },
      {
        "visibility": "on"
      },
      {
        "weight": 3
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#55acee"
      },
      {
        "visibility": "on"
      }
    ]
  },
  {
    "featureType": "landscape.natural.landcover",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffffff"
      },
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "stylers": [
      {
        "color": "#ffffff"
      },
      {
        "visibility": "on"
      }
    ]
  }
],
{name:'Styled Map'});

	var args = {
		zoom		: 5,
    center		: new google.maps.LatLng(0, 0),
    //center: {lat: 38.3032, lng: -77.4605},
    //mapTypeId	: google.maps.MapTypeId.ROADMAP
    mapTypeControlOptions:{
      mapTypeIds:['roadmap', 'satellite', 'hybrid', 'terrain', 'styled_map']
    }
	};
	// create map	        	
  var map = new google.maps.Map( $el[0], args);
  
  map.mapTypes.set('styled_map', styledMapType);
  map.setMapTypeId('styled_map');
	// add a markers reference
	map.markers = [];
	// add markers
	$markers.each(function(){
    	add_marker( $(this), map );
	});
	
	// center map
	center_map( map );
	
	// return
	return map;
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {
	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});
	// add to array
	map.markers.push( marker );
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open( map, marker );
		});
	}
}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {
	// vars
	var bounds = new google.maps.LatLngBounds();
	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
		bounds.extend( latlng );
	});
	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 4 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}
}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;