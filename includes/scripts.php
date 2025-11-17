<?php
/**
 * Scripts
 *
 * @package Jcore\FocalPoint\Scripts
 */

namespace Jcore\FocalPoint\Scripts;

/**
 * Enqueue wp-scripts built asset & dependencies in build directory.
 *
 * @param string $name Name of the asset.
 * @param string $file_name Name of the file.
 *
 * @return void
 */
function enqueue_asset( $name, $file_name ): void {
	$dependencies_file = JCORE_FOCAL_POINT_PATH . 'scripts/build/' . $file_name . '.asset.php';

	if ( ! file_exists( $dependencies_file ) ) {
		return;
	}

	$dependencies = require $dependencies_file;
	wp_enqueue_script( $name, JCORE_FOCAL_POINT_URL . 'scripts/build/' . $file_name . '.js', $dependencies['dependencies'], $dependencies['version'], true );
}

/**
 * Enqueue editor scripts
 *
 * @return void
 */
function enqueue_scripts(): void {
	enqueue_asset( 'jcore-kuva-kohde-editor', 'focal-point-editor' );
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_scripts' );
