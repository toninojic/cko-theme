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

if ( ! function_exists( 'cko_register_sidebars' ) ) {
	/**
	 * Register widget areas.
	 */
	function cko_register_sidebars() {
		register_sidebar(
			array(
				'name'          => __( 'Footer Column 1', 'cko-theme' ),
				'id'            => 'footer-1',
				'description'   => __( 'Mission / about text block.', 'cko-theme' ),
				'before_widget' => '<section class="footer-widget">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column 2', 'cko-theme' ),
				'id'            => 'footer-2',
				'description'   => __( 'Links / navigation block.', 'cko-theme' ),
				'before_widget' => '<section class="footer-widget">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column 3', 'cko-theme' ),
				'id'            => 'footer-3',
				'description'   => __( 'Contact / social links block.', 'cko-theme' ),
				'before_widget' => '<section class="footer-widget">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'cko_register_sidebars' );
