<?php
/**
 * Front page controller.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_render_about_page' ) ) {
	/**
	 * Render about-like page.
	 *
	 * @param string $locale Locale key.
	 */
	function cko_render_about_page( $locale = 'sr' ) {
		$sections = cko_get_about_sections( $locale );
		get_template_part( 'views/page-templates/about-page', null, array( 'sections' => $sections, 'locale' => $locale ) );
	}
}
