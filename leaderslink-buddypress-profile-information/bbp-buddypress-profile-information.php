<?php
/*
Plugin Name: leaderslink buddypress profile information
Plugin URL: http://www.rewweb.co.uk/bbp-profile-information/
Description: adds up to 4 fields from buddypress to the bbp user profile and displays any combination of these under the authors avatar in topics and replies. Fixes and modifications by jcampbell@childressagency.com
Version: 1.0
Author: Robin Wilson
Author URI: http://www.rewweb.co.uk/


*/


/*******************************************
* global variables
*******************************************/

// load the plugin options
$llbpi_options = get_option( 'llbpi_settings' );

if(!defined('LLBPI_PLUGIN_DIR'))
	define('LLBPI_PLUGIN_DIR', dirname(__FILE__));




/*******************************************
* file includes
*******************************************/

include(LLBPI_PLUGIN_DIR . '/includes/settings.php');
include(LLBPI_PLUGIN_DIR . '/includes/display.php');





