<?php

/**
 * Style functions
 *
 * @author   <Author>
 * @version  1.0.0
 * @package  <Package>
 */

/**
 * Enqueue theme styles.
 */
function wp_theme_styles()
{


	wp_enqueue_style( 'custom-styles', get_template_directory_uri() . '/dist/css/style.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style( 'block-styles', get_template_directory_uri() . '/dist/css/styles-block/styles.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'wp_theme_styles');