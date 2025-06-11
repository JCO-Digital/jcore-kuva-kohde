<?php
/**
 * Plugin Name: JCORE Focal Point
 * Plugin URI: https://github.com/jco-digital/jcore-kuva-kohde
 * Description: JCORE Focal Point module.
 * Version: 0.3.1
 * Author: JCO Digital
 * Author URI: https://jco.fi
 * Text Domain: jcore-focal-point
 * Domain Path: /languages
 *
 * @package Jcore\FocalPoint
 */

use Jcore\FocalPoint;

if ( is_file( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '/consts.php';
require_once __DIR__ . '/includes/scripts.php';
require_once __DIR__ . '/includes/meta.php';
require_once __DIR__ . '/includes/parser.php';

FocalPoint\Bootstrap::init();

add_action(
	'init',
	static function () {
		load_plugin_textdomain( 'jcore-focal-point', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
);
