<?php
/**
 * Recommended way to include parent theme styles
 *
 * @package astra
 */

/**
 * The version of this plugin.
 *
 * @since    1.0.0
 * @var      string    $version    The current version of this child theme.
 */
$theme   = wp_get_theme();
$version = $theme->get( 'Version' );

/**
 * Enqueue the css and js
 *
 * @return void
 */
function pull_up_deliveries_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $GLOBALS['version'], 'all' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ), $GLOBALS['version'], 'all' );

	wp_enqueue_script( 'child-main-script', get_stylesheet_directory_uri() . '/scripts.js', array( 'jquery' ), $GLOBALS['version'], true );
}

add_action( 'wp_enqueue_scripts', 'pull_up_deliveries_style' );
