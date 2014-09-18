<?php
/**
 * Plugin Name: Goldenrod Admin Color Scheme
 * Description:
 * Author: Tom J Nowell
 * Version: 1.0
 * Text Domain: goldenrod-color-scheme
 * License: GPL2
 *
 * Copyright 2013 Tom J Nowell
 */

class goldenrod_Admin_Color_Scheme {

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_default_css') );
		add_action( 'admin_init', array( $this, 'add_color_scheme') );
	}

	/**
	 * Register the custom admin color scheme
	 *
	 * @TODO Implement RTL stylesheets
	 * @TODO Implement Icon colors
	 */
	function add_color_scheme() {
		wp_admin_css_color(
			'goldenrod',
			__( 'Goldenrod', 'goldenrod-color-scheme' ),
			plugins_url( 'goldenrod.css', __FILE__ ),
			array( '#fafafa', '#FFD500', '#fafafa', '#FFD500' )
		);
	}

	/**
	 * Make sure core's default `colors.css` gets enqueued, since we can't
	 * @import it from a plugin stylesheet. Also force-load the default colors
	 * on the profile screens, so the JS preview isn't broken-looking.
	 *
	 * Copied from Admin Color Schemes - http://wordpress.org/plugins/admin-color-schemes/
	 */
	function load_default_css() {

		global $wp_styles;

		$color_scheme = get_user_option( 'admin_color' );

		if ( 'goldenrod' === $color_scheme || in_array( get_current_screen()->base, array( 'profile', 'profile-network' ) ) ) {
			$wp_styles->registered[ 'colors' ]->deps[] = 'colors-fresh';
		}

	}
}

new goldenrod_Admin_Color_Scheme();