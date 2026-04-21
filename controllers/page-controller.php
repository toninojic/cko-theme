<?php
/**
 * Static page controller.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_render_page_content' ) ) {
	/**
	 * Render generic page content.
	 */
	function cko_render_page_content() {
		get_template_part( 'views/page-templates/default-page' );
	}
}

if ( ! function_exists( 'cko_render_contact_page' ) ) {
	/**
	 * Render contact page template.
	 */
	function cko_render_contact_page() {
		get_template_part( 'views/page-templates/contact-page' );
	}
}

if ( ! function_exists( 'cko_render_underground_page' ) ) {
	/**
	 * Render underground as regular page content (content-first).
	 */
	function cko_render_underground_page() {
		get_template_part( 'views/page-templates/default-page' );
	}
}
