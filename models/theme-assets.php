<?php
/**
 * Enqueue theme styles/scripts.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_enqueue_assets' ) ) {
	/**
	 * Enqueue modular CSS and basic JS.
	 */
	function cko_enqueue_assets() {
		$css_files = array(
			'base'       => '/assets/css/base.css',
			'layout'     => '/assets/css/layout.css',
			'components' => '/assets/css/components.css',
			'pages'      => '/assets/css/pages.css',
		);

		foreach ( $css_files as $handle => $path ) {
			wp_enqueue_style(
				'cko-' . $handle,
				CKO_THEME_URI . $path,
				array(),
				CKO_THEME_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'cko_enqueue_assets' );
