<?php
/**
 * Scripts
 *
 * @package Jcore\FocalPoint\Scripts
 */

namespace Jcore\FocalPoint\Scripts;

/**
 * Enqueue editor scripts
 *
 * @return void
 */
function enqueue_scripts(): void {
	$dependencies_file = JCORE_FOCAL_POINT_PATH . 'scripts/build/focal-point.asset.php';

	if ( ! file_exists( $dependencies_file ) ) {
		return;
	}

	$dependencies = require $dependencies_file;
	wp_enqueue_script(
		'jcore-kuva-kohde',
		JCORE_FOCAL_POINT_URL . 'scripts/build/focal-point.js',
		$dependencies['dependencies'],
		$dependencies['version'],
		true
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_scripts' );
