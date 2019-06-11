<?php
/**
Plugin Name: GrandWP Calendar
Plugin URI: http://grandwp.com
Description: GrandWP Calendar is a great plugin for adding specialized Calendar.
Version: 10.3
Author: GrandWP
Author URI: http://grandwp.com/
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: gd-calendar
Domain Path: /languages
*/

//error_reporting(E_ALL);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require 'autoload.php';

require 'GDCalendar.php';

function GDCalendar(){
    return \GDCalendar\GDCalendar::instance();
}

$GLOBALS['GDCalendar'] = GDCalendar();

register_activation_hook( __FILE__, array('GDCalendar\Controllers\PostTypesController', 'run') );