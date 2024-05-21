<?php

/**
 * Script functions
 *
 * @author   <Author>
 * @version  1.0.0
 * @package  <Package>
 */

/**
 * Enqueue theme scripts
 */
function wp_theme_scripts()
{

	/**
	 * Enqueue common scripts.
	 */
	wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/dist/js/main.min.js', '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'wp_theme_scripts');