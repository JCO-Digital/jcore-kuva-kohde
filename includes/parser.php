<?php
/**
 * Parses the extended blocks and adds the focal point to the image.
 *
 * @package Jcore\FocalPoint\Parser
 */

namespace Jcore\FocalPoint\Parser;

use WP_HTML_Tag_Processor;

/**
 * Override the render function for the post featured image block.
 *
 * @param string $block_content The HTML output of the post featured image block.
 * @param array  $block The block data.
 *
 * @return string The modified HTML output of the post featured image block.
 */
function add_focal_point_to_post_featured_image( $block_content, $block ) {
	if ( 'core/post-featured-image' !== $block['blockName'] ) {
		return $block_content;
	}

	$attributes = $block['attrs'];

	if ( ! is_array( $attributes ) ) {
		return $block_content;
	}
	if ( isset( $attributes['useFocalPoint'] ) && false === $attributes['useFocalPoint'] ) {
		return $block_content;
	}

	$focal_point = get_post_meta( get_the_ID(), 'jcore_focal_point', true );

	if ( empty( $focal_point ) || ! is_array( $focal_point ) ) {
		return $block_content;
	}

	// Add the custom class to the block content using the HTML API.
	$processor = new WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( 'figure' ) ) {
		$processor->add_class( 'has-focal-point' );
	}

	if ( $processor->next_tag( 'img' ) ) {
		$style = sprintf( 'object-fit: cover; object-position: %d%% %d%%;', $focal_point['x'] * 100, $focal_point['y'] * 100 );
		$processor->set_attribute( 'style', $style );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', __NAMESPACE__ . '\add_focal_point_to_post_featured_image', 10, 2 );

/**
 * Override the render function for the cover block.
 *
 * @param string $block_content The HTML output of the cover block.
 * @param array  $block The block data.
 *
 * @return string The modified HTML output of the cover block.
 */
function add_focal_point_to_cover_block( $block_content, $block ) {
	if ( 'core/cover' !== $block['blockName'] ) {
		return $block_content;
	}

	$attributes = $block['attrs'];

	if ( ! is_array( $attributes ) || ! isset( $attributes['useFeaturedImage'] ) || ! $attributes['useFeaturedImage'] ) {
		return $block_content;
	}

	if ( isset( $attributes['focalPoint'] ) && ! empty( $attributes['focalPoint'] ) ) {
		return $block_content;
	}

	if ( isset( $attributes['useFocalPoint'] ) && false === $attributes['useFocalPoint'] ) {
		return $block_content;
	}

	$focal_point = get_post_meta( get_the_ID(), 'jcore_focal_point', true );

	if ( empty( $focal_point ) || ! is_array( $focal_point ) ) {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( 'div' ) ) {
		$processor->add_class( 'has-focal-point' );
	}

	if ( $processor->next_tag( 'img' ) ) {
		$style = sprintf( 'object-fit: cover; object-position: %d%% %d%%;', $focal_point['x'] * 100, $focal_point['y'] * 100 );
		$processor->set_attribute( 'style', $style );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', __NAMESPACE__ . '\add_focal_point_to_cover_block', 10, 2 );


/**
 * Add the focal point to the image.
 *
 * @param string $block_content The HTML output of the image block.
 * @param array  $block The block data.
 *
 * @return string The modified HTML output of the image.
 */
function add_focal_point_to_image( $block_content, $block ) {
	if ( 'core/image' !== $block['blockName'] ) {
		return $block_content;
	}

	$attributes = $block['attrs'];

	if ( ! is_array( $attributes ) ) {
		return $block_content;
	}

	if ( ! isset( $attributes['focalPoint'] ) || ! $attributes['focalPoint'] ) {
		return $block_content;
	}

	$focal_point = $attributes['focalPoint'];

	if ( empty( $focal_point ) || ! is_array( $focal_point ) ) {
		return $block_content;
	}

	$style     = sprintf( 'object-position: %d%% %d%%;', $focal_point['x'] * 100, $focal_point['y'] * 100 );
	$processor = new WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( 'img' ) ) {
		$current_style = $processor->get_attribute( 'style' );

		if ( empty( $current_style ) ) {
			$processor->set_attribute( 'style', $style );
		} else {
			$current_style  = rtrim( rtrim( $current_style, ';' ), ' ' );
			$current_style .= ';';

			$processor->set_attribute( 'style', $current_style . $style );
		}
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', __NAMESPACE__ . '\add_focal_point_to_image', 10, 2 );
