<?php
/**
 * Twig functions for the kuva-kohde plugin.
 *
 * @package Jcore\FocalPoint\Twig
 */

namespace Jcore\FocalPoint\Twig;

/**
 * Add a function to the Timber/Twig environment to get the focal styles for a post.
 *
 * @return array
 */
add_filter(
	'timber/twig/functions',
	function ( $functions ) {
		$functions['kuva_kohde_focal_styles'] = array(
			'callable' => __NAMESPACE__ . '\post_focal_styles',
		);

		return $functions;
	},
	10,
	1
);

/**
 * Get the focal styles for a post.
 *
 * @param mixed  $post The post object.
 * @param array  $default The default values for x and y.
 * @param string $type The type of the focal styles.
 * @return string The focal styles.
 */
function post_focal_styles( mixed $post, array $default = array(
	'x' => 0.5,
	'y' => 0.5,
), string $type = '' ): string {
	$id = 0;
	if ( is_object( $post ) && isset( $post->ID ) ) {
		$id = $post->ID;
	} elseif ( is_numeric( $post ) ) {
		$id = $post;
	}

	if ( $id === 0 ) {
		return '';
	}

	$focal_styles = get_post_meta( $id, 'jcore_focal_point', true );

	if ( empty( $focal_styles ) || ! is_array( $focal_styles ) || ! isset( $focal_styles['x'] ) || ! isset( $focal_styles['y'] ) ) {
		$x = $default['x'] * 100;
		$y = $default['y'] * 100;
	} else {
		$x = $focal_styles['x'] * 100;
		$y = $focal_styles['y'] * 100;
	}

	$type = match ( $type ) {
		'object-position', 'object' => 'object-position',
		'background-position', 'background' => 'background-position',
		default => 'object-position',
	};
	$focal_styles = $type . ': ' . $x . '% ' . $y . '%';

	return $focal_styles;
}
