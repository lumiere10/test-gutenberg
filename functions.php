<?php
// Exit if accessed directly.
add_theme_support('title-tag');

defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$inc_dir = 'inc';

// Array of files to include.
$includes = array(
	'/theme-settings.php',
	'/post-type.php',
    '/block-patterns.php',
	'/func-style.php',
	'/func-script.php'
 );

// Include files.
foreach ( $includes as $file ) {
	require_once get_theme_file_path( $inc_dir . $file );
}