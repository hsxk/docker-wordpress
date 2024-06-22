<?php
/**
 * Plugin Name:       Image Map
 * Plugin URI:        image-map
 * Description:       Show image with Map
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            haokexin
 * License:           GPL-2.0
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       image-with-map
 *
 * @package Haokexin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function haokexin_image_with_map_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'haokexin_image_with_map_block_init' );
