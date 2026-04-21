<?php
/**
 * Theme setup and support registration.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_theme_setup' ) ) {
	/**
	 * Register theme supports.
	 */
	function cko_theme_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array( 'height' => 64, 'width' => 220, 'flex-height' => true, 'flex-width' => true ) );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'cko-theme' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'cko_theme_setup' );
