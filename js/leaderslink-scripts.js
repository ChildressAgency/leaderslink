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
});

google.maps.event.addDomListener(window, 'load', initialize);


var overlay;
USGSOverlay.prototype = new google.maps.OverlayView();

// Initialize the map and the custom overlay.

//var myLatlng = new google.maps.LatLng(39.335851, -98.313712)  //somewhere in Kansas
//var myLatlng = new google.maps.LatLng(39.5, -98.35); //wiki center
var myLatlng = new google.maps.LatLng(37.09024,-98.012891)

function initialize(){
  var mapOptions = {
    zoom: 5,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    backgroundColor: '#FFF',
    disableDefaultUI: true,
    draggable: true,
    scaleControl: true,
    scrollwheel: true,
    styles: [
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "landscape",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "road",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "administrative",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "poi",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "administrative",
    "stylers": [
      { "visibility": "on" }
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

  var map = new google.maps.Map(document.getElementById('projectMap'), mapOptions);

  var $markers = $('#projectMapMarkers').find('.marker');
  map.markers = [];
  $markers.each(function(){
    add_marker($(this), map);
  });

  //var swBound = new google.maps.LatLng(25.82, -124.39);
  //var neBound = new google.maps.LatLng(49.38, -66.94);
 
 var swBound = new google.maps.LatLng(24.82, -127.39);
 var neBound = new google.maps.LatLng(48.38, -68.94);

  //var swBound = new google.maps.LatLng(55.82, -135.39);
  //var neBound = new google.maps.LatLng(78.38, -98.94);
  var bounds = new google.maps.LatLngBounds(swBound, neBound);

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
