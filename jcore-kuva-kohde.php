<?php
/**
 * Plugin Name: JCORE Kuva Kohde
 * Plugin URI: https://github.com/jco-digital/jcore-kuva-kohde
 * Description: JCORE Focal Point module.
 * Version: 1.2.2
 * Requires at least: 6.7
 * Tested up to:      7.0
 * Requires PHP:      8.2
 * Author: JCO Digital
 * Author URI: https://jco.fi
 * Text Domain: jcore-kuva-kohde
 * Domain Path: /languages
 *
 * @package Jcore\KuvaKohde
 */

use Jcore\KuvaKohde;
use Jcore\Update\Config\UpdateConfig;
use Jcore\Update\Hooks\PluginUpdateHooks;
use Jcore\Update\Support\PluginHelper;

if ( is_file( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '/consts.php';

$jcore_focal_point_config = new UpdateConfig(
	__FILE__,
	'jcore-kuva-kohde',
	PluginHelper::getVersion( __FILE__ ),
	'https://update.jcore.fi/v1'
);
( new PluginUpdateHooks( $jcore_focal_point_config ) )->register();

require_once __DIR__ . '/includes/scripts.php';
require_once __DIR__ . '/includes/meta.php';
require_once __DIR__ . '/includes/parser.php';
require_once __DIR__ . '/includes/twig.php';

FocalPoint\Bootstrap::init();

add_action(
	'init',
	static function () {
		load_plugin_textdomain( 'jcore-focal-point', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
);
