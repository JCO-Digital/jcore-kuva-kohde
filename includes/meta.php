<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

namespace Jcore\FocalPoint\Meta;

/**
 * Registers the focal point meta field for all post types.
 *
 * @return void
 */
function register_focal_point_meta(): void {
	$args = array(
		'show_in_rest' => array(
			'schema' => array(
				'type'       => 'object',
				'properties' => array(
					'x' => array(
						'type' => 'number',
					),
					'y' => array(
						'type' => 'number',
					),
				),
			),
		),
		'single'       => true,
		'type'         => 'object',
	);

	register_post_meta(
		'',
		'jcore_focal_point',
		$args
	);
}
add_action( 'init', __NAMESPACE__ . '\register_focal_point_meta' );
