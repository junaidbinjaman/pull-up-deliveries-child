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

/**
 * The function initializes all the shortcodes
 *
 * @return void
 */
function init_shortcodes() {
	add_shortcode( 'get_cart_product_count', 'get_cart_product_count__callback' );
	add_shortcode( 'show_login_my_account_text', 'show_login_my_account_text' );
}

/**
 * Returns number of products added to cart.
 *
 * @return int
 */
function get_cart_product_count__callback() {
	return WC()->cart->get_cart_contents_count();
}

/**
 * The function displays login/my account based on user status
 *
 * @return void
 */
function show_login_my_account_text() {
	if ( is_admin() ) {
		return;
	}

	if ( is_user_logged_in() ) {
		echo 'My Account';
		return;
	}

	echo 'LogIn';
}

add_action( 'init', 'init_shortcodes' );

/**
 * The function skips the customer dashboard
 * and redirects them to order listing page.
 *
 * @param object $wp Current WordPress environment instance (passed by reference).
 * @return void
 */
function skip_customer_dashboard( $wp ) {
	if ( is_admin() ) {
		return;
	}

	if ( 'my-account' === $wp->request ) {
		wp_safe_redirect( site_url( 'my-account/orders' ) );
		exit;
	}
}

add_action( 'parse_request', 'skip_customer_dashboard' );

/**
 * Removes the dashboard and download menu.
 *
 * @return array
 */
function manage_wc_account_menu_items() {
	$menu_items = array(
		'orders'          => __( 'Orders', 'pull-up-deliveries' ),
		'edit-address'    => 'Address',
		'edit-account'    => 'Account Details',
		'customer-logout' => 'Log out',
	);
	return $menu_items;
}

add_action( 'woocommerce_account_menu_items', 'manage_wc_account_menu_items' );
