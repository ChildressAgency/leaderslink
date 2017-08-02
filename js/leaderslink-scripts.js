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

  $('.acf-map').each(function(){
    map = new_map($(this));
  });  
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

function new_map( $el ) {
	// var
	var $markers = $el.find('.marker');
	// vars
	var args = {
		zoom		: 4,
		center		: new google.maps.LatLng(0, 0),
    mapTypeId	: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    styles:[
      {
        'featureType': 'road',
        'stylers': [{ 'visibility': 'off' }]
      },
      {
        'featureType': 'landscape',
        'stylers': [{ 'visibility': 'off' }]
      },
      {
        'featureType': 'poi',
        'stylers': [{ 'visibility': 'off' }]
      },
      {
        'featureType': 'transit',
        'stylers': [{ 'visibility': 'off' }]
      },
      {
        'featureType': 'administrative',
        'elementType': 'geometry.fill',
        'stylers': [
          { 'color': '#55acee' },
          { 'visibility': 'on' }
        ]
      },
      {
        "featureType": "administrative.country",
        "elementType": "geometry.fill",
        "stylers": [
          { "color": "#55acee" },
          { "visibility": "on" }
        ]
      },
      {
        'featureType': 'administrative.country',
        'elementType': 'geometry.stroke',
        'stylers': [
          { 'color': '#ffffff' },
          { 'visibility': 'on' },
          { 'weight': 3 }
        ]
      },
      {
        "featureType": "administrative.country",
        "elementType": "labels",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "administrative.locality",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "administrative.locality",
        "elementType": "geometry.fill",
        "stylers": [
          { "color": "#55acee" },
          { "visibility": "on" }
        ]
      },
      {
        "featureType": "administrative.province",
        "stylers": [{ "visibility": "on" }]
      },
      {
        "featureType": "administrative.province",
        "elementType": "geometry.fill",
        "stylers": [
          { "color": "#55acee" },
          { "visibility": "on" },
          { "weight": 4 }
        ]
      },
      {
        "featureType": "administrative.province",
        "elementType": "geometry.stroke",
        "stylers": [
          { "color": "#ffffff" },
          { "visibility": "on" },
          { "weight": 2 }
        ]
      },
      {
        "featureType": "administrative.province",
        "elementType": "labels",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "landscape.man_made",
        "elementType": "geometry.fill",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "landscape.man_made",
        "elementType": "geometry.stroke",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "landscape.man_made",
        "elementType": "labels",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "landscape.natural",
        "stylers": [
          { "color": "#55acee" },
          { "visibility": "on" }
        ]
      },
      {
        "featureType": "landscape.natural.landcover",
        "stylers": [
          { "color": "#55adee" },
          { "visibility": "on" }
        ]
      },
      {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry.fill",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry.stroke",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels",
        "stylers": [{ "visibility": "off" }]
      },
      {
        "featureType": "water",
        "stylers": [{ "color": "#ffffff" }]
      }
    ]
	};
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
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
    icon: 'images/leaderslink-marker.png',
		map			: map
	});
	// add to array
	map.markers.push( marker );
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
      content		: $marker.html(),
      maxWidth: 300
		});
		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open( map, marker );
    });
    
    /*
    * The google.maps.event.addListener() event waits for
    * the creation of the infowindow HTML structure 'domready'
    * and before the opening of the infowindow defined styles
    * are applied.
    */
    google.maps.event.addListener(infowindow, 'domready', function() {
      // Reference to the DIV which receives the contents of the infowindow using jQuery
      var iwOuter = $('.gm-style-iw');
      /* The DIV we want to change is above the .gm-style-iw DIV.
        * So, we use jQuery and create a iwBackground variable,
        * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
        */
      var iwBackground = iwOuter.prev();
      // Remove the background shadow DIV
      iwBackground.children(':nth-child(2)').css({'display' : 'none'});
      // Remove the white background DIV
      iwBackground.children(':nth-child(4)').css({'display' : 'none'});
      // Moves the infowindow 115px to the right.
      iwOuter.parent().parent().css({left: '-60px'});

      // Moves the shadow of the arrow 76px to the left margin 
      //iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

      // Moves the arrow 76px to the left margin 
      //iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

      // Changes the desired color for the tail outline.
      // The outline of the tail is composed of two descendants of div which contains the tail.
      // The .find('div').children() method refers to all the div which are direct descendants of the previous div.
      iwBackground.children(':nth-child(1)').css({'left' : '227px'});
      iwBackground.children(':nth-child(3)').css({'left' : '227px', 'top': '209px'});
      iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
      iwBackground.children(':nth-child(3)').children(':nth-child(1)').children().css({'border-left': '2px solid #267fae'});
      iwBackground.children(':nth-child(3)').children(':nth-child(2)').children().css({'border-right': '2px solid #267fae'});

      // Taking advantage of the already established reference to
      // div .gm-style-iw with iwOuter variable.
      // You must set a new variable iwCloseBtn.
      // Using the .next() method of JQuery you reference the following div to .gm-style-iw.
      // Is this div that groups the close button elements.
      var iwCloseBtn = iwOuter.next();

      // Apply the desired effect to the close button
      iwCloseBtn.css({
        opacity: '1', // by default the close button has an opacity of 0.7
        right: '38px', top: '5px', // button repositioning
        border: '2px solid #267fae', // increasing button border and new color
        'border-radius': '16px', // circular effect
        'box-shadow': '0 0 6px #666',
        'background-color': '#fff',
        'padding': '13px' // 3D effect to highlight the button
        });
      iwCloseBtn.children().css({
        'left': '5px',
        'top': '-329px'
      });
      iwCloseBtn.next('img').css({
        'right': '30px',
        'top': '-5px'
      });

      // The API automatically applies 0.7 opacity to the button after the mouseout event.
      // This function reverses this event to the desired value.
      iwCloseBtn.mouseout(function(){
        $(this).css({opacity: '1'});
      });
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
	    map.setZoom( 16 );
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